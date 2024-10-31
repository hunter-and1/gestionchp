<?php

namespace App\Http\Controllers\Agents;

use App\Models\AgentExtraInformation;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AgentFamilySituationController extends Controller
{
    public function edit($agentId)
    {
        $extraInfo = AgentExtraInformation::where('agent_id', $agentId)->first();

        return view('app.family_situation.edit', compact('extraInfo'));
    }

    public function update(Request $request, $agentId)
    {
        $validatedData = $request->validate([
            'situation_familiale' => 'required|string|max:255',
            'nombre_enfants' => 'required|integer|min:0',
        ]);

        $extraInfo = AgentExtraInformation::where('agent_id', $agentId)->first();
        $extraInfo->fill($validatedData);
        $extraInfo->save();

        return redirect()->route('agents.show',$agentId)->with('success', 'Family situation updated successfully.');
    }
}
