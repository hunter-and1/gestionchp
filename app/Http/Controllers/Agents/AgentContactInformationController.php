<?php

namespace App\Http\Controllers\Agents;


use App\Models\AgentExtraInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentContactInformationController extends Controller
{
    public function edit($agentId)
    {
        $extraInfo = AgentExtraInformation::where('agent_id', $agentId)->first();

        return view('app.contact_information.edit', compact('extraInfo'));
    }

    public function update(Request $request, $agentId)
    {
        $validatedData = $request->validate([
            'adresse_fr' => 'required|string|max:255',
            'adresse_ar' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        $extraInfo = AgentExtraInformation::where('agent_id', $agentId)->first();
        $extraInfo->fill($validatedData);
        $extraInfo->save();

        return redirect()->route('agents.show',$agentId)->with('success', 'Contact information updated successfully.');
    }
}
