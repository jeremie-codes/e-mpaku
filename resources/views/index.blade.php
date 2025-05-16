@extends('layouts.master')
@section('title')
    {{ __('Analytics') }}
@endsection
@section('content')
    <!-- page title -->
    <x-page-title title="Analytics" pagetitle="Dashboards" />

    <div class="grid grid-cols-12 gap-x-5">
        <div
            class="order-1 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-white dark:bg-sky-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-sky-500/20 relative overflow-hidden">
            <div class="card-body text-center">
                <div class="lg:col-span-2 2xl:col-span-1">
                    <div
                        class="relative inline-block size-20 rounded-full shadow-md bg-slate-100 profile-user xl:size-28">
                        <img src="{{ $user->profile_photo_path ? URL::asset('storage/' . $user->profile_photo_path ): URL::asset('build/images/users/avatar-9.png') }}" alt=""
                            class="object-cover border-0 rounded-full img-thumbnail user-profile-image">
                    </div>
                </div>
                <div class="lg:col-span-10 2xl:col-span-9">
                    <h5 class="mb-1">{{ $user->name }} <i data-lucide="badge-check"
                            class="inline-block size-4 text-sky-500 fill-sky-100 dark:fill-custom-500/20"></i></h5>
                    <div class="flex gap items-center justify-center">
                        <i data-lucide="mail"
                            class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                        <p class="text-slate-500 dark:text-zink-200">
                            {{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div><!--end col-->
        <div
            class="order-2 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-green-100 dark:bg-green-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-green-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 size-32 stroke-1 text-green-200/50 dark:text-green-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center size-12 bg-green-500 rounded-md text-15 text-green-50">
                    <i data-lucide="users"></i>
                </div>
                <h5 class="mt-5 mb-2"><span class="counter-value" data-target="{{ $membres->count() }}">0</span></h5>
                <p class="text-slate-500 dark:text-slate-200">Total Membres</p>
            </div>
        </div><!--end col-->
        <div
            class="order-3 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-orange-100 dark:bg-orange-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-orange-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="list-filter"
                    class="absolute top-0 size-32 stroke-1 text-orange-200/50 dark:text-orange-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center size-12 bg-orange-500 rounded-md text-15 text-orange-50">
                    <i data-lucide="wallet"></i>
                </div>
                <h5 class="mt-5 mb-2"><span class="counter-value" data-target="{{ $sommeByDate }}">0</span> CDF</h5>
                <p class="text-slate-500 dark:text-slate-200">Somme Journalière</p>
            </div>
        </div><!--end col-->
        <div
            class="order-4 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-purple-100 dark:bg-purple-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-purple-500/20 relative overflow-hidden">
            <div class="card-body">
                <i data-lucide="kanban"
                    class="absolute top-0 size-32 stroke-1 text-purple-200/50 dark:text-purple-500/20 ltr:-right-10 rtl:-left-10"></i>
                <div class="flex items-center justify-center size-12 bg-purple-500 rounded-md text-15 text-purple-50">
                    <i data-lucide="wallet"></i>
                </div>
                <h5 class="mt-5 mb-2"><span class="counter-value" data-target="{{ $sommeGlobal }}">0</span> CDF</h5>
                <p class="text-slate-500 dark:text-slate-200">Somme Globale</p>
            </div>
        </div><!--end col-->
        <div class="order-7 col-span-12 2xl:order-1 card 2xl:col-span-7">
            <div class="card-body">
                <div class="flex items-center gap-2">
                    <h6 class="mb-3 text-15 grow">Paiement Progression</h6>
                    <div class="relative dropdown shrink-0">
                        <button type="button"
                            class="px-2 py-1.5 text-xs bg-text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20 dropdown-toggle"
                            id="emailDataDropdown" data-bs-toggle="dropdown">
                            This Yearly <i data-lucide="chevron-down" class="inline-block size-4 ltr:ml-1 rlt:mr-1"></i>
                        </button>

                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                            aria-labelledby="emailDataDropdown">
                            <li>
                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                    href="#!">1 Weekly</a>
                            </li>
                            <li>
                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                    href="#!">1 Monthly</a>
                            </li>
                            <li>
                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                    href="#!">3 Monthly</a>
                            </li>
                            <li>
                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                    href="#!">6 Monthly</a>
                            </li>
                            <li>
                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                    href="#!">This Yearly</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="pagesInteraction" class="apex-charts" data-chart-colors='["bg-custom-500", "bg-purple-500"]'
                    dir="ltr"></div>
            </div>
        </div><!--end col-->

    </div>
@endsection
@push('scripts')
    <!--apexchart js-->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

    <!--dashboard analytics init js-->
    <script src="{{ URL::asset('build/js/pages/dashboards-analytics.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endpush
