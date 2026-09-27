@extends('layouts.app')

@section('title', __('auth.phone_title'))

@section('content')
    <section class="w-full">
        <a href="{{ route('login') }}" class="text-2xl font-bold tracking-tight text-emerald-800">Kerla</a>
        <h1 class="mt-8 text-2xl font-semibold">{{ __('auth.phone_title') }}</h1>
        <p class="mt-2 text-sm text-slate-600">{{ __('auth.phone_description') }}</p>

        <form method="POST" action="{{ route('auth.request-code') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="phone" class="mb-2 block text-sm font-medium">{{ __('auth.phone_label') }}</label>
                <input id="phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" required
                    value="{{ old('phone') }}" placeholder="+7 900 000-00-00"
                    class="w-full rounded border border-slate-300 bg-white px-4 py-3 text-base outline-none focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/20">
                @error('phone')
                    <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <p class="text-sm text-slate-600">{{ __('auth.captcha_stub') }}</p>
            <button type="submit" class="w-full rounded bg-emerald-800 px-4 py-3 font-semibold text-white hover:bg-emerald-900">
                {{ __('auth.send_code') }}
            </button>
        </form>
    </section>
@endsection