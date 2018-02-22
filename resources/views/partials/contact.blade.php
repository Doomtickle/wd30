<section id="contact" class="contact flex bg-brand-light py-8 lg:py-16 xl:py-24">
    <div class="w-full lg:max-w-lg mx-auto py-2 text-center">
        <h2 class="text-white text-center pb-4 text-3xl">Contact</h2>
        <p><a class="no-underline text-2xl text-white text-bold" href="tel:{{ $realtor->primary_phone }}" >{{ $realtor->primary_phone }}</a></p>
        <p class="text-lg text-white mt-4">{!! nl2br($realtor->address) !!}</p>
        <p class="text-lg text-white mt-4"><a class="text-white" href="mailto:{{ $realtor->email }}" >{{ $realtor->email }}</a></p>
        <form class="pt-6 pb-8 align-top flex flex-wrap" method="post" action="/leads" >
            {{ csrf_field() }}
            <div class="flex-auto relative px-2 py-2 w-full md:w-1/2">
                <input class="block shadow appearance-none w-full border rounded text-grey-darker hover:border-grey h-10 py-2 px-3 mb-4" type="text" name="name" placeholder="Name" >
                <input class="block shadow appearance-none w-full border rounded text-grey-darker hover:border-grey h-10 py-2 px-3 mb-4" type="text" name="email" placeholder="Email Address" >
                <input class="block shadow appearance-none w-full border rounded text-grey-darker hover:border-grey h-10 py-2 px-3" type="text" name="phone" placeholder="Phone Number" >
            </div>
            <div class="flex-auto relative px-2 py-2 w-full md:w-1/2">
                <textarea class="block shadow appearance-none w-full border rounded text-grey-darker hover:border-gray h-24 py-2 px-3 mb-4" name="message" ></textarea>
                <button class="button-secondary w-full h-10" type="submit" >Submit</button>
            </div>
        </form>
        <div class="social-agent mt-2 px-4 text-center">
            <a class="facebook" href="#" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-12" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">
                    <path fill="#43609C" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>
                    <path fill="#FFF" d="M12.9,14.13h1.76V12.42a4.57,4.57,0,0,1,.57-2.64A3.13,3.13,0,0,1,18,8.5a11.05,11.05,0,0,1,3.15.32l-.44,2.6a5.94,5.94,0,0,0-1.42-.21c-.68,0-1.3.25-1.3.93v2h2.8l-.2,2.54H18v8.84h-3.3V16.67H12.9Z"></path>
                </svg>
            </a>
            <a class="twitter" href="#" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-12" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">
                    <path fill="#79ccf0" class="container" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>
                    <path fill="#FFF" d="M25.54,12.55a7,7,0,0,1-2,.55,3.5,3.5,0,0,0,1.54-1.93,7,7,0,0,1-2.22.85,3.5,3.5,0,0,0-6,3.19,9.92,9.92,0,0,1-7.2-3.65,3.5,3.5,0,0,0,1.08,4.67,3.5,3.5,0,0,1-1.58-.44v0A3.5,3.5,0,0,0,12,19.25a3.41,3.41,0,0,1-.92.12,3.46,3.46,0,0,1-.66-.06,3.5,3.5,0,0,0,3.26,2.43A7.07,7.07,0,0,1,8.5,23.19a9.94,9.94,0,0,0,15.3-8.37c0-.15,0-.3,0-.45a7.09,7.09,0,0,0,1.74-1.81"></path>
                </svg>
            </a>
            {{--<a class="instagram" href="#" target="_blank">--}}
                {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-12" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">--}}
                    {{--<path fill="#E3415C" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>--}}
                    {{--<path fill="#FFF" d="M22.23,8.5H11.79a3.29,3.29,0,0,0-3.29,3.29V22.23a3.29,3.29,0,0,0,3.29,3.29H22.23a3.29,3.29,0,0,0,3.29-3.29V11.79A3.29,3.29,0,0,0,22.23,8.5Zm.94,2h.38v2.88H20.67V10.47Zm-8.59,4.8A3,3,0,1,1,14,17,3,3,0,0,1,14.58,15.26Zm9.27,7a1.63,1.63,0,0,1-1.63,1.63H11.79a1.63,1.63,0,0,1-1.63-1.63v-7H12.7a4.65,4.65,0,1,0,8.62,0h2.54Z"></path>--}}
                {{--</svg>--}}
            {{--</a>--}}
            {{--<a class="googleplus" href="#" target="_blank">--}}
                {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-12" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">--}}
                    {{--<path fill="#4b4b4c" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>--}}
                    {{--<path fill="#FFF" d="M14.19,24.63c-2,0-3.48-1.28-3.48-2.82s1.81-2.76,3.83-2.74a4.42,4.42,0,0,1,1.31.21C17,20,17.74,20.47,18,21.34a2.34,2.34,0,0,1,.06.54c0,1.54-1,2.74-3.83,2.74m.53-9c-1.36,0-2.65-1.52-2.88-3.3s.68-3.15,2-3.11,2.65,1.47,2.88,3.25-.68,3.19-2,3.15m2.81,2.64c-.48-.34-1.39-1.16-1.39-1.64s.16-.84,1-1.51a3.54,3.54,0,0,0,1.49-2.75,3.14,3.14,0,0,0-1.7-3h1.67l1.18-.85H14.54c-2.36,0-4.58,1.79-4.58,3.86a3.81,3.81,0,0,0,4,3.83h.49a2.15,2.15,0,0,0-.27,1,2,2,0,0,0,.72,1.46H14c-2.93,0-5.18,1.86-5.18,3.79s2.47,3.09,5.39,3.09c3.33,0,5.18-1.89,5.18-3.79a3.67,3.67,0,0,0-1.84-3.42m7.66-2.48H23.15V13.71H21.5v2.05H19.45v1.65H21.5v2.05h1.65V17.42H25.2Z"></path>--}}
                {{--</svg>--}}
            {{--</a>--}}
            {{--<a class="youtube" href="#" target="_blank">--}}
                {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-12" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">--}}
                    {{--<path fill="#e9644b" class="container" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>--}}
                    {{--<path fill="#FFF" d="M20.31,17l-5.57,3.27V13.75Zm5.2,3V14A2.87,2.87,0,0,0,22.58,11H11.43A2.87,2.87,0,0,0,8.5,14V20A2.87,2.87,0,0,0,11.43,23H22.58A2.87,2.87,0,0,0,25.51,20"></path>--}}
                {{--</svg>--}}
            {{--</a>--}}
            <a class="linkedin" href="#" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-12" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">
                    <path fill="#1385c8" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>
                    <path fill="#FFF" d="M12.25,24.12H8.93V13.51h3.32ZM10.51,12.18h0a1.84,1.84,0,0,1-2-1.84,1.86,1.86,0,0,1,2-1.84,1.85,1.85,0,1,1,0,3.68Zm15,11.94H21.75V18.63c0-1.44-.59-2.42-1.88-2.42a1.9,1.9,0,0,0-1.79,1.3,2.44,2.44,0,0,0-.08.87v5.74H14.27s0-9.73,0-10.61H18v1.67a3.4,3.4,0,0,1,3.31-1.77c2.36,0,4.21,1.53,4.21,4.81Z"></path>
                </svg>
            </a>
            {{--<a class="android" href="#" target="_blank">--}}
                {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-12" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">--}}
                    {{--<path fill="#d5e080" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>--}}
                    {{--<path fill="#fff" d="M19.55,10l.18-.28.18-.27.41-.62a.16.16,0,1,0-.27-.18l-.44.66-.19.28-.19.28a5.51,5.51,0,0,0-3.92,0l-.19-.28L15,9.29l-.44-.66a.16.16,0,0,0-.27.18l.41.62.18.27L15,10a3.74,3.74,0,0,0-2.34,3.29h9.22A3.74,3.74,0,0,0,19.55,10Zm-4.24,2a.49.49,0,1,1,.49-.49A.49.49,0,0,1,15.31,12Zm3.95,0a.49.49,0,1,1,.49-.49A.49.49,0,0,1,19.26,12Z"></path>--}}
                    {{--<path fill="#fff" d="M12.74,13.94h-.07v7.24a1,1,0,0,0,1,1h.75a1,1,0,0,0,0,.27v2.08a1,1,0,0,0,2,0V22.5a1,1,0,0,0,0-.27H18.2a1,1,0,0,0,0,.27v2.08a1,1,0,0,0,2,0V22.5a1,1,0,0,0,0-.27h.75a1,1,0,0,0,1-1V13.94H12.74Z"></path>--}}
                    {{--<path fill="#fff" d="M11,13.94a1,1,0,0,0-1,1v4.22a1,1,0,0,0,2,0V14.92A1,1,0,0,0,11,13.94Z"></path>--}}
                    {{--<path fill="#fff" d="M23.54,13.94a1,1,0,0,0-1,1v4.22a1,1,0,0,0,2,0V14.92A1,1,0,0,0,23.54,13.94Z"></path>--}}
                {{--</svg>--}}
            {{--</a>--}}
            {{--<a class="ios" href="#" target="_blank">--}}
                {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-12" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">--}}
                    {{--<path fill="#7f807e" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>--}}
                    {{--<path fill="#fff" d="M24.31,21A12.21,12.21,0,0,1,23.21,23c-.72,1.09-1.73,2.45-3,2.46s-1.4-.73-2.91-.72-1.83.73-2.94.72-2.21-1.24-2.93-2.33c-2-3.05-2.22-6.64-1-8.55A4.44,4.44,0,0,1,14,12.49c1.33,0,2.16.73,3.26.73s1.71-.73,3.25-.73a4.34,4.34,0,0,1,3.27,1.72,3.74,3.74,0,0,0,.5,6.77Zm-4.93-9.72a3.73,3.73,0,0,0,.83-2.76,4,4,0,0,0-2.6,1.4,3.45,3.45,0,0,0-.85,2.69,3.4,3.4,0,0,0,2.62-1.33Z"></path>--}}
                {{--</svg>--}}
            {{--</a>--}}
        </div>
    </div>
</section>