<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Agent
        </h2>
    </x-slot>

    <div class="px-12 py-6">
        <form action="{{ route('agents.store') }}" method="POST">
            @csrf

            <!-- First Name and Last Name -->
            <div class="mb-4">
                <label for="a_firstname" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                <input type="text" name="a_firstname" id="a_firstname" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="a_lastname" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                <input type="text" name="a_lastname" id="a_lastname" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>

            <!-- Agent Category -->
            <div class="mb-4">
                <label for="a_category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select name="a_category" id="a_category" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">- Select -</option>
                    <option value="CHP">Fonctionnaire du CHP</option>
                    <option value="HORS-CHP">Hors CHP</option>
                </select>
            </div>

            <!-- CHP Fields (Visible only if category is CHP) -->
            <div id="chp-fields" class="mb-4" style="display: none;">
                <h3 class="text-lg font-semibold mb-2">Fonctionnaire du CHP Details</h3>

                <div class="mb-4">
                    <label for="recruitment_type" class="block text-gray-700 text-sm font-bold mb-2">Recruitment Type</label>
                    <select name="recruitment_type" id="recruitment_type" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">- Select -</option>
                        <option value="1er_recrutement">1er Recrutement</option>
                        <option value="detachement">Detachement</option>
                        <option value="mutation">Mutation</option>
                        <option value="mise_a_disposition">Mise à Disposition</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="affectation" class="block text-gray-700 text-sm font-bold mb-2">Affectation</label>
                    <select name="affectation" id="affectation" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">- Select -</option>
                        <option value="definitive">Définitive</option>
                        <option value="provisoire">Provisoire</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                    <select name="status" id="status" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">- Select -</option>    
                        <option value="stagiaire">Stagiaire</option>
                        <option value="titulaire">Titulaire</option>
                    </select>
                </div>

                <!-- Mutation Type -->
                <div class="mb-4">
                    <label for="mutation" class="block text-gray-700 text-sm font-bold mb-2">Mutation</label>
                    <select name="mutation" id="mutation" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">- Select -</option>
                        <option value="non">Non</option>
                        <option value="oui">Oui</option>
                    </select>
                </div>

                <div id="mutation-details" class="mb-4" style="display: none;">
                    <label for="mutation_type" class="block text-gray-700 text-sm font-bold mb-2">Type de Mutation</label>
                    <select name="mutation_type" id="mutation_type" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">- Select -</option>
                        <option value="reunion_de_conjoint">Réunion de conjoint</option>
                        <option value="zone_dacces_difficile">Zone d’accès difficile</option>
                        <option value="regulier">Régulier</option>
                        <option value="raisons_de_sante">Raisons de santé</option>
                    </select>
                </div>
            </div>

            <!-- HORS-CHP Fields (Visible only if category is HORS-CHP) -->
            <div id="hors-chp-fields" class="mb-4" style="display: none;">
                <h3 class="text-lg font-semibold mb-2">Hors CHP Details</h3>

                <div class="mb-4">
                    <label for="contract_type" class="block text-gray-700 text-sm font-bold mb-2">Contract Type</label>
                    <select name="contract_type" id="contract_type" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">- Select -</option>
                        <option value="stagiaire">Stagiaire</option>
                        <option value="contractuel">Contractuel</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">
                Submit
            </button>
        </form>

        <script>
            document.getElementById('a_category').addEventListener('change', function() {
                var category = this.value;
                
                document.getElementById('chp-fields').style.display = (category === 'CHP') ? 'block' : 'none';
                document.getElementById('hors-chp-fields').style.display = (category === 'HORS-CHP') ? 'block' : 'none';
            });

            document.getElementById('mutation').addEventListener('change', function() {
                var mutation = this.value;
                
                document.getElementById('mutation-details').style.display = (mutation === 'oui') ? 'block' : 'none';
            });
        </script>
    </div>
</x-app-layout>
