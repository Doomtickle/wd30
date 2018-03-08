<div class="md:max-w-md mx-auto my-auto text-center flex flex-col items-center">
    <div class="p-4">
        <img class="h-24 -mt-6" src="https://beachybeach.com/wp-content/themes/kmaidx/img/beachy-beach-logo.png" alt="Beachy Beach Real Estate" >
    </div>
    <form class="bg-white shadow-md md:rounded px-8 pt-6 pb-8 align-top flex flex-wrap h-auto" action="/property-search" method="GET">
        {{ csrf_field() }}
        <omni-bar class="flex-auto relative px-2 py-2 w-full sm:w-full md:w-3/5 text-left"></omni-bar>
        <property-type class="flex-auto relative px-2 py-2 w-full sm:w-1/3 md:w-2/5"></property-type>
        <min-price-field class="flex-auto relative px-2 py-2 w-full sm:w-1/3 md:w-2/5"></min-price-field>
        <max-price-field class="flex-auto relative px-2 py-2 w-full sm:w-1/3 md:w-2/5"></max-price-field>
        <div class="flex-auto px-2 py-2 xs:w-full w-full md:w-1/5">
            <button class="button-brand w-full h-10" type="submit" >Submit</button>
        </div>
    </form>
</div>