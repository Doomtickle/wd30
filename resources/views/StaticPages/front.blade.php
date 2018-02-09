@extends('layouts.app')
@section('content')
    <section class="flex hero lg:h-64 bg-brand-darker py-4 bg-image-full" style="background-image: url('https://beachybeach.com/wp-content/themes/kmaidx/img/beachy-illustration.jpg')">
        @include('partials.quick-search')
    </section>
    <section id="about" class="about bg-white py-8 lg:py-16 xl:py-24">
        <div class="container mx-auto py-2">
            <div class="flex flex-wrap items-center">
                <div class="flex-auto w-full md:w-3/4 px-3 py-2 text-center md:text-left">
                    <h1 class="mb-4 text-secondary-lighter">Panama City Beach Real Estate Experts, Ron & Karen Branham</h1>
                    <p class="leading-normal text-grey-darker">Ron and Karen Branham have a simple philosophy – provide “EXCEPTIONAL SERVICE TO EVERYONE THAT WALKS THROUGH THE FRONT DOOR!” They know the market well and have over 20 years experience. Karen and Ron also work closely with numerous local builders to help you find or build that perfect beach home! Whether you are ready to make the move, or just need some great advice, give Ron and Karen a call today!</p>
                    <a href="/property-search/" class="button-brand w-auto mt-4 no-underline" >Property Search</a>
                </div>
                <div class="flex-auto w-full md:w-1/4 px-3 justify-center text-center py-2">
                    <img src="{{ $realtor->avatar->path ?? 'http://via.placeholder.com/350x350' }}" class="border border-grey-darker rounded inline-block" >
                </div>
            </div>
        </div>
    </section>
    <section id="featured-listings" class="featured-listings bg-brand-dark py-8 lg:py-16 xl:py-24">
        <div class="container mx-auto py-2">
            @if(count($realtor->listings) > 0)
            <h2 class="text-white text-center pb-4 text-3xl">{{ $realtor->name }}'s Listings</h2>
            <div class="flex flex-wrap items-center justify-center">
                @foreach ($realtor->listings as $listing)
                    @include('partials.mini-listing')
                @endforeach
            </div>
            @else
                <h2 class="text-white text-center pb-4">Check back later for my featured listings!</h2>
            @endif
        </div>
    </section>
    @include('partials.contact')
@endsection