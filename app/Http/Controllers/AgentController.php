<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\ChpAgentDetail;
use App\Models\HorsChpAgentDetail;

class AgentController extends Controller
{

    public function index()
    {
        // Retrieve all agents with their associated details
        $R['agents'] = Agent::with('chpAgentDetail', 'horsChpAgentDetail')->get();
    
        // Return the view with the agents data
        return view('app.agents.index', $R);
    }

    
    public function create()
    {
        
        return view('app.agents.create');
    }
    
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'a_firstname' => 'required|string|max:255',
            'a_lastname' => 'required|string|max:255',
            'a_category' => 'required|in:CHP,HORS-CHP',
            // Additional validation rules for CHP or HORS-CHP based on the selected category
        ]);

        // Create the agent
        $agent = Agent::create([
            'a_firstname' => $request->a_firstname,
            'a_lastname' => $request->a_lastname,
            'a_category' => $request->a_category,
        ]);

        // Handle CHP details
        if ($request->a_category == 'CHP') {
            ChpAgentDetail::create([
                'agent_id' => $agent->id,
                'recruitment_type' => $request->recruitment_type,
                'affectation' => $request->affectation,
                'status' => $request->status,
                'position' => $request->position,
            ]);
        }

        // Handle HORS-CHP details
        if ($request->a_category == 'HORS-CHP') {
            HorsChpAgentDetail::create([
                'agent_id' => $agent->id,
                'contract_type' => $request->contract_type,
            ]);
        }

        return redirect()->route('agents.index')->with('success', 'Agent created successfully.');
    }


    public function edit(Agent $agent)
    {
        // Pass the agent to the view
        return view('app.agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        // Validate the input
        $validated = $request->validate([
            'a_firstname' => 'required|string|max:255',
            'a_lastname' => 'required|string|max:255',
            'a_category' => 'required|in:CHP,HORS-CHP',

            // 'recruitment_type' => 'nullable|in:1er_recrutement,detachement,mutation,mise_a_disposition',
            // 'affectation' => 'nullable|in:definitive,provisoire',
            // 'status' => 'nullable|in:stagiaire,titulaire',
            // 'position' => 'nullable|in:en_activite',
            // 'contract_type' => 'nullable|in:stagiaire,contractuel',
        ]);

        // Check if the category has changed
        if ($agent->a_category != $request->a_category) {
            // Remove old details based on the previous category
            if ($agent->a_category == 'CHP') {
                $agent->chpAgentDetail()->delete();
            } elseif ($agent->a_category == 'HORS-CHP') {
                $agent->horsChpAgentDetail()->delete();
            }
        }

        // Update the agent's information
        $agent->update($validated);

        // Handle CHP or HORS-CHP details
        if ($request->a_category == 'CHP') {
            $agent->chpAgentDetail()->updateOrCreate(
                ['agent_id' => $agent->id],
                [
                    'recruitment_type' => $request->recruitment_type,
                    'affectation' => $request->affectation,
                    'status' => $request->status,
                    'position' => $request->position,
                ]
            );
        } elseif ($request->a_category == 'HORS-CHP') {
            $agent->horsChpAgentDetail()->updateOrCreate(
                ['agent_id' => $agent->id],
                ['contract_type' => $request->contract_type]
            );
        }

        // Redirect back to the agents index page
        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent)
    {
        // Delete the agent and its related details
        $agent->delete();

        // Redirect back to the agents index with a success message
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}