
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agents List
        </h2>
    </x-slot>

    <div class="p-5">
        <div class="flex">
            <a href="{{ route('agents.create') }}" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline mb-4">Add New Agent</a>            
        </div>
        
        <livewire:agents-table />
    </div>
</x-app-layout>
    
