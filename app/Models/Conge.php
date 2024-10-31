<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Conge extends Model
{
    protected $fillable = [
        'agent_id',
        'type_conge_id',
        'date_debut',
        'date_fin',
        'date_reprise',
        'jours_consommes',
        'etat',
        'observation',
        'annee_conge',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_reprise' => 'date',
        'jours_consommes' => 'decimal:1'
    ];

    // Constants for leave status
    const ETAT_EXPIRE = 'EXPIRE';
    const ETAT_ANNULE = 'ANNULE';
    const ETAT_COMPLET = 'COMPLET';
    const ETAT_INTERRUPTION = 'INTERRUPTION';

    // Relationships
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function typeConge(): BelongsTo
    {
        return $this->belongsTo(TypeConge::class);
    }

    // Scopes for filtering
    public function scopeActive($query)
    {
        return $query->where('etat', self::ETAT_COMPLET);
    }

    public function scopeOfYear($query, $year)
    {
        return $query->whereYear('date_debut', $year);
    }

    public function scopeOfType($query, $typeCongeId)
    {
        return $query->where('type_conge_id', $typeCongeId);
    }

    public function scopeOfAgent($query, $agentId)
    {
        return $query->where('agent_id', $agentId);
    }

    // Custom Methods
    public function getUsedLeaveByYear(): array
    {
        $usedLeave = [];
        $entries = explode(',', $this->annee_conge);

        foreach ($entries as $entry) {
            [$year, $days] = explode(':', $entry);
            $usedLeave[$year] = (float) $days;
        }

        return $usedLeave;
    }

    public function getDurationInDays(): float
    {
        return $this->jours_consommes;
    }

    public function isActive(): bool
    {
        return $this->etat === self::ETAT_COMPLET;
    }

    public function isExpired(): bool
    {
        return $this->etat === self::ETAT_EXPIRE;
    }

    public function isCancelled(): bool
    {
        return $this->etat === self::ETAT_ANNULE;
    }

    public function isInterrupted(): bool
    {
        return $this->etat === self::ETAT_INTERRUPTION;
    }

    public function isOngoing(): bool
    {
        $now = Carbon::now();
        return $this->isActive() &&
               $now->between($this->date_debut, $this->date_fin);
    }

    public function hasStarted(): bool
    {
        return Carbon::now()->gte($this->date_debut);
    }

    public function hasEnded(): bool
    {
        return Carbon::now()->gt($this->date_fin);
    }

    public function cancel(): bool
    {
        if ($this->hasStarted()) {
            return false;
        }

        $this->etat = self::ETAT_ANNULE;
        return $this->save();
    }

    public function interrupt($newEndDate): bool
    {
        if (!$this->isActive() || !$this->isOngoing()) {
            return false;
        }

        $newEndDate = Carbon::parse($newEndDate);
        if ($newEndDate->gte($this->date_fin) || $newEndDate->lte($this->date_debut)) {
            return false;
        }

        $this->date_fin = $newEndDate;
        $this->etat = self::ETAT_INTERRUPTION;
        $this->recalculateConsumedDays();

        return $this->save();
    }

    protected function recalculateConsumedDays(): void
    {
        $start = Carbon::parse($this->date_debut);
        $end = Carbon::parse($this->date_fin);
        $workingDays = 0;

        while ($start->lte($end)) {
            if (!$start->isWeekend()) {
                $workingDays++;
            }
            $start->addDay();
        }

        $this->jours_consommes = $workingDays;
    }

    // Accessor for formatted dates
    public function getFormattedDateDebutAttribute(): string
    {
        return $this->date_debut->format('d/m/Y');
    }

    public function getFormattedDateFinAttribute(): string
    {
        return $this->date_fin->format('d/m/Y');
    }

    public function getFormattedDateRepriseAttribute(): string
    {
        return $this->date_reprise ? $this->date_reprise->format('d/m/Y') : '';
    }

    // Helper method to check if leave period overlaps with another
    public function overlapsWithExisting(): bool
    {
        return static::query()
            ->where('agent_id', $this->agent_id)
            ->where('id', '!=', $this->id)
            ->where('etat', self::ETAT_COMPLET)
            ->where(function ($query) {
                $query->whereBetween('date_debut', [$this->date_debut, $this->date_fin])
                    ->orWhereBetween('date_fin', [$this->date_debut, $this->date_fin])
                    ->orWhere(function ($q) {
                        $q->where('date_debut', '<=', $this->date_debut)
                          ->where('date_fin', '>=', $this->date_fin);
                    });
            })
            ->exists();
    }
}
