@extends('layouts.master')
@section('title')
    {{ __('List View') }}
@endsection
@push('css')
    <script src="{{ URL::asset('build/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/common.js') }}"></script>
@endpush
@section('content')
    <!-- page title -->
    <x-page-title title="List de Membres" pagetitle="Membres" />

    @if (session('success'))
        <div class="!py-3.5 card-body border-y border-dashed border-slate-200 dark:border-zink-500">                  
            <div
                class="px-4 py-3 text-sm text-green-500 bg-white border border-green-300 rounded-md dark:bg-zink-700 dark:border-green-500">
                <span class="font-bold">Notification: </span> 
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="!py-3.5 card-body border-y border-dashed border-slate-200 dark:border-zink-500">                  
            <div
                class="px-4 py-3 text-sm text-red-500 bg-white border border-red-300 rounded-md dark:bg-zink-700 dark:border-red-500">
                <span class="font-bold">Notification: </span> 
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="card" id="productListTable">
        <div class="card-body">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-12">
                <div class="xl:col-span-3">
                    <div class="relative">
                        <input type="text"
                            class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Search for ..." autocomplete="off">
                        <i data-lucide="search"
                            class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                    </div>
                </div><!--end col-->
                <div class="lg:col-span-3 ltr:lg:text-right rtl:lg:text-left xl:col-span-3 xl:col-start-11">
                    <a href="#!" data-modal-target="addMemberModal" type="button"
                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 add-employee"><i
                            data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Ajouter un membre</span></a>
                </div>
            </div><!--end grid-->
        </div>

        <div class="!pt-1 card-body">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap" id="productTable">
                    <thead class="ltr:text-left rtl:text-right bg-slate-100 dark:bg-zink-600">
                        <tr>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort product_code"
                                data-sort="product_code">Nom membr</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort product_code"
                                data-sort="product_code">CIPA</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort product_name"
                                data-sort="product_name">Type</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort category"
                                data-sort="product_name">Commune</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort">Date ajoutée</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 action">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                       @foreach ($members as $member)
                            <tr>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 product_name">
                                    <a href="#!" data-modal-target="overviewMember{{ $member->id }}" class="flex items-center gap-3">
                                        <div class="size-6 rounded-full shrink-0 bg-slate-100">
                                            <img src="{{ $member->profile_photo_path ? URL::asset('storage/' . $member->profile_photo_path ): URL::asset('build/images/users/avatar-1.png') }}" alt=""
                                                class="h-6 w-6 rounded-full object-cover">
                                        </div>
                                        <h6 class="grow">{{ $member->nom_complet }}</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    <a href="#!" data-modal-target="overviewMember{{ $member->id }}"
                                        class="transition-all duration-150 ease-linear product_code text-custom-500 hover:text-custom-600">{{ $member->cipa }}</a>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    <a href="#!" data-modal-target="overviewMember{{ $member->id }}"
                                        class="transition-all duration-150 ease-linear product_code text-custom-500 hover:text-custom-600">{{ $member->type_assujetti }}</a>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 stock">{{ $member->commune }}</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 status">{{ \Carbon\Carbon::parse($member->created_at)->locale('fr')->translatedFormat('d M Y') }}</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 action">
                                <div class="flex gap-3">
                                        <a class="flex items-center justify-center size-8 transition-all duration-200 ease-linear rounded-md bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"
                                            href="#!" data-modal-target="overviewMember{{ $member->id }}"><i data-lucide="eye"
                                                class="inline-block size-3"></i> </a>
                                        <a href="#!" data-modal-target="editMemberModal{{ $member->id }}"
                                            class="flex items-center justify-center size-8 transition-all duration-200 ease-linear rounded-md edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                data-lucide="pencil" class="size-4"></i></a>
                                        <a href="#!" data-modal-target="deleteModal{{ $member->id }}"
                                            class="flex items-center justify-center size-8 transition-all duration-200 ease-linear rounded-md remove-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                data-lucide="trash-2" class="size-4"></i></a>
                                    </div>
                                </td>
                            </tr>

                            {{-- Overview Member modal --}}
                            <div id="overviewMember{{ $member->id }}" modal-center
                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-gray-800 p-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Détails du membre</h2>
                                        <button type="button" data-modal-hide="overviewMember{{ $member->id }}" class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 dark:text-gray-300">
                                        <div><strong>CIPA:</strong> {{ $member->cipa }}</div>
                                        <div><strong>Type d’assujetti:</strong> {{ $member->type_assujetti }}</div>
                                        <div><strong>Commune:</strong> {{ $member->commune }}</div>
                                        <div><strong>Nom complet:</strong> {{ $member->nom_complet }}</div>
                                        <div><strong>Sexe:</strong> {{ $member->sexe }}</div>
                                        <div><strong>Nom du responsable:</strong> {{ $member->nom_responsable }}</div>
                                        <div><strong>Date de naissance:</strong> {{ $member->date_naissance }}</div>
                                        <div><strong>Nationalité:</strong> {{ $member->nationalite }}</div>
                                        <div><strong>Activité principale:</strong> {{ $member->activite_principale }}</div>
                                        <div><strong>Lieu d'exercice:</strong> {{ $member->lieu_exercice }}</div>
                                        <div><strong>Marché:</strong> {{ $member->marche }}</div>
                                        <div><strong>Téléphone:</strong> {{ $member->telephone }}</div>
                                        <div><strong>Email:</strong> {{ $member->email }}</div>
                                        <div><strong>NIF:</strong> {{ $member->nif }}</div>
                                        <div><strong>RCCM:</strong> {{ $member->rccm }}</div>
                                        <div><strong>Affiliation syndicale:</strong> {{ $member->affiliation_syndicale }}</div>
                                        <div><strong>Possède un stand:</strong> {{ $member->possede_stand ? 'Oui' : 'Non' }}</div>
                                        <div><strong>Type de bien:</strong> {{ $member->type_bien }}</div>
                                        <div class="col-span-2 flex items-center space-x-4 mt-4">
                                            <strong>Photo de profil:</strong>
                                            @if ($member->profile_photo_path)
                                                <img src="{{ asset('storage/' . $member->profile_photo_path) }}" alt="Photo de profil" class="h-20 w-20 object-cover rounded-full">
                                            @else
                                                <span class="text-gray-500">Non disponible</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex justify-end mt-6">
                                        <button type="button" data-modal-hide="overviewMember{{ $member->id }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                            Fermer
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Delete Member modal --}}
                            <div id="deleteModal{{ $member->id }}" modal-center
                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                        <div class="float-right">
                                            <button data-modal-close="deleteModal{{ $member->id }}"
                                                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500"><i
                                                    data-lucide="x" class="size-5"></i></button>
                                        </div>
                                        <img src="{{ URL::asset('build/images/delete.png') }}" alt="" class="block h-12 mx-auto">
                                        <div class="mt-5 text-center">
                                            <h5 class="mb-1">Êtes-vous sûre?</h5>
                                            <p class="text-slate-500 dark:text-zink-200">Vous êtes sur le point de supprimer ce membre!</p>
                                            <form action="{{ route('members.destroy', $member->id) }}" method="post" class="flex justify-center gap-2 mt-6">
                                                @csrf
                                                @method('DELETE')
                                                <button type="reset" data-modal-close="deleteModal{{ $member->id }}"
                                                    class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">Annuler</button>
                                                <button type="submit"
                                                    class="text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">
                                                    Oui, Supprimer!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end delete modal-->

                            {{-- Edit Member modal--}}
                            <div id="editMemberModal{{ $member->id }}" modal-center
                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
                                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                        <h5 class="text-16" id="addMemberLabel">Ajout d'un membre</h5>
                                        <button data-modal-close="editMemberModal{{ $member->id }}" class="text-slate-400 hover:text-red-500">
                                            <i data-lucide="x" class="size-5"></i>
                                        </button>
                                    </div>

                                    <div class="p-4">
                                        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" id="memberForm">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $member->id }}">

                                            {{-- STEP 1 --}}
                                            <div class="step" id="edit-step-1-{{ $member->id }}">
                                                <div class="mb-3">
                                                    <label for="cipa" class="font-medium">CIPA</label>
                                                    <input type="text" name="cipa" value="{{ $member->cipa }}" id="cipa" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="type_assujetti" class="font-medium">Type d'assujetti</label>
                                                    <select name="type_assujetti" id="type_assujetti" class="form-input">
                                                        <option value="">-- Sélectionner --</option>
                                                        <option value="physique" {{ $member->type_assujetti == 'physique' ? 'selected' : '' }}>Physique</option>
                                                        <option value="morale" {{ $member->type_assujetti == 'morale' ? 'selected' : '' }}>Morale</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="commune" class="font-medium">Commune</label>
                                                    <select label="Commune" name="commune" wire:model.defer="commune" class="form-input">>
                                                        <option value="">Sélectionner...</option>
                                                        @foreach([
                                                            'Bandalungwa', 'Barumbu', 'Bumbu', 'Gombe', 'Kalamu', 'Kasa-Vubu',
                                                            'Kimbanseke', 'Kinshasa', 'Kintambo', 'Kisenso', 'Lemba', 'Limete',
                                                            'Lingwala', 'Makala', 'Maluku', 'Masina', 'Matete', 'Mont-Ngafula',
                                                            'Ndjili', 'Ngaba', 'Ngaliema', 'Ngiri-Ngiri', 'Nsele', 'Selembao'
                                                        ] as $commune)
                                                            <option value="{{ $commune }}" {{ $member->commune == $commune ? 'selected' : '' }}>{{ $commune }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="nom_complet" class="font-medium">Nom complet</label>
                                                    <input type="text" name="nom_complet" value="{{ $member->nom_complet }}" id="nom_complet" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nom_responsable" class="font-medium">Nom du responsable</label>
                                                    <input type="text" name="nom_responsable" value="{{ $member->nom_responsable }}" id="nom_responsable" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="sexe" class="font-medium">Sexe</label>
                                                    <select name="sexe" id="sexe" class="form-input">
                                                        <option value="" >-- Choisir --</option>
                                                        <option value="M" {{ $member->sexe == 'M' ? 'selected' : '' }}>Masculin</option>
                                                        <option value="F" {{ $member->sexe == 'F' ? 'selected' : '' }}>Féminin</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- STEP 2 --}}
                                            <div class="step hidden" id="edit-step-2-{{ $member->id }}">
                                                <div class="mb-3">
                                                    <label for="date_naissance" class="font-medium">Date de naissance</label>
                                                    <input type="date" value="{{ $member->date_naissance }}" name="date_naissance" id="date_naissance" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nationalite" class="font-medium">Nationalité</label>
                                                    <input type="text" value="{{ $member->nationalite }}" name="nationalite" id="nationalite" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="activite_principale" class="font-medium">Activité principale</label>
                                                    <input type="text" value="{{ $member->activite_principale }}" name="activite_principale" id="activite_principale" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lieu_exercice" class="font-medium">Lieu d’exercice</label>
                                                    <input type="text" value="{{ $member->lieu_exercice }}" name="lieu_exercice" id="lieu_exercice" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="marche" class="font-medium">Marché</label>
                                                    <input type="text" value="{{ $member->marche }}" name="marche" id="marche" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telephone" class="font-medium">Téléphone</label>
                                                    <input type="text" value="{{ $member->telephone }}" name="telephone" id="telephone" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="font-medium">Email</label>
                                                    <input type="email" value="{{ $member->email }}" name="email" id="email" class="form-input">
                                                </div>
                                            </div>

                                            {{-- STEP 3 --}}
                                            <div class="step hidden" id="edit-step-3-{{ $member->id }}">
                                                <div class="mb-3">
                                                    <label for="nif" class="font-medium">NIF</label>
                                                    <input type="text" value="{{ $member->nif }}" name="nif" id="nif" class="form-input" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rccm" class="font-medium">RCCM</label>
                                                    <input type="text" value="{{ $member->rccm }}" name="rccm" id="rccm" class="form-input">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="affiliation_syndicale" class="font-medium">Affiliation syndicale</label>
                                                    <select name="affiliation_syndicale" id="affiliation_syndicale" class="form-input">
                                                        <option value="">-- Choisir --</option>
                                                        <option value="SNVC" {{ $member->affiliation_syndicale === 'SNVC' ? 'selected' : '' }}>SNVC</option>
                                                        <option value="Autre" {{ $member->affiliation_syndicale === 'Autre' ? 'selected' : '' }}>Autre</option>
                                                        <option value="Aucune" {{ $member->affiliation_syndicale === 'Aucune' ? 'selected' : '' }}>Aucune</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="possede_stand" class="font-medium">Possède un stand</label>
                                                    <select name="possede_stand" id="possede_stand" class="form-input">
                                                        <option value="">-- Choisir --</option>
                                                        <option value="Oui" {{ $member->possede_stand === 'Oui' ? 'selected' : '' }}>Oui</option>
                                                        <option value="Non" {{ $member->possede_stand === 'Non' ? 'selected' : '' }}>Non</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="type_bien" class="font-medium">Type de bien</label>
                                                    <select name="type_bien" id="type_bien" class="form-input">
                                                        <option value="">-- Choisir --</option>
                                                        <option value="Propre" {{ $member->type_bien === 'Propre' ? 'selected' : '' }}>Propre</option>
                                                        <option value="Loué" {{ $member->type_bien === 'Loué' ? 'selected' : '' }}>Loué</option>
                                                        <option value="Public" {{ $member->type_bien === 'Public' ? 'selected' : '' }}>Public</option>
                                                    </select>
                                                </div>

                                                {{-- Si l'image existe, afficher l'image actuelle --}}
                                                @if ($member->profile_photo_path)
                                                    <div class="mb-3">
                                                        <img src="{{ URL::asset('storage/' . $member->profile_photo_path) }}" alt="Profile Image" class="h-24 w-24 rounded-full">
                                                    </div>
                                                @endif
                                                {{-- Si l'image n'existe pas, afficher un champ de téléchargement --}}
                                                <div class="mb-3">
                                                    <label for="profile-img" class="font-medium">Photo de profil</label>
                                                    <input type="file"  name="profile-img" id="profile-img" class="form-input">
                                                </div>
                                            </div>

                                             {{-- Navigation --}}
                                            <div class="flex justify-between mt-4">
                                                <button type="button" id="prevBtn-{{ $member->id }}" class="btn bg-gray-200 text-black hidden">Précédent</button>
                                                <button type="button" id="nextBtn-{{ $member->id }}" class="btn bg-custom-500 text-white">Suivant</button>
                                                <button type="submit" id="submitBtn-{{ $member->id }}" class="btn bg-green-400 text-white hidden">Soumettre</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Script navigation steps pour ce membre (place dans la page ou dans un @push('scripts') si tu utilises) --}}
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const memberId = {{ $member->id }};
                                    const steps = [
                                        document.getElementById(`edit-step-1-${memberId}`),
                                        document.getElementById(`edit-step-2-${memberId}`),
                                        document.getElementById(`edit-step-3-${memberId}`)
                                    ];
                                    const prevBtn = document.getElementById(`prevBtn-${memberId}`);
                                    const nextBtn = document.getElementById(`nextBtn-${memberId}`);
                                    const submitBtn = document.getElementById(`submitBtn-${memberId}`);

                                    let currentStep = 0;

                                    function showStep(index) {
                                        steps.forEach((step, i) => {
                                            step.classList.toggle("hidden", i !== index);
                                        });
                                        prevBtn.style.display = (index === 0) ? 'none' : 'inline-block';
                                        nextBtn.style.display = (index === steps.length - 1) ? 'none' : 'inline-block';
                                        submitBtn.style.display = (index === steps.length - 1) ? 'inline-block' : 'none';
                                    }

                                    nextBtn.addEventListener("click", () => {
                                        if (currentStep < steps.length - 1) {
                                            currentStep++;
                                            showStep(currentStep);
                                        }
                                    });

                                    prevBtn.addEventListener("click", () => {
                                        if (currentStep > 0) {
                                            currentStep--;
                                            showStep(currentStep);
                                        }
                                    });

                                    showStep(currentStep);
                                });
                            </script>

                       @endforeach
                    </tbody>
                </table>

                <div class="noresult" style="display: none">
                    <div class="py-6 text-center">
                        <i data-lucide="search"
                            class="size-6 mx-auto mb-3 text-sky-500 fill-sky-100 dark:fill-sky-500/20"></i>
                        <h5 class="mt-2 mb-1">Désolé! Aucun résulta trouvé.</h5>
                        {{-- <p class="mb-0 text-slate-500 dark:text-zink-200">We've searched more than 199+ product We did not
                            find any product for you search.</p> --}}
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center gap-4 px-4 mt-4 md:flex-row" id="pagination-element">
                <div class="grow">
                    <p class="text-slate-500 dark:text-zink-200">Total Member (<b
                            class="total-records">{{ $members->count() }}</b>)</p>
                </div>

                @if ($members->count() > 0)
                    <div class="col-sm-auto mt-sm-0">
                        <div class="flex gap-2 pagination-wrap justify-content-center">
                            <a class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto page-item pagination-prev "
                                href="javascript:void(0)">
                                <i class="size-4 mr-1 rtl:rotate-180" data-lucide="chevron-left"></i> Précédent
                            </a>
                            <ul class="flex flex-wrap items-center gap-2 pagination listjs-pagination">
                            </ul>
                            <a class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto page-item pagination-next"
                                href="javascript:void(0)">
                                Suivant <i class="size-4 ml-1 rtl:rotate-180" data-lucide="chevron-right"></i>
                            </a>
                        </div>
                    </div>
               @endif
            </div>

        </div>

    </div><!--end card-->

    <!--end add Member-->
    <div id="addMemberModal" modal-center
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                <h5 class="text-16" id="addMemberLabel">Ajout d'un membre</h5>
                <button data-modal-close="addMemberModal" class="text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <div class="p-4">
                <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" id="memberForm">
                    @csrf

                    {{-- STEP 1 --}}
                    <div class="step" id="step-1">
                        <div class="mb-3">
                            <label for="cipa" class="font-medium">CIPA</label>
                            <input type="text" name="cipa" id="cipa" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="type_assujetti" class="font-medium">Type d'assujetti</label>
                            <select name="type_assujetti" id="type_assujetti" class="form-input">
                                <option value="">-- Sélectionner --</option>
                                <option value="physique">Physique</option>
                                <option value="morale">Morale</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="commune" class="font-medium">Commune</label>
                            <select label="Commune" name="commune" wire:model.defer="commune" class="form-input">>
                                <option value="">Sélectionner...</option>
                                @foreach([
                                    'Bandalungwa', 'Barumbu', 'Bumbu', 'Gombe', 'Kalamu', 'Kasa-Vubu',
                                    'Kimbanseke', 'Kinshasa', 'Kintambo', 'Kisenso', 'Lemba', 'Limete',
                                    'Lingwala', 'Makala', 'Maluku', 'Masina', 'Matete', 'Mont-Ngafula',
                                    'Ndjili', 'Ngaba', 'Ngaliema', 'Ngiri-Ngiri', 'Nsele', 'Selembao'
                                ] as $commune)
                                    <option value="{{ $commune }}">{{ $commune }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="nom_complet" class="font-medium">Nom complet</label>
                            <input type="text" name="nom_complet" id="nom_complet" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="nom_responsable" class="font-medium">Nom du responsable</label>
                            <input type="text" name="nom_responsable" id="nom_responsable" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="sexe" class="font-medium">Sexe</label>
                            <select name="sexe" id="sexe" class="form-input">
                                <option value="">-- Choisir --</option>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                    </div>

                    {{-- STEP 2 --}}
                    <div class="step hidden" id="step-2">
                        <div class="mb-3">
                            <label for="date_naissance" class="font-medium">Date de naissance</label>
                            <input type="date" name="date_naissance" id="date_naissance" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="nationalite" class="font-medium">Nationalité</label>
                            <input type="text" name="nationalite" id="nationalite" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="activite_principale" class="font-medium">Activité principale</label>
                            <input type="text" name="activite_principale" id="activite_principale" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="lieu_exercice" class="font-medium">Lieu d’exercice</label>
                            <input type="text" name="lieu_exercice" id="lieu_exercice" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="marche" class="font-medium">Marché</label>
                            <input type="text" name="marche" id="marche" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="font-medium">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="font-medium">Email</label>
                            <input type="email" name="email" id="email" class="form-input">
                        </div>
                    </div>

                    {{-- STEP 3 --}}
                    <div class="step hidden" id="step-3">
                        <div class="mb-3">
                            <label for="nif" class="font-medium">NIF</label>
                            <input type="text" name="nif" id="nif" class="form-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="rccm" class="font-medium">RCCM</label>
                            <input type="text" name="rccm" id="rccm" class="form-input">
                        </div>
                        <div class="mb-3">
                            <label for="affiliation_syndicale" class="font-medium">Affiliation syndicale</label>
                            <select name="affiliation_syndicale" id="affiliation_syndicale" class="form-input">
                                <option value="">-- Choisir --</option>
                                <option value="SNVC">SNVC</option>
                                <option value="Autre">Autre</option>
                                <option value="Aucune">Aucune</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="possede_stand" class="font-medium">Possède un stand</label>
                            <select name="possede_stand" id="possede_stand" class="form-input">
                                <option value="">-- Choisir --</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="type_bien" class="font-medium">Type de bien</label>
                            <select name="type_bien" id="type_bien" class="form-input">
                                <option value="">-- Choisir --</option>
                                <option value="Propre">Propre</option>
                                <option value="Loué">Loué</option>
                                <option value="Public">Public</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="profile-img" class="font-medium">Photo de profil</label>
                            <input type="file" name="profile-img" id="profile-img" class="form-input">
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <div class="flex justify-between mt-4">
                        <button type="button" id="prevBtn" class="btn bg-gray-200 text-black hidden">Précédent</button>
                        <button type="button" id="nextBtn" class="btn bg-custom-500 text-white">Suivant</button>
                        <button type="submit" id="submitBtn" class="btn bg-green-400 text-white hidden">Soumettre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <!-- list js-->
    <script src="{{ URL::asset('build/libs/list.js/list.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/apps-ecommerce-product.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/apps-hr-employee.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const steps = document.querySelectorAll(".step");
            const nextBtn = document.getElementById("nextBtn");
            const prevBtn = document.getElementById("prevBtn");
            const submitBtn = document.getElementById("submitBtn");
            let currentStep = 0;
    
            function showStep(index) {
                steps.forEach((step, i) => {
                    step.classList.toggle("hidden", i !== index);
                });
    
                prevBtn.classList.toggle("hidden", index === 0);
                nextBtn.classList.toggle("hidden", index === steps.length - 1);
                submitBtn.classList.toggle("hidden", index !== steps.length - 1);
            }
    
            nextBtn.addEventListener("click", () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });
    
            prevBtn.addEventListener("click", () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
    
            showStep(currentStep);
        });
    </script>
@endpush


