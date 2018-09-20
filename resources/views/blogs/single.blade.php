@extends('layouts.app')

@section('content')
    <div class="container mx-auto flex flex-wrap pt-32">
        <div class="w-full flex justify-center items-center">
            <img src="{{ asset('storage/' . $blog->featured_photo_path) }}" alt="">
        </div>
        <h1 class="w-full text-center font-brand">{{ $blog->title }}</h1>
        <p class="w-full text-xl">{{ $blog->body }}</p>
    </div>
@endsection
