<?php

namespace App\Http\Controllers\Agents;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Agent;
use App\Models\AgentExtraInformation;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.agents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Retrieve configuration values
        $config = config('agent');
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'category' => ['required', Rule::in(array_keys($config['category']))],
            'sub_category' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('category') === 'contractuelle'),
                Rule::in(array_keys($config['sub_category']))
            ],
            'affectation' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('category') === 'fonctionnaire_chp'),
                Rule::in(array_keys($config['affectation']))
            ],
            'statut' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('category') === 'fonctionnaire_chp'),
                Rule::in(array_keys($config['statut']))
            ],
            'position' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('statut') === 'titulaire'),
                Rule::in(array_keys($config['position']))
            ],
            'motif_entree' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('statut') === 'titulaire'),
                Rule::in(array_keys($config['motif_entree']))
            ],
            'type_mouvement' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('motif_entree') === 'mutation'),
                Rule::in(array_keys($config['type_mouvement']))
            ],
            'reference' => 'required|unique:agents,reference|max:255',
            'date_reference' => 'required|date',
            'observation' => 'nullable|string',

            'nom_fr' => 'required|string|max:255',
            'prenom_fr' => 'required|string|max:255',
            'prenom_ar' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'cin' => 'required|string|max:20|unique:agents,cin',
            'ppr' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('category') !== 'contractuelle' && $request->input('statut') !== 'stagiaire'),
                'string', 'max:20', 'unique:agents,ppr'
            ],
            'date_naissance' => 'required|date',
            'lieu_naissance_fr' => 'required|string|max:255',
            'lieu_naissance_ar' => 'required|string|max:255',
            'date_recrutement' => 'required|date',
        ]);
    
        // Create a new agent record
        $agent = new Agent();
    
        // Populate agent data
        $agent->fill($validatedData);
    
        // Save to the database
        $agent->save();
    
        AgentExtraInformation::create([
            'agent_id' => $agent->id,
        ]);

        return redirect()->route('agents.index')->with('success', 'Agent added successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        $extraInfo = AgentExtraInformation::where('agent_id', $agent->id)->first();

        return view('app.agents.show', compact('agent','extraInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        return view('app.agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Retrieve configuration values
        $config = config('agent');
    
        // Find the existing agent
        $agent = Agent::findOrFail($id);
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'category' => ['required', Rule::in(array_keys($config['category']))],
            'sub_category' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('category') === 'contractuelle'),
                Rule::in(array_keys($config['sub_category']))
            ],
            'affectation' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('category') === 'fonctionnaire_chp'),
                Rule::in(array_keys($config['affectation']))
            ],
            'statut' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('category') === 'fonctionnaire_chp'),
                Rule::in(array_keys($config['statut']))
            ],
            'position' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('statut') === 'titulaire'),
                Rule::in(array_keys($config['position']))
            ],
            'motif_entree' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('statut') === 'titulaire'),
                Rule::in(array_keys($config['motif_entree']))
            ],
            'type_mouvement' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('motif_entree') === 'mutation'),
                Rule::in(array_keys($config['type_mouvement']))
            ],
            'reference' => [
                'required',
                'max:255',
                Rule::unique('agents', 'reference')->ignore($agent->id) // Ignore the current agent's reference
            ],
            'date_reference' => 'required|date',
            'observation' => 'nullable|string',
    
            'nom_fr' => 'required|string|max:255',
            'prenom_fr' => 'required|string|max:255',
            'prenom_ar' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'cin' => [
                'required',
                'string',
                'max:20',
                Rule::unique('agents', 'cin')->ignore($agent->id) // Ignore the current agent's CIN
            ],
            'ppr' => [
                'nullable',
                Rule::requiredIf(fn() => $request->input('category') !== 'contractuelle' && $request->input('statut') !== 'stagiaire'),
                'string',
                'max:20',
                Rule::unique('agents', 'ppr')->ignore($agent->id) // Ignore the current agent's PPR
            ],
            'date_naissance' => 'required|date',
            'lieu_naissance_fr' => 'required|string|max:255',
            'lieu_naissance_ar' => 'required|string|max:255',
            'date_recrutement' => 'required|date',
        ]);
    
        // Update agent data
        $agent->fill($validatedData);
    
        // Save the changes to the database
        $agent->save();
    
        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent) {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}
