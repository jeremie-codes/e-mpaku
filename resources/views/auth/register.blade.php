@extends('layouts.master-without-nav')
@section('title')
    {{ __('Offline') }}
@endsection
@section('content')

<body class="flex items-center justify-center min-h-screen py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark font-public">

    <div class="mb-0 border-none shadow-none lg:w-[500px] card bg-white/70 dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            
            <div class="mt-10">
                <img src="{{ URL::asset('build/images/auth/offline.png') }}" alt="" class="mx-auto h-72">
            </div>
            <div class="mt-8 text-center">
                <h4 class="mb-2 text-purple-500">
                    Access Interdit
                </h4>
                <p class="mb-6 text-slate-500 dark:text-zink-200">Vous n'êtes pas autorisé à voir cette page !</p>
              
            </div>
        </div>
    </div>

@endsection