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
            <div class="container flex w-full items-center justify-around mx-auto text-xl text-center">
                <a
                        href="#"
                        class="w-1/3 no-underline text-white font-brand py-2 text-center text-xl"
                        :class="{'bg-brand': selected == 'leads'}"
                        @click="selected ='leads'"
                >
                    My <span class="md:hidden clearfix"></span>Leads
                </a>
                <a
                        href="#"
                        class="w-1/3 no-underline text-white font-brand py-2 text-center text-xl"
                        :class="{'bg-brand': selected == 'properties'}"
                        @click="selected = 'properties'"
                >
                    My <span class="md:hidden clearfix"></span>Properties
                </a>
                <a
                        href="#"
                        class="w-1/3 no-underline text-white font-brand py-2 text-center text-xl"
                        :class="{'bg-brand': selected == 'settings'}"
                        @click="selected = 'settings'"
                >
                    Site <span class="md:hidden clearfix"></span>Settings
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
        </div>
    </div>
</div>
@endsection

{{-- @section('help')
    <button class="px-4 py-4 relative pin-b pin-r z-50 text-brand-darkest">
        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-help-circle fixed pin-b pin-r p-4">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
            <line x1="12" y1="17" x2="12" y2="17"></line>
        </svg>
    </button>
@endsection --}}