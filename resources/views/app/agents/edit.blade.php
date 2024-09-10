<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Agent
        </h2>
    </x-slot>

    <div class="px-12 py-6">
        <form action="{{ route('agents.update', $agent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- First Name and Last Name -->
            <div class="mb-4">
                <label for="a_firstname" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                <input type="text" name="a_firstname" id="a_firstname" class="border border-gray-300 p-2 rounded-md w-full" value="{{ old('a_firstname', $agent->a_firstname) }}" required>
            </div>
            <div class="mb-4">
                <label for="a_lastname" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                <input type="text" name="a_lastname" id="a_lastname" class="border border-gray-300 p-2 rounded-md w-full" value="{{ old('a_lastname', $agent->a_lastname) }}" required>
            </div>

            <!-- Agent Category -->
            <div class="mb-4">
                <label for="a_category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select name="a_category" id="a_category" class="border border-gray-300 p-2 rounded-md w-full" required>
                    <option value="">- Select -</option>
                    <option value="CHP" {{ $agent->a_category == 'CHP' ? 'selected' : '' }}>Fonctionnaire du CHP</option>
                    <option value="HORS-CHP" {{ $agent->a_category == 'HORS-CHP' ? 'selected' : '' }}>Hors CHP</option>
                </select>
            </div>
            
            <!-- CHP Fields (Visible only if category is CHP) -->
            <div id="chp-fields" class="{{ $agent->a_category == 'CHP' ? 'block' : 'hidden' }}">
                <h3 class="text-lg font-semibold mb-2">Fonctionnaire du CHP Details</h3>

                <div class="mb-4">
                    <label for="recruitment_type" class="block text-gray-700 text-sm font-bold mb-2">Recruitment Type</label>
                    <select name="recruitment_type" id="recruitment_type" class="border border-gray-300 p-2 rounded-md w-full">
                        <option value="">- Select -</option>
                        <option value="1er_recrutement" {{ isset($agent->chpAgentDetail) && $agent->chpAgentDetail->recruitment_type == '1er_recrutement' ? 'selected' : '' }}>1er Recrutement</option>
                        <option value="detachement" {{ isset($agent->chpAgentDetail) && $agent->chpAgentDetail->recruitment_type == 'detachement' ? 'selected' : '' }}>Detachement</option>
                        <option value="mutation" {{ isset($agent->chpAgentDetail) && $agent->chpAgentDetail->recruitment_type == 'mutation' ? 'selected' : '' }}>Mutation</option>
                        <option value="mise_a_disposition" {{ isset($agent->chpAgentDetail) && $agent->chpAgentDetail->recruitment_type == 'mise_a_disposition' ? 'selected' : '' }}>Mise à Disposition</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="affectation" class="block text-gray-700 text-sm font-bold mb-2">Affectation</label>
                    <select name="affectation" id="affectation" class="border border-gray-300 p-2 rounded-md w-full">
                        <option value="">- Select -</option>
                        <option value="definitive" {{ isset($agent->chpAgentDetail) && $agent->chpAgentDetail->affectation == 'definitive' ? 'selected' : '' }}>Définitive</option>
                        <option value="provisoire" {{ isset($agent->chpAgentDetail) && $agent->chpAgentDetail->affectation == 'provisoire' ? 'selected' : '' }}>Provisoire</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                    <select name="status" id="status" class="border border-gray-300 p-2 rounded-md w-full">
                        <option value="">- Select -</option>
                        <option value="stagiaire" {{ isset($agent->chpAgentDetail) && $agent->chpAgentDetail->status == 'stagiaire' ? 'selected' : '' }}>Stagiaire</option>
                        <option value="titulaire" {{ isset($agent->chpAgentDetail) && $agent->chpAgentDetail->status == 'titulaire' ? 'selected' : '' }}>Titulaire</option>
                    </select>
                </div>
            </div>

            <!-- HORS-CHP Fields (Visible only if category is HORS-CHP) -->
            <div id="hors-chp-fields" class="{{ $agent->a_category == 'HORS-CHP' ? 'block' : 'hidden' }}">
                <h3 class="text-lg font-semibold mb-2">Hors CHP Details</h3>

                <div class="mb-4">
                    <label for="contract_type" class="block text-gray-700 text-sm font-bold mb-2">Contract Type</label>
                    <select name="contract_type" id="contract_type" class="border border-gray-300 p-2 rounded-md w-full">
                        <option value="">- Select -</option>
                        <option value="stagiaire" {{ isset($agent->horsChpAgentDetail) && $agent->horsChpAgentDetail->contract_type == 'stagiaire' ? 'selected' : '' }}>Stagiaire</option>
                        <option value="contractuel" {{ isset($agent->horsChpAgentDetail) && $agent->horsChpAgentDetail->contract_type == 'contractuel' ? 'selected' : '' }}>Contractuel</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update</button>
        </form>
    </div>

    <script>
        document.getElementById('a_category').addEventListener('change', function() {
            var category = this.value;
            
            document.getElementById('chp-fields').style.display = (category === 'CHP') ? 'block' : 'none';
            document.getElementById('hors-chp-fields').style.display = (category === 'HORS-CHP') ? 'block' : 'none';
        });
    </script>
</x-app-layout>
