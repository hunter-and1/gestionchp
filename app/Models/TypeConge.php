<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeConge extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'types_conge';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'libelle',
        'description',
        'max_jours',
        'categorie',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'max_jours' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The predefined categories for leave types.
     *
     * @var array
     */
    const CATEGORIES = [
        'ADMINISTRATIF',
        'EXCEPTIONNEL',
        'MALADIE',
        'PARENTAL',
        'SANS_SOLDE'
    ];

    /**
     * Scope a query to only include leaves of a specific category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('categorie', $category);
    }

    /**
     * Check if the leave type is exceptional.
     *
     * @return bool
     */
    public function isExceptional()
    {
        return $this->categorie === 'EXCEPTIONNEL';
    }

    /**
     * Check if the leave type is medical.
     *
     * @return bool
     */
    public function isMedical()
    {
        return $this->categorie === 'MALADIE';
    }

    /**
     * Check if the leave type is parental.
     *
     * @return bool
     */
    public function isParental()
    {
        return $this->categorie === 'PARENTAL';
    }

    /**
     * Check if the leave type is administrative.
     *
     * @return bool
     */
    public function isAdministrative()
    {
        return $this->categorie === 'ADMINISTRATIF';
    }

    /**
     * Check if the leave type is unpaid.
     *
     * @return bool
     */
    public function isUnpaid()
    {
        return $this->categorie === 'SANS_SOLDE';
    }
}
