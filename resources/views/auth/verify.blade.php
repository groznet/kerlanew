@extends('layouts.app')

@section('title', __('auth.verify_title'))

@section('content')
    <section class="w-full">
        <a href="{{ route('login') }}" class="text-2xl font-bold tracking-tight text-emerald-800">Kerla</a>
        <h1 class="mt-8 text-2xl font-semibold">{{ __('auth.verify_title') }}</h1>
        <p class="mt-2 text-sm text-slate-600">{{ __('auth.verify_description', ['phone' => $phone]) }}</p>

        @if (session('status'))
            <p class="mt-4 text-sm text-emerald-800">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('auth.verify-code') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="code" class="mb-2 block text-sm font-medium">{{ __('auth.code_label') }}</label>
                <input id="code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code" required
                    minlength="4" maxlength="6" pattern="[0-9]{4,6}"
                    class="w-full rounded border border-slate-300 bg-white px-4 py-3 text-base tracking-widest outline-none focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/20">
                @error('code')
                    <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full rounded bg-emerald-800 px-4 py-3 font-semibold text-white hover:bg-emerald-900">
                {{ __('auth.verify_button') }}
            </button>
        </form>
    </section>
@endsection