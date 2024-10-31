<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un Nouvel Agent
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <form id="agentForm" action="{{ route('agents.store') }}" method="POST">
            @csrf

            <!-- Display error messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                    <ul class="list-disc pl-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Progress Bar -->
            <div class="mb-4">
                <div class="flex justify-between space-x-2">
                    <div class="w-1/2 text-center py-2 px-4 bg-gray-200 rounded-md" id="step-1Indicator">Étape 1 : Informations Initiales</div>
                    <div class="w-1/2 text-center py-2 px-4 bg-gray-200 rounded-md" id="step-2Indicator">Étape 2 : Informations Personnelles</div>
                </div>
            </div>

            <!-- Step 1 -->
            <div id="step-1" class="step">
                <!-- Fields for Step 1 -->
                <div class="flex flex-row space-x-4">
                    <div class="basis-2/3">
                        <div
                            class="whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow focus:outline-none">

                            <!-- Step 1: Select Categorie -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="category">Catégorie<small class="text-red-500">*</small></label>
                                <select id="category" name="category" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" selected disabled>Select Category</option>
                                    <?php foreach (config('agent.category') as $key => $value): ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Subcategory (if CONTRACTUELLE) -->
                            <div id="subCategorySection" class="hidden mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="subCategory">Sub-Category<small class="text-red-500">*</small></label>
                                <select id="subCategory" name="sub_category" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" selected disabled>Select Sub-Category</option>
                                    <?php foreach (config('agent.sub_category') as $key => $value): ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Affectation (if FONCTIONNAIRE DU CHPI) -->
                            <div id="affectationSection" class="hidden mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="affectation">Affectation<small class="text-red-500">*</small></label>
                                <select id="affectation" name="affectation"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" selected disabled>Select Affectation</option>
                                    <?php foreach (config('agent.affectation') as $key => $value): ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Statut (if FONCTIONNAIRE DU CHPI) -->
                            <div id="statutSection" class="hidden mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="statut">Statut<small class="text-red-500">*</small></label>
                                <select id="statut" name="statut"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" selected disabled>Select Statut</option>
                                    <?php foreach (config('agent.statut') as $key => $value): ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Position (if TITULAIRE is selected) -->
                            <div id="positionSection" class="hidden mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="position">Position<small class="text-red-500">*</small></label>
                                <select id="position" name="position"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" selected disabled>Select Position</option>
                                    <?php foreach (config('agent.position') as $key => $value): ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Motif d’entrée (if TITULAIRE) -->
                            <div id="motifSection" class="hidden mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="motif">Motif d’entrée<small class="text-red-500">*</small></label>
                                <select id="motif" name="motif_entree"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" selected disabled>Select Motif d’entrée</option>
                                    <?php foreach (config('agent.motif_entree') as $key => $value): ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Type de mouvement (if Mutation is selected) -->
                            <div id="typeMouvementSection" class="hidden mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="typeMouvement">Type de mouvement<small class="text-red-500">*</small></label>
                                <select id="typeMouvement" name="type_mouvement"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" selected disabled>Select Type de mouvement</option>
                                    <?php foreach (config('agent.type_mouvement') as $key => $value): ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="basis-1/3">
                        <div
                            class="whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow focus:outline-none">

                            <!-- Final Step X: Reference, Date, Observation -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="reference">Reference<small class="text-red-500">*</small></label>
                                <input type="text" id="reference" name="reference" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="dateReference">Date<small class="text-red-500">*</small></label>
                                <input type="date" id="dateReference" name="date_reference" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="observation">Observation</label>
                                <textarea id="observation" name="observation" rows="4"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div id="step-2" class="step hidden">
                <div class="whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow focus:outline-none">
                    <div class="flex flex-row space-x-2">
                        <div class="basis-1/4">
                            <!-- NOM FR -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="nomFr">Nom<small class="text-red-500">*</small></label>
                                <input type="text" id="nomFr" name="nom_fr" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="basis-1/4">
                            <!-- PRENOM FR -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="prenomFr">Prénom<small class="text-red-500">*</small></label>
                                <input type="text" id="prenomFr" name="prenom_fr" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="basis-1/4">
                            <!-- PRENOM AR -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-right text-gray-700" for="prenomAr"><small class="text-red-500">*</small>الإسم الشخصي</label>
                                <input type="text" id="prenomAr" name="prenom_ar" dir="rtl" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="basis-1/4">
                            <!-- NOM AR -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-right text-gray-700" for="nomAr">الإسم العائلي<small class="text-red-500">*</small></label>
                                <input type="text" id="nomAr" name="nom_ar" dir="rtl" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row space-x-2">
                        <div class="basis-2/6">
                            <!-- CIN -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="cin">CIN<small class="text-red-500">*</small></label>
                                <input type="text" id="cin" name="cin" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="basis-2/6">
                            <!-- PPR -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="ppr">PPR</label>
                                <input type="text" id="ppr" name="ppr" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="basis-2/6">
                            <!-- DATE DE NAISSANCE -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700" for="dateNaissance">Date de Naissance<small class="text-red-500">*</small></label>
                                <input type="date" id="dateNaissance" name="date_naissance" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- LIEU DE NAISSANCE FR -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700" for="lieuNaissanceFr">Lieu de Naissance</label>
                        <input type="text" id="lieuNaissanceFr" name="lieu_naissance_fr" required
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <!-- LIEU DE NAISSANCE AR -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-right text-gray-700" for="lieuNaissanceAr">مكان الازدياد</label>
                        <input type="text" id="lieuNaissanceAr" name="lieu_naissance_ar" dir="rtl" required
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <!-- DATE DE RECRUTEMENT -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700" for="dateRecrutement">Date de Recrutement<small class="text-red-500">*</small></label>
                        <input type="date" id="dateRecrutement" name="date_recrutement" required
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button" id="prevStep" class="bg-gray-500 text-white px-4 py-2 rounded-md" disabled>Précédent</button>
                <button type="button" id="nextStep" class="bg-blue-500 text-white px-4 py-2 rounded-md">Suivant</button>
            </div>
        </form>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryElement = document.getElementById('category');
            const subCategorySection = document.getElementById('subCategorySection');
            const affectationSection = document.getElementById('affectationSection');
            const statutSection = document.getElementById('statutSection');
            const positionSection = document.getElementById('positionSection');
            const motifSection = document.getElementById('motifSection');
            const typeMouvementSection = document.getElementById('typeMouvementSection');

            const elements = {
                subCategory: document.getElementById('subCategory'),
                affectation: document.getElementById('affectation'),
                statut: document.getElementById('statut'),
                position: document.getElementById('position'),
                motif: document.getElementById('motif'),
                typeMouvement: document.getElementById('typeMouvement')
            };

            function toggleVisibility(visibleSections) {
                const sections = {
                    subCategorySection,
                    affectationSection,
                    statutSection,
                    positionSection,
                    motifSection,
                    typeMouvementSection
                };

                // Loop through all the sections
                Object.keys(sections).forEach(key => {
                    const section = sections[key];
                    const isVisible = visibleSections.includes(key);

                    // Toggle visibility of the section
                    section.classList.toggle('hidden', !isVisible);

                    // Get all input and select elements within the section
                    const inputs = section.querySelectorAll('input, select');

                    // Add/remove required attribute based on visibility
                    inputs.forEach(input => {
                        if (isVisible) {
                            input.setAttribute('required', 'required');
                        } else {
                            input.removeAttribute('required');
                        }
                    });
                });
            }


            function clearSelections() {
                Object.values(elements).forEach(element => {
                    element.value = '';
                });
            }

            categoryElement.addEventListener('change', function() {
                const category = this.value;
                if (category === 'contractuelle') {
                    toggleVisibility(['subCategorySection']);
                    clearSelections();
                } else if (category === 'fonctionnaire_chp') {
                    toggleVisibility(['affectationSection', 'statutSection']);
                    clearSelections();
                } else {
                    toggleVisibility([]);
                    clearSelections();
                }
            });

            elements.statut.addEventListener('change', function() {
                if (this.value === 'titulaire') {
                    toggleVisibility(['affectationSection', 'statutSection','positionSection', 'motifSection']);
                } else {
                    toggleVisibility(['affectationSection', 'statutSection']);
                }
            });

            elements.motif.addEventListener('change', function() {
                if (this.value === 'mutation') {
                    toggleVisibility(['affectationSection', 'statutSection','positionSection', 'motifSection','typeMouvementSection']);
                } else {
                    toggleVisibility(['affectationSection', 'statutSection','positionSection', 'motifSection']);
                    elements.typeMouvement.value = '';
                }
            });

            let currentStep = 1;
            const totalSteps = 2;

            function showStep(step) {
                for (let i = 1; i <= totalSteps; i++) {
                    document.getElementById('step-' + i).classList.add('hidden');
                    document.getElementById('step-' + i + 'Indicator').classList.add('bg-gray-200');
                    document.getElementById('step-' + i + 'Indicator').classList.remove('bg-blue-500');
                }

                // Show current step and highlight its indicator
                document.getElementById('step-' + step).classList.remove('hidden');
                                
                // Highlight all previous and current steps with the same active color
                for (let i = 1; i <= step; i++) {
                    document.getElementById('step-' + i + 'Indicator').classList.remove('bg-gray-200');
                    document.getElementById('step-' + i + 'Indicator').classList.add('bg-blue-500');
                }

                document.getElementById('prevStep').disabled = (step === 1);
                document.getElementById('nextStep').textContent = (step === totalSteps) ? 'Soumettre' : 'Suivant';
            }

            document.getElementById('nextStep').addEventListener('click', function () {
                // Select all input fields in the current step
                const inputs = document.querySelectorAll(`#step-${currentStep} input, #step-${currentStep} select, #step-${currentStep} textarea`);

                let isValid = true;

                // Loop through each input and check if it's valid
                inputs.forEach(function (input) {
                    if (!input.checkValidity()) {
                        isValid = false;
                        input.reportValidity(); // Highlight the invalid field
                    }
                });
                //for test only
                isValid = true;

                if (isValid) {
                    // If valid, move to the next step
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    } else {
                        // Final step, check the whole form
                        if (validateSteps()) {
                            document.getElementById('agentForm').submit();
                        } else {
                            alert('Veuillez remplir tous les champs requis avant de soumettre le formulaire.');
                        }
                    }
                } else {
                    alert('Veuillez remplir tous les champs requis avant de passer à l\'étape suivante.');
                }
            });

            document.getElementById('prevStep').addEventListener('click', function () {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            function validateSteps() {

                // Get current step element
                const stepElement = document.querySelector('#step-' + currentStep);

                // Get all inputs/selects within the current step
                const inputs = stepElement.querySelectorAll('input, select');

                // Check for empty required fields
                for (let input of inputs) {
                    if (input.hasAttribute('required') && !input.value) {
                        input.focus();
                        input.classList.add('border-red-500');
                        alert('Veuillez remplir tous les champs requis.');
                        return false;
                    } else {
                        input.classList.remove('border-red-500');
                    }
                }

                return true;
            }

            showStep(currentStep);
        });
    </script>
    @endpush
</x-app-layout>