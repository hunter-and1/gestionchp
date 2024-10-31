<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Agent;

class AgentsTable extends DataTableComponent
{
    protected $model = Agent::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')->setTableRowUrl(function($row) {
            return route('agents.show', $row);
        });
        // ->setTableRowUrlTarget(function($row) {
        //     if ($row->isExternal()) {
        //         return '_blank';
        //     }
        //     return '_self';
        // })

        $this->setAdditionalSelects(['prenom_fr','nom_fr', 'prenom_ar', 'nom_ar']);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")->sortable(),
            Column::make("Category", "category")->format(
                fn($value, $row, Column $column) => config('agent')['category'][$value]
            ),
            Column::make("Sub category", "sub_category")->format(
                fn($value, $row, Column $column) => !empty($value) ? config('agent')['sub_category'][$value] : ''
            ),
            Column::make("Affectation", "affectation")->format(
                fn($value, $row, Column $column) => !empty($value) ? config('agent')['affectation'][$value] : ''
            ),
            Column::make("Statut", "statut")->format(
                fn($value, $row, Column $column) => !empty($value) ? config('agent')['statut'][$value] : ''
            ),
            Column::make("Position", "position")->format(
                fn($value, $row, Column $column) => !empty($value) ? config('agent')['position'][$value] : ''
            ),
            //Column::make("Motif entree", "motif_entree")->sortable(),
            //Column::make("Type mouvement", "type_mouvement")->sortable(),
            Column::make("Reference", "reference")->deselected()->sortable(),
            // Column::make("Date reference", "date_reference")
            //     ->sortable(),
            // Column::make("Observation", "observation")
            //     ->sortable(),
            Column::make('Nom et prenom')->label(
                fn($row, Column $column) => $row->prenom_fr . ' ' . $row->nom_fr
            )->html(),
            Column::make('Nom et prenom Arabic')->deselected()->label(
                fn($row, Column $column) => $row->prenom_ar . ' ' . $row->nom_ar
            )->html(),
            Column::make("Cin", "cin"),
            Column::make("Ppr", "ppr"),
            // Column::make("Date naissance", "date_naissance")->sortable(),
            // Column::make("Lieu naissance fr", "lieu_naissance_fr")->sortable(),
            // Column::make("Lieu naissance ar", "lieu_naissance_ar")->sortable(),
            Column::make("Date recrutement", "date_recrutement")->deselected()->sortable(),
            // Column::make("Created at", "created_at")->sortable(),
            // Column::make("Updated at", "updated_at")->sortable(),
            Column::make('Action')->excludeFromColumnSelect()
                ->label(fn($row, Column $column) => view('components.datatable-action-buttons', ['id' => $row->id]))
                ->html(),
        ];
    }

    public function filters(): array
    {
        
        return [     
            SelectFilter::make('Categorie', 'category')->options(array_merge(['' => 'All'],config('agent')['category']))->filter(function(Builder $builder, string $value) {
                if ($value !== '') {
                    $builder->where('category', $value);
                }
            }),
            SelectFilter::make('Sub Category', 'sub_category')->options(array_merge(['' => 'All'],config('agent')['sub_category']))->filter(function(Builder $builder, string $value) {
                if ($value !== '') {
                    $builder->where('sub_category', $value);
                }
            }),
            SelectFilter::make('Affectation', 'affectation')->options(array_merge(['' => 'All'],config('agent')['affectation']))->filter(function(Builder $builder, string $value) {
                if ($value !== '') {
                    $builder->where('affectation', $value);
                }
            }),
            SelectFilter::make('Statut', 'statut')->options(array_merge(['' => 'All'],config('agent')['statut']))->filter(function(Builder $builder, string $value) {
                if ($value !== '') {
                    $builder->where('statut', $value);
                }
            }),
            SelectFilter::make('Position', 'position')->options(array_merge(['' => 'All'],config('agent')['position']))->filter(function(Builder $builder, string $value) {
                if ($value !== '') {
                    $builder->where('position', $value);
                }
            }),
        ];

    }


    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
        ];
    }

    public function exportSelected()
    {
        foreach($this->getSelected() as $item)
        {
            // These are strings since they came from an HTML element
        }
        // $this->clearSelected();
    }

}
