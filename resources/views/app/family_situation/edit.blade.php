<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Family Situation
        </h2>
    </x-slot>
    <div class="p-5">
        <form action="{{ route('family-situation.update', $extraInfo->agent_id) }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700" for="situation_familiale">Situation Familiale<small
                        class="text-red-500">*</small></label>
                <select id="situation_familiale" name="situation_familiale" required
                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="" selected disabled>Select Situation Familiale</option>
                    <?php foreach (config('agent.situation_familiale') as $key => $value): ?>
                    <option value="<?php echo $key ?>"
                        <?php echo old('situation_familiale', $extraInfo->situation_familiale) == $key ? 'selected' : '' ?>>
                        <?php echo $value ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-6">
                <label for="nombre_enfants" class="block text-sm font-medium text-gray-700">
                    Nombre d'Enfants <small class="text-red-500">*</small>
                </label>
                <input type="number" id="nombre_enfants" name="nombre_enfants" required
                    value="{{ old('nombre_enfants', $extraInfo->nombre_enfants) }}"
                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update</button>
        </form>
    </div>
</x-app-layout>