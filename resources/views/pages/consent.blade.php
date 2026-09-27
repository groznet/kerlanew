@extends('layouts.app')

@section('title', __('documents.consent_title'))

@section('content')
    <article class="w-full space-y-5">
        <a href="{{ route('login') }}" class="text-2xl font-bold tracking-tight text-emerald-800">Kerla</a>
        <h1 class="text-2xl font-semibold">{{ __('documents.consent_title') }}</h1>
        <p class="text-sm text-slate-600">{{ __('documents.version', ['version' => config('consents.pd_processing_version')]) }}</p>
        <p class="leading-7">{{ __('documents.consent_body') }}</p>
        <a href="{{ route('login') }}" class="inline-block font-medium underline underline-offset-2">{{ __('documents.back') }}</a>
    </article>
@endsection