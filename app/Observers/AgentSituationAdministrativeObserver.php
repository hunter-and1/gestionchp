<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\AgentSituationAdministrative;


class AgentSituationAdministrativeObserver
{
    /**
     * Handle the AgentSituationAdministrative "created" event.
     */
    public function created(AgentSituationAdministrative $agentSituationAdministrative): void
    {
        //
    }

    /**
     * Handle the AgentSituationAdministrative "updated" event.
     */
    public function updated(AgentSituationAdministrative $agentSituationAdministrative): void
    {
        //
    }

    public function updating(AgentSituationAdministrative $agentSituationAdministrative)
    {
        $originalData = $agentSituationAdministrative->getOriginal();
        $changes = $agentSituationAdministrative->getDirty();
        
        $modifications = $agentSituationAdministrative->modifications ? json_decode($agentSituationAdministrative->modifications, true) : [];

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
        $agentSituationAdministrative->modifications = json_encode($modifications);
    }

    /**
     * Handle the AgentSituationAdministrative "deleted" event.
     */
    public function deleted(AgentSituationAdministrative $agentSituationAdministrative): void
    {
        //
    }

    /**
     * Handle the AgentSituationAdministrative "restored" event.
     */
    public function restored(AgentSituationAdministrative $agentSituationAdministrative): void
    {
        //
    }

    /**
     * Handle the AgentSituationAdministrative "force deleted" event.
     */
    public function forceDeleted(AgentSituationAdministrative $agentSituationAdministrative): void
    {
        //
    }
}
