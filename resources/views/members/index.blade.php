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
                                data-sort="product_code">Référence</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort product_code"
                                data-sort="product_code">Référence sec.</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort product_name"
                                data-sort="product_name">Nom membre</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort category"
                                data-sort="product_name">Date ajoutée</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 sort">Commune</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 action">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                       @foreach ($members as $member)
                            <tr>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    <a href="#!" data-modal-target="overviewMember{{ $member->id }}"
                                        class="transition-all duration-150 ease-linear product_code text-custom-500 hover:text-custom-600">{{ $member->ref }}</a>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    <a href="#!" data-modal-target="overviewMember{{ $member->id }}"
                                        class="transition-all duration-150 ease-linear product_code text-custom-500 hover:text-custom-600">{{ $member->sec_ref }}</a>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 product_name">
                                    <a href="#!" data-modal-target="overviewMember{{ $member->id }}" class="flex items-center gap-3">
                                        <div class="size-6 rounded-full shrink-0 bg-slate-100">
                                            <img src="{{ $member->profile_photo_path ? URL::asset('storage/' . $member->profile_photo_path ): URL::asset('build/images/users/avatar-1.png') }}" alt=""
                                                class="h-6 rounded-full">
                                        </div>
                                        <h6 class="grow">{{ $member->firstname }} {{ $member->lastname }}</h6>
                                    </a>
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

                            {{-- Overview Member modal--}}
                            <div id="overviewMember{{ $member->id }}" modal-center
                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                                        <div class="float-right">
                                            <button data-modal-close="overviewMember{{ $member->id }}"
                                                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500"><i
                                                    data-lucide="x" class="size-5"></i></button>
                                        </div>

                                        <div
                                            class="relative flex items-center justify-center size-24 mx-auto text-lg rounded-full bg-slate-100 dark:bg-zink-600">
                                            <img src="{{ $member->profile_photo_path ? URL::asset('storage/' . $member->profile_photo_path ): URL::asset('build/images/users/avatar-1.png') }}" alt=""
                                                class="size-24 rounded-full">
                                            <span
                                                class="absolute size-3 bg-green-400 border-2 border-white rounded-full dark:border-zink-700 bottom-1 ltr:right-1 rtl:left-1"></span>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <h5 class="mb-1 text-16"><a href="{{ url('pages-account') }}">{{ $member->fisrtname }} {{ $member->lastname }}</a></h5>
                                            <p class="mb-3 text-slate-500 dark:text-zink-200">{{ $member->ref }}, {{ $member->sec_ref }}</p>
                                            <p class="text-slate-500 dark:text-zink-200">
                                                <i data-lucide="user" class="size-4"></i>{{ $member->commune }}</p>
                                        </div>
                                        <div class="flex gap-2 mt-5">
                                            <a href="{{ url('apps-chat') }}"
                                                class="bg-white text-custom-500 btn border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:bg-zink-700 dark:hover:bg-custom-500 dark:ring-custom-400/20 dark:focus:bg-custom-500 grow"><i
                                                    data-lucide="wallet" class="inline-block size-4 ltr:mr-1 rtl:ml-1"></i> <span
                                                    class="align-middle">Insérer le paiement</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end delete modal-->

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

                            {{-- Edit Member modal --}}
                            <div id="editMemberModal{{ $member->id }}" modal-center
                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
                                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                        <h5 class="text-16" id="addMemberLabel">Modification du membre</h5>
                                        <button data-modal-close="editMemberModal{{ $member->id }}" id="addMember"
                                            class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x"
                                                class="size-5"></i></button>
                                    </div>
                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                        <form class="create-form" action="{{ route('members.store') }}" id="create-form" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $member->id }}" name="id" id="id">
                                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                                <div class="xl:col-span-12">
                                                    <div
                                                        class="relative size-24 mx-auto mb0 rounded-full shadow-md bg-slate-100 profile-user dark:bg-zink-500">
                                                        <img src="{{ $member->profile_photo_path ? URL::asset('storage/' . $member->profile_photo_path) :
                                                            URL::asset('build/images/users/user-dummy-img.jpg') }}" alt=""
                                                            class="object-cover w-full h-full rounded-full user-profile-image">
                                                        <div
                                                            class="absolute bottom-0 flex items-center justify-center size-8 rounded-full ltr:right-0 rtl:left-0 profile-photo-edit">
                                                            <input id="profile-img" name="profile-img" type="file"
                                                                class="hidden profile-img">
                                                            <label for="profile-img"
                                                                class="flex items-center justify-center size-8 bg-white rounded-full shadow-lg cursor-pointer dark:bg-zink-600 profile-photo-edit">
                                                                <i data-lucide="image-plus"
                                                                    class="size-4 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="xl:col-span-12">
                                                    <label for="ref" class="inline-block mb0 text-base font-medium">Référence Member</label>
                                                    <input type="text" id="ref" name="ref"
                                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                        value="{{ $member->ref }}" required>
                                                </div>

                                                <div class="xl:col-span-12">
                                                    <label for="sec_ref" class="inline-block mb0 text-base font-medium">Référence sécondaire(optionnal)</label>
                                                    <input type="text" id="sec_ref" name="sec_ref"
                                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                        value="{{ $member->sec_ref }}" required>
                                                </div>
                                                <div class="xl:col-span-12">
                                                    <label for="firstname" class="inline-block mb0 text-base font-medium">Nom</label>
                                                    <input type="text" id="firstname" name="firstname"
                                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                        placeholder="Nom du menbre" value="{{ $member->firstname }}" required>
                                                </div>
                                                <div class="xl:col-span-12">
                                                    <label for="lastname" class="inline-block mb0 text-base font-medium">PostNom</label>
                                                    <input type="text" id="lastname" name="lastname"
                                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                        placeholder="Postnom du mebre" value="{{ $member->lastname }}" require >
                                                </div>
                                                <div class="xl:col-span-12">
                                                    <label for="commune" class="inline-block mb0 text-base font-medium">Commune</label>
                                                    <input type="text" id="commune" name="commune"
                                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                        placeholder="Localisation" required value="{{ $member->commune }}">
                                                </div>
                                            </div>


                                            <div class="flex justify-end gap-2 mt-4">
                                                <button type="reset" id="close-modal" data-modal-close="editMemberModal{{ $member->id }}"
                                                    class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Annuler</button>
                                                <button type="submit" id="addNew"
                                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--end add Member-->

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

    <div id="addMemberModal" modal-center
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                <h5 class="text-16" id="addMemberLabel">Ajout d'un membre</h5>
                <button data-modal-close="addMemberModal" id="addMember"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x"
                        class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <form class="create-form" action="{{ route('members.store') }}" id="create-form" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <div class="xl:col-span-12">
                            <div
                                class="relative size-24 mx-auto mb0 rounded-full shadow-md bg-slate-100 profile-user dark:bg-zink-500">
                                <img src="{{ URL::asset('build/images/users/user-dummy-img.jpg') }}" alt=""
                                    class="object-cover w-full h-full rounded-full user-profile-image-2">
                                <div
                                    class="absolute bottom-0 flex items-center justify-center size-8 rounded-full ltr:right-0 rtl:left-0 profile-photo-edit">
                                    <input id="profile-img-2" name="profile-img" type="file"
                                        class="hidden profile-img-2">
                                    <label for="profile-img-2"
                                        class="flex items-center justify-center size-8 bg-white rounded-full shadow-lg cursor-pointer dark:bg-zink-600 profile-photo-edit">
                                        <i data-lucide="image-plus"
                                            class="size-4 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="employeeId" class="inline-block mb0 text-base font-medium">Référence Member</label>
                            <input type="text" id="employeeId" name="ref"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                value="" required>
                        </div>

                        <div class="xl:col-span-12">
                            <label for="employeeId" class="inline-block mb0 text-base font-medium">Référence sécondaire(optionnal)</label>
                            <input type="text" id="employeeId" name="sec_ref"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                value="" required>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="employeeInput" class="inline-block mb0 text-base font-medium">Nom</label>
                            <input type="text" id="employeeInput" name="firstname"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Nom du menbre" required>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="emailInput" class="inline-block mb0 text-base font-medium">PostNom</label>
                            <input type="text" id="emailInput" name="lastname"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Postnom du mebre" require >
                        </div>
                        <div class="xl:col-span-12">
                            <label for="locationInput" class="inline-block mb0 text-base font-medium">Commune</label>
                            <input type="text" id="locationInput" name="commune"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Localisation" required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="close-modal" data-modal-close="addMemberModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Annuler</button>
                        <button type="submit" id="addNew"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">
                            Ajouter le membre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!--end add Member-->

@endsection
@push('scripts')
    <!-- list js-->
    <script src="{{ URL::asset('build/libs/list.js/list.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/apps-ecommerce-product.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/apps-hr-employee.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endpush
