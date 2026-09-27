@extends('layouts.app')

@section('title', __('documents.terms_title'))

@section('content')
    <article class="w-full space-y-5">
        <a href="{{ route('login') }}" class="text-2xl font-bold tracking-tight text-emerald-800">Kerla</a>
        <h1 class="text-2xl font-semibold">{{ __('documents.terms_title') }}</h1>
        <p class="text-sm text-slate-600">{{ __('documents.version', ['version' => config('consents.terms_version')]) }}</p>
        <p class="leading-7">{{ __('documents.terms_body') }}</p>
        <a href="{{ route('login') }}" class="inline-block font-medium underline underline-offset-2">{{ __('documents.back') }}</a>
    </article>
@endsection