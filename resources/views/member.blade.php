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
    <x-page-title title="List View" pagetitle="Products" />

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
                    <a href="#!" data-modal-target="addEmployeeModal" type="button"
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
                                    <a href="{{ url('members.show') }}"
                                        class="transition-all duration-150 ease-linear product_code text-custom-500 hover:text-custom-600">{{ $member->ref }}</a>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    <a href="{{ url('members.show') }}"
                                        class="transition-all duration-150 ease-linear product_code text-custom-500 hover:text-custom-600">{{ $member->sec_ref }}</a>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 product_name">
                                    <a href="{{ url('members.show') }}" class="flex items-center gap-3">
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
                                            href="{{ url('members.show') }}"><i data-lucide="eye"
                                                class="inline-block size-3"></i> </a>
                                        <a href="#!" data-modal-target="addEmployeeModal"
                                            class="flex items-center justify-center size-8 transition-all duration-200 ease-linear rounded-md edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                data-lucide="pencil" class="size-4"></i></a>
                                        <a href="#!" data-modal-target="deleteModal"
                                            class="flex items-center justify-center size-8 transition-all duration-200 ease-linear rounded-md remove-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i
                                                data-lucide="trash-2" class="size-4"></i></a>
                                    </div>
                                </td>
                            </tr>
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
                    <p class="text-slate-500 dark:text-zink-200">Showing <b class="showing">10</b> of <b
                            class="total-records">38</b> Results</p>
                </div>

                <div class="col-sm-auto mt-sm-0">
                    <div class="flex gap-2 pagination-wrap justify-content-center">
                        <a class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto page-item pagination-prev "
                            href="javascript:void(0)">
                            <i class="size-4 mr-1 rtl:rotate-180" data-lucide="chevron-left"></i> Prev
                        </a>
                        <ul class="flex flex-wrap items-center gap-2 pagination listjs-pagination">
                        </ul>
                        <a class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto page-item pagination-next"
                            href="javascript:void(0)">
                            Next <i class="size-4 ml-1 rtl:rotate-180" data-lucide="chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div><!--end card-->


    <div id="deleteModal" modal-center
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto px-6 py-8">
                <div class="float-right">
                    <button data-modal-close="deleteModal"
                        class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500"><i
                            data-lucide="x" class="size-5"></i></button>
                </div>
                <img src="{{ URL::asset('build/images/delete.png') }}" alt="" class="block h-12 mx-auto">
                <div class="mt-5 text-center">
                    <h5 class="mb-1">Êtes-vous sûre?</h5>
                    <p class="text-slate-500 dark:text-zink-200">Vous êtes sur le point de supprimer ce membre!</p>
                    <div class="flex justify-center gap-2 mt-6">
                        <button type="reset" data-modal-close="deleteModal"
                            class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">Annuler</button>
                        <button type="submit"
                            class="text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">
                            Oui, Supprimer!</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end delete modal-->

    <div id="addEmployeeModal" modal-center
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                <h5 class="text-16" id="addEmployeeLabel">Add Employee</h5>
                <button data-modal-close="addEmployeeModal" id="addEmployee"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x"
                        class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <form class="create-form" id="create-form">
                    <input type="hidden" value="" name="id" id="id">
                    <input type="hidden" value="add" name="action" id="action">
                    <input type="hidden" id="id-field">
                    <div id="alert-error-msg"
                        class="hidden px-4 py-3 text-sm text-red-500 border border-transparent rounded-md bg-red-50 dark:bg-red-500/20">
                    </div>
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <div class="xl:col-span-12">
                            <div
                                class="relative size-24 mx-auto mb-4 rounded-full shadow-md bg-slate-100 profile-user dark:bg-zink-500">
                                <img src="{{ URL::asset('build/images/users/user-dummy-img.jpg') }}" alt=""
                                    class="object-cover w-full h-full rounded-full user-profile-image">
                                <div
                                    class="absolute bottom-0 flex items-center justify-center size-8 rounded-full ltr:right-0 rtl:left-0 profile-photo-edit">
                                    <input id="profile-img-file-input" name="profile-img-file-input" type="file"
                                        class="hidden profile-img-file-input">
                                    <label for="profile-img-file-input"
                                        class="flex items-center justify-center size-8 bg-white rounded-full shadow-lg cursor-pointer dark:bg-zink-600 profile-photo-edit">
                                        <i data-lucide="image-plus"
                                            class="size-4 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="employeeId" class="inline-block mb-2 text-base font-medium">Employee ID</label>
                            <input type="text" id="employeeId"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                value="" disabled>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="employeeInput" class="inline-block mb-2 text-base font-medium">Name</label>
                            <input type="text" id="employeeInput"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Employee name">
                        </div>
                        <div class="xl:col-span-12">
                            <label for="emailInput" class="inline-block mb-2 text-base font-medium">Email</label>
                            <input type="text" id="emailInput"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="example@tailwick.com" required>
                        </div>
                        <div class="xl:col-span-6">
                            <label for="phoneNumberInput" class="inline-block mb-2 text-base font-medium">Phone
                                Number</label>
                            <input type="text" id="phoneNumberInput"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter phone number" required>
                        </div>
                        <div class="xl:col-span-6">
                            <label for="locationInput" class="inline-block mb-2 text-base font-medium">Location</label>
                            <input type="text" id="locationInput"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter location" required>
                        </div>
                        <div class="xl:col-span-6">
                            <label for="joiningDateInput" class="inline-block mb-2 text-base font-medium">Joining
                                Date</label>
                            <input type="text" id="joiningDateInput"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Select date" data-provider="flatpickr" data-date-format="d M, Y">
                        </div>
                        <div class="xl:col-span-6">
                            <label for="experienceInput"
                                class="inline-block mb-2 text-base font-medium">Experience</label>
                            <input type="text" id="experienceInput"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="0.0" required>
                        </div>
                        <div class="xl:col-span-12">
                            <label for="designationSelect"
                                class="inline-block mb-2 text-base font-medium">Designation</label>
                            <select
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                data-choices data-choices-search-false name="designationSelect" id="typeSelect">
                                <option value="Angular Developer">Angular Developer</option>
                                <option value="React Developer">React Developer</option>
                                <option value="Project Manager">Project Manager</option>
                                <option value="Web Designer">Web Designer</option>
                                <option value="Team Leader">Team Leader</option>
                                <option value="VueJs Developer">VueJs Developer</option>
                                <option value="NodeJS Developer">NodeJS Developer</option>
                                <option value="ASP.Net Developer">ASP.Net Developer</option>
                                <option value="UI / UX Designer">UI / UX Designer</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="close-modal" data-modal-close="addEmployeeModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit" id="addNew"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ">Add
                            Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!--end add Employee-->
@endsection
@push('scripts')
    <!-- list js-->
    {{-- <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script> --}}
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/apps-ecommerce-product.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endpush
