@extends('layouts.app')

@section('title', __('auth.register_title'))

@section('content')
    <section class="w-full">
        <a href="{{ route('login') }}" class="text-2xl font-bold tracking-tight text-emerald-800">Kerla</a>
        <h1 class="mt-8 text-2xl font-semibold">{{ __('auth.register_title') }}</h1>
        <p class="mt-2 text-sm text-slate-600">{{ __('auth.register_description') }}</p>

        <form method="POST" action="{{ route('auth.complete-registration') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="name" class="mb-2 block text-sm font-medium">{{ __('auth.name_label') }}</label>
                <input id="name" name="name" type="text" autocomplete="nickname" required maxlength="60"
                    value="{{ old('name') }}"
                    class="w-full rounded border border-slate-300 bg-white px-4 py-3 text-base outline-none focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/20">
                @error('name')
                    <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <fieldset class="space-y-4">
                <legend class="sr-only">{{ __('auth.consents_heading') }}</legend>
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="terms" value="1" required class="mt-1 size-4 accent-emerald-800">
                    <span>{{ __('auth.accept_terms') }} <a href="{{ route('terms') }}" target="_blank" class="underline underline-offset-2">{{ __('auth.terms_link') }}</a></span>
                </label>
                @error('terms')
                    <p class="text-sm text-red-700">{{ $message }}</p>
                @enderror
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="pd_processing" value="1" required class="mt-1 size-4 accent-emerald-800">
                    <span>{{ __('auth.accept_pd') }} <a href="{{ route('consent') }}" target="_blank" class="underline underline-offset-2">{{ __('auth.pd_link') }}</a></span>
                </label>
                @error('pd_processing')
                    <p class="text-sm text-red-700">{{ $message }}</p>
                @enderror
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="age_confirmation" value="1" required class="mt-1 size-4 accent-emerald-800">
                    <span>{{ __('auth.confirm_age') }}</span>
                </label>
                @error('age_confirmation')
                    <p class="text-sm text-red-700">{{ $message }}</p>
                @enderror
            </fieldset>

            <button type="submit" class="w-full rounded bg-emerald-800 px-4 py-3 font-semibold text-white hover:bg-emerald-900">
                {{ __('auth.create_account') }}
            </button>
        </form>
    </section>
@endsection