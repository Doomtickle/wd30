@extends('layouts.app')
@section('content')
    <section class="flex hero lg:h-16 bg-brand-darker py-4 bg-image-full" style="background-image: url('{{ $header_photo_path }}')">
        <div class="container mx-auto text-center md:text-left">
            <h1 class="text-white">Property Search</h1>
        </div>
    </section>
    <property-search
        :initial-search-terms="{{ $searchParams }}"
        :initial-search-results="{{ $properties }}"
        :google-key="'{{ config('google.api_key') }}'"
        :data-map-module="'{{ config('modules.map_search') }}'"
    >
    </property-search>
    <div class="container mx-auto">
        @include('partials.disclaimer')
    </div>
    @include('partials.contact')
@endsection