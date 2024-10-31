<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoldeConge;
use App\Models\Conge;
use App\Models\TypeConge;
use App\Models\Agent;
use Carbon\Carbon;

class AgentCongeController extends Controller
{
    public function show(Agent $agent)
    {
        return view('app.agents.conge.index', compact('agent'));
    }


    public function init(Request $request, Agent $agent)
    {
        $request->validate([
            'year' => ['required', 'integer', 'min:' . (now()->year - 10), 'max:' . now()->year],
            'numericValue' => ['required', 'integer', 'min:0', 'max:22'],
        ]);

        $startYear = $request->year;
        $currentYear = now()->year;
        $agent_id = $agent->id;

        // Start a database transaction
        \DB::beginTransaction();

        try {
            // Initialize the first year with provided value
            SoldeConge::create([
                'agent_id' => $agent_id,
                'annee' => $startYear,
                'solde_initial' => 22,
                'solde_restant' => $request->numericValue,
                'active' => true
            ]);

            // Initialize subsequent years with 22 days
            for ($year = $startYear + 1; $year <= $currentYear; $year++) {
                SoldeConge::create([
                    'agent_id' => $agent_id,
                    'annee' => $year,
                    'solde_initial' => 22,
                    'solde_restant' => 22,
                    'active' => true
                ]);
            }

            \DB::commit();
            return redirect()->back()->with('success', 'Soldes de congés initialisés avec succès');

        } catch (\Exception $e) {
            d($e);
            \DB::rollback();
            return redirect()->back()->with('error', 'Erreur lors de l\'initialisation des congés');
        }
    }


    public function store(Request $request, Agent $agent)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'observation' => 'nullable|string',
        ]);

        $joursConge = $this->calculateWorkingDays($request->date_debut, $request->date_fin);

        // Get available balances sorted by year (oldest first)
        $soldes = SoldeConge::where('agent_id', $agent->id)
            ->where('solde_restant', '>', 0)
            ->where('active',1)
            ->orderBy('annee', 'asc')
            ->get();

        $totalDisponible = $soldes->sum('solde_restant');

        if ($totalDisponible < $joursConge) {
            return back()->withErrors(['message' => 'Solde de congé insuffisant']);
        }

        \DB::beginTransaction();
        try {
            $joursRestants = $joursConge;
            $utilisations = [];

            foreach ($soldes as $solde) {
                if ($joursRestants <= 0) break;

                $joursAPrendre = min($solde->solde_restant, $joursRestants);
                $solde->solde_restant -= $joursAPrendre;
                $solde->save();

                $utilisations[] = [
                    'annee' => $solde->annee,
                    'jours' => $joursAPrendre
                ];

                $joursRestants -= $joursAPrendre;
            }

            // Create the congé record
            $conge = new Conge([
                'agent_id' => $agent->id,
                'type_conge_id' => TypeConge::where('code', 'ANNUEL')->first()->id,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'date_reprise' => Carbon::parse($request->date_fin)->addDay(),
                'jours_consommes' => $joursConge,
                'etat' => 'COMPLET',
                'observation' => $request->observation,
                'annee_conge' => implode(',', array_map(fn($u) => "{$u['annee']}:{$u['jours']}", $utilisations))
            ]);

            $conge->save();
            \DB::commit();

            return redirect()->back()->with('success', 'Demande de congé enregistrée avec succès');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['message' => 'Une erreur est survenue']);
        }
    }

    private function calculateWorkingDays($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $days = 0;

        while ($start->lte($end)) {
            if (!$start->isWeekend()) {
                $days++;
            }
            $start->addDay();
        }

        return $days;
    }

    // Add this method to get available balance
    public function getAvailableBalance(Request $request,Agent $agent)
    {
        $soldes = SoldeConge::where('agent_id', $agent->id)
            ->where('solde_restant', '>', 0)
            ->where('active',1)
            ->orderBy('annee', 'asc')
            ->get()
            ->map(fn($solde) => [
                'annee' => $solde->annee,
                'solde' => $solde->solde_restant
            ]);

        return response()->json($soldes);
    }
}
