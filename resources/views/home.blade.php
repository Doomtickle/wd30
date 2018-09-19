@extends('layouts.dashboard')

@section('top')
<div class="container flex flex-wrap mx-auto justify-between py-8">
    <welcome-card
        class="flex static w-full bg-transparent md:bg-white items-center text-center mx-2 rounded-b flex-wrap shadow"
        :boilerplate="boilerplate"
        :data-user="user"
        :active-leads-count="activeLeadsCount"
        :avatar-path="'{{ $avatarPath }}'"
        >
    </welcome-card>
</div>
@endsection

@section('content')
<div class="bg-brand mx-auto">
    <div class="bg-brand-darker">
        <div class="container flex flex-wrap w-full items-center justify-around mx-auto text-xl text-center">
            <a
                href="#"
                class="w-1/4 no-underline text-white font-brand py-2 text-center text-xl"
                :class="{'bg-brand': selected == 'leads'}"
                @click="selected ='leads'"
                >
                My <span class="md:hidden clearfix"></span>Leads
            </a>
            <a
                href="#"
                class="w-1/4 no-underline text-white font-brand py-2 text-center text-xl"
                :class="{'bg-brand': selected == 'properties'}"
                @click="selected = 'properties'"
                >
                My <span class="md:hidden clearfix"></span>Properties
            </a>
            <a
                href="#"
                class="w-1/4 no-underline text-white font-brand py-2 text-center text-xl"
                :class="{'bg-brand': selected == 'settings'}"
                @click="selected = 'settings'"
                >
                Site <span class="md:hidden clearfix"></span>Content
            </a>
            <a
                v-if="'{{ config('modules.blog') }}'"
                href="#"
                class="w-1/4 no-underline text-white font-brand py-2 text-center text-xl"
                :class="{'bg-brand': selected == 'blog'}"
                @click="selected = 'blog'"
                >
                My <span class="md:hidden clearfix"></span>Blog
            </a>
        </div>
    </div>
    <div class="px-2 pt-4">
        <leads
            v-if="selected === 'leads'"
            v-on:update-leads-count="updateLeadsCount"
            class="container mx-auto"
            ></leads>
        <my-properties
            v-if="selected === 'properties'"
            :user="user"
            class="container mx-auto flex flex-wrap justify-center items-start pt-2"
            ></my-properties>
        <bio-card
            :data-user="user"
            :data-content="content"
            v-on:submit-button-clicked="sbc"
            v-if="selected === 'settings'"
            class="container mx-auto bg-white flex flex-wrap justify-center mb-8 mt-4"
            ></bio-card>
        <content-card
            :data-content="content"
            header-photo-path="{{ $headerPhoto }}"
            v-if="selected === 'settings'"
            v-on:content-edited="updateContent"
            ></content-card>
        <seo-card
            v-if="selected === 'settings'"
            :site-url="'{{ config('app.url') }}'"
            >
        </seo-card>
        <social-card
            v-if="selected === 'settings'"
            :data-user="user"
            v-on:submit-button-clicked="sbc"
            class="container mx-auto bg-white flex flex-wrap justify-center mb-8 mt-4"
            >
        </social-card>
        <kma-blog v-if="selected === 'blog'"></kma-blog>
    </div>
</div>
</div>
@endsection
