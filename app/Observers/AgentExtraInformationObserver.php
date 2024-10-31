<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\AgentExtraInformation;

class AgentExtraInformationObserver
{
    /**
     * Handle the AgentExtraInformation "created" event.
     */
    public function created(AgentExtraInformation $agentExtraInformation): void
    {
        //
    }

    /**
     * Handle the AgentExtraInformation "updated" event.
     */
    public function updated(AgentExtraInformation $agentExtraInformation): void
    {
        //
    }

    public function updating(AgentExtraInformation $agentExtraInformation)
    {
        $originalData = $agentExtraInformation->getOriginal();
        $changes = $agentExtraInformation->getDirty();
        
        $modifications = $agentExtraInformation->modifications ? json_decode($agentExtraInformation->modifications, true) : [];

        foreach ($changes as $key => $newValue) {
            $oldValue = $originalData[$key] ?? null;
            if ($oldValue != $newValue) {
                $modifications[] = [
                    'field' => $key,
                    'old_value' => $oldValue,
                    'new_value' => $newValue,
                    'modified_at' => now()->toDateTimeString(),
                    'modified_by' => Auth::id(),
                ];
            }
        }

        //auth()->id()
        $agentExtraInformation->modifications = json_encode($modifications);
    }
    /**
     * Handle the AgentExtraInformation "deleted" event.
     */
    public function deleted(AgentExtraInformation $agentExtraInformation): void
    {
        //
    }

    /**
     * Handle the AgentExtraInformation "restored" event.
     */
    public function restored(AgentExtraInformation $agentExtraInformation): void
    {
        //
    }

    /**
     * Handle the AgentExtraInformation "force deleted" event.
     */
    public function forceDeleted(AgentExtraInformation $agentExtraInformation): void
    {
        //
    }
}
