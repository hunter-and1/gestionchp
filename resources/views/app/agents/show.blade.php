

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Agent Details
        </h2>
    </x-slot>
    <div class="p-5">
        <div class="bg-white shadow rounded-lg p-6 mb-3">
            <a href="{{ route('conge.show',$agent) }}">conge </a>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-lg mb-2">Basic Information</h3>
                    <p><strong>Nom (FR):</strong> {{ $agent->nom_fr }}</p>
                    <p><strong>Prénom (FR):</strong> {{ $agent->prenom_fr }}</p>
                    <p><strong>Nom (AR):</strong> {{ $agent->nom_ar }}</p>
                    <p><strong>Prénom (AR):</strong> {{ $agent->prenom_ar }}</p>
                    <p><strong>CIN:</strong> {{ $agent->cin }}</p>
                    <p><strong>PPR:</strong> {{ $agent->ppr }}</p>
                    <p><strong>Date de Naissance:</strong> {{ $agent->date_naissance }}</p>
                    <p><strong>Lieu de Naissance (FR):</strong> {{ $agent->lieu_naissance_fr }}</p>
                    <p><strong>Lieu de Naissance (AR):</strong> {{ $agent->lieu_naissance_ar }}</p>
                </div>

                <!-- Professional Information Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-lg mb-2">Professional Information</h3>
                    <p><strong>Catégorie:</strong> {{ config('agent.category')[$agent->category] ?? 'N/A' }}</p>
                    <p><strong>Sous-Catégorie:</strong> {{ config('agent.sub_category')[$agent->sub_category] ?? 'N/A' }}</p>
                    <p><strong>Affectation:</strong> {{ config('agent.affectation')[$agent->affectation] ?? 'N/A' }}</p>
                    <p><strong>Statut:</strong> {{ config('agent.statut')[$agent->statut] ?? 'N/A' }}</p>
                    <p><strong>Position:</strong> {{ config('agent.position')[$agent->position] ?? 'N/A' }}</p>
                    <p><strong>Motif d'Entrée:</strong> {{ config('agent.motif_entree')[$agent->motif_entree] ?? 'N/A' }}</p>
                    <p><strong>Type de Mouvement:</strong> {{ config('agent.type_mouvement')[$agent->type_mouvement] ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 mt-6">
                <!-- Reference Information Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-lg mb-2">Reference Information</h3>
                    <p><strong>Référence:</strong> {{ $agent->reference }}</p>
                    <p><strong>Date de Référence:</strong> {{ $agent->date_reference }}</p>
                    <p><strong>Observation:</strong> {{ $agent->observation }}</p>
                </div>
            </div>

            <a href="{{ route('agents.edit', $agent->id) }}" class="text-blue-500 hover:underline">Modifier </a>
        </div>   
        <div class="bg-white shadow rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4">Informations de Contact</h2>
                    <p><strong>Adresse (FR):</strong> {{ $extraInfo->adresse_fr ?? 'N/A' }}</p>
                    <p><strong>عنوان (AR):</strong> {{ $extraInfo->adresse_ar ?? 'N/A'}}</p>
                    <p><strong>E-mail:</strong> {{ $extraInfo->email ?? 'N/A'}}</p>
                    <p><strong>Téléphone:</strong> {{ $extraInfo->telephone ?? 'N/A'}}</p>
                    
                    <a href="{{ route('contact-information.edit', $agent->id) }}" class="text-blue-500 hover:underline">Modifier les informations de contact</a>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4">Situation Familiale</h2>
                    <p><strong>Situation Familiale:</strong> {{ config('agent.situation_familiale')[$extraInfo->situation_familiale] ?? 'N/A' }}</p>
                    <p><strong>Nombre d'Enfants:</strong> {{ $extraInfo->nombre_enfants ?? 'N/A'}}</p>
                    
                    <a href="{{ route('family-situation.edit', $agent->id) }}" class="text-blue-500 hover:underline">Modifier la situation familiale</a>
                </div>
            </div>
        </div>   
        
        <div class="flex justify-end mt-6">
            <a href="{{ route('agents.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                List agents
            </a>
        </div>
    </div>
</x-app-layout>
    
