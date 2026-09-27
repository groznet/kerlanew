@extends('layouts.app')

@section('title', __('auth.account_title'))

@section('content')
    <section class="w-full">
        <a href="{{ route('login') }}" class="text-2xl font-bold tracking-tight text-emerald-800">Kerla</a>
        <h1 class="mt-8 text-2xl font-semibold">{{ __('auth.account_title') }}</h1>
        <p class="mt-2 text-sm text-slate-600">{{ __('auth.account_description', ['name' => auth()->user()->name]) }}</p>
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="rounded border border-slate-300 px-4 py-3 font-medium hover:bg-white">{{ __('auth.logout') }}</button>
        </form>
    </section>
@endsection