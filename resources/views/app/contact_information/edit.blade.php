<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Contact Information
        </h2>
    </x-slot>
    <div class="p-5">
        <form action="{{ route('contact-information.update', $extraInfo->agent_id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="adresse_fr" class="block text-sm font-medium text-gray-700">
                    Adresse (FR) <small class="text-red-500">*</small>
                </label>
                <input type="text" id="adresse_fr" name="adresse_fr" required
                    value="{{ old('adresse_fr', $extraInfo->adresse_fr) }}"
                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="adresse_ar" class="block text-sm font-medium text-gray-700">
                    عنوان (AR) <small class="text-red-500">*</small>
                </label>
                <input type="text" id="adresse_ar" name="adresse_ar" required
                    value="{{ old('adresse_ar', $extraInfo->adresse_ar) }}"
                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    E-mail <small class="text-red-500">*</small>
                </label>
                <input type="email" id="email" name="email" required value="{{ old('email', $extraInfo->email) }}"
                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="telephone" class="block text-sm font-medium text-gray-700">
                    Téléphone <small class="text-red-500">*</small>
                </label>
                <input type="text" id="telephone" name="telephone" required
                    value="{{ old('telephone', $extraInfo->telephone) }}"
                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update</button>
        </form>
    </div>
</x-app-layout>