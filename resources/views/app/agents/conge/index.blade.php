<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conge agent : {{ $agent->nom_fr }} {{ $agent->prenom_fr }}
        </h2>
    </x-slot>

    <div class="p-5">
        <x-button x-data x-on:click="$dispatch('open-modal',{name:'init-conge-annuel'})">Initialiser Congé Annuel</x-button>
        <x-button x-data x-on:click="$dispatch('open-modal',{name:'add-conge'})">Ajoute Congé</x-button>

        <a class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline mb-4" href="">ajoute un congé</a>
        <br>
        <table class="min-w-full border border-gray-300">
            <tbody>
                <tr>
                    <td rowspan="2" class="border border-gray-300 bg-gray-100 p-2">Années</td>
                    <td colspan="2" class="border border-gray-300 bg-gray-100 p-2">Congé administratif</td>
                    <td rowspan="2" class="border border-gray-300 bg-gray-100 p-2">Congé de Maladie</td>
                    <td rowspan="2" class="border border-gray-300 bg-gray-100 p-2">Congé de Paternité</td>
                    <td rowspan="2" class="border border-gray-300 bg-gray-100 p-2">Congé sans solde</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 bg-gray-200 p-2">Congé annuel</td>
                    <td class="border border-gray-300 bg-gray-200 p-2">Congé exceptionnel</td>
                </tr>

                <tr>
                    <td class="border border-gray-300 p-2"><a href="/" class="text-blue-500">2020</a></td>
                    <td class="border border-gray-300 p-2">-</td>
                    <td class="border border-gray-300 p-2">-</td>
                    <td class="border border-gray-300 p-2">-</td>
                    <td class="border border-gray-300 p-2">-</td>
                    <td class="border border-gray-300 p-2">-</td>
                </tr>
            </tbody>
        </table>

        @push('modals')
            <x-my-modal name="init-conge-annuel" maxWidth="lg">
                <form method="POST" action="{{ route('conge.init',$agent) }}">
                    @csrf
                    <div class="px-6 py-4">
                        <div class="text-lg font-medium text-gray-900">
                            Initialize Congé Annuel
                        </div>

                        <div class="mt-4 text-sm text-gray-600">
                            <div class="mb-4">
                                <label for="year" class="block text-sm font-medium text-gray-700">Année de départ</label>
                                <input type="number"
                                       name="year"
                                       id="year"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                                       min="{{ now()->year - 10 }}"
                                       max="{{ now()->year }}"
                                       value="{{ old('year') }}">
                                @error('year')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="numericValue" class="block text-sm font-medium text-gray-700">Solde restant</label>
                                <input type="number"
                                       name="numericValue"
                                       id="numericValue"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                                       min="0"
                                       max="22"
                                       value="{{ old('numericValue') }}">
                                @error('numericValue')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
                        <button type="submit" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                    </div>
                </form>
            </x-my-modal>
            <x-my-modal name="add-conge" maxWidth="lg">
                <form method="POST" action="{{ route('conge.store',$agent) }}" id="congeForm">
                    @csrf
                    <div class="px-6 py-4">
                        <div class="text-lg font-medium text-gray-900">
                            Ajoute de Congé
                        </div>

                        <div class="mt-4 text-sm text-gray-600">

                            <div class="mb-4">
                                <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
                                <input type="date"
                                       name="date_debut"
                                       id="date_debut"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                                       required>
                            </div>

                            <div class="mb-4">
                                <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
                                <input type="date"
                                       name="date_fin"
                                       id="date_fin"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                                       required>
                            </div>

                            <div class="mb-4">
                                <label for="observation" class="block text-sm font-medium text-gray-700">Observation</label>
                                <textarea name="observation"
                                          id="observation"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                                          rows="3"></textarea>
                            </div>

                            <div class="mb-4 font-medium">
                                Nombre de jours ouvrables : <span id="joursOuvrables">-</span>
                            </div>

                            <div class="mb-4">
                                <div class="text-sm text-gray-600">
                                    Solde disponible:
                                    <ul id="soldeInfo" class="mt-2 list-disc list-inside">
                                        <!-- Will be populated via JavaScript -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
                        <button type="submit" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Soumettre la demande
                        </button>
                    </div>
                </form>
            </x-my-modal>
        @endpush
        @push('scripts')
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dateDebut = document.getElementById('date_debut');
                const dateFin = document.getElementById('date_fin');
                const soldeInfo = document.getElementById('soldeInfo');
                const joursOuvrables = document.getElementById('joursOuvrables');

                async function updateSoldeInfo() {
                    try {
                        const response = await fetch('/agents/{{$agent->id}}/conge/available-balance');
                        const soldes = await response.json();

                        soldeInfo.innerHTML = '';
                        soldes.forEach(solde => {
                            const li = document.createElement('li');
                            li.textContent = `${solde.annee}: ${solde.solde} jours`;
                            soldeInfo.appendChild(li);
                        });
                    } catch (error) {
                        console.error('Error fetching balance:', error);
                    }
                }

                // Update solde info when the modal opens
                updateSoldeInfo();

                // Calculate working days between two dates
                function calculateWorkingDays(start, end) {
                    let count = 0;
                    let current = new Date(start);
                    const endDate = new Date(end);

                    while (current <= endDate) {
                        const dayOfWeek = current.getDay();
                        if (dayOfWeek !== 0 && dayOfWeek !== 6) {
                            count++;
                        }
                        current.setDate(current.getDate() + 1);
                    }
                    return count;
                }

                // Add event listeners for date changes
                dateDebut.addEventListener('change', validateDates);
                dateFin.addEventListener('change', validateDates);

                function validateDates() {
                    if (dateDebut.value && dateFin.value) {
                        const startDate = new Date(dateDebut.value);
                        const endDate = new Date(dateFin.value);

                        if (endDate < startDate) {
                            alert('La date de fin doit être postérieure à la date de début');
                            dateFin.value = '';
                            joursOuvrables.textContent = '-';
                            return;
                        }

                        const workingDays = calculateWorkingDays(startDate, endDate);
                        joursOuvrables.textContent = workingDays;
                    } else {
                        joursOuvrables.textContent = '-';
                    }
                }
            });
            </script>
        @endpush
    </div>
</x-app-layout>
