@extends('layouts.app')
@section('content')
    @include('partials.property.header')
    <div class="full-listing py-8">
        <div class="container mx-auto text-center md:text-left xl:px-24">
            <div class="flex flex-wrap">
                <div class="listing-photos flex flex-col flex-wrap w-full lg:w-1/2 lg:px-4 py-4">
                    @include('partials.property.photos')
                </div>
                <div class="listing-details w-full lg:w-1/2 lg:px-4 py-4">
                    @include('partials.property.actionbuttons')
                    @include('partials.property.info')
                    @if($property->has_open_houses)
                        @include('partials.property.openhouses')
                    @endif
                    @include('partials.property.features')
                </div>
                <div class="listing-features w-full py-4 lg:px-4">
                    @if(count($features) > 0)
                        <div class="flex flex-wrap justify-start">
                            @foreach ($features as $key => $value)
                                @include('partials.feature')
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="listing-location w-full py-4 lg:px-4">
                    @include('partials.property.infotable')
                </div>
                <div class="listing-map w-full px-1 lg:px-4">
                    <div class="border-b-2 border-secondary-light mx-1 my-4 shadow">
                        <google-map :latitude="{{ $property->latitude }}" :longitude="{{ $property->longitude }}" :zoom="15" api="{{ config('google.api_key') }}" />
                    </div>
                </div>
                @include('partials.disclaimer')
            </div>
        </div>
    </div>
    @include('partials.contact')
@endsection