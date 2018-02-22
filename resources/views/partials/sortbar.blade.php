<div class="flex flex-wrap justify-center md:justify-between items-center">
    <div class="w-auto flex-grow">
        <p class="py-4 px-2 text-center md:text-left text-grey-darker">
            Showing {{ number_format($properties->from) }} - {{ number_format($properties->to) }} of {{ number_format($properties->total) }} results
        </p>
    </div>
    <div class="w-auto flex-grow text-right">
        <div class="flex items-center justify-center md:justify-end pr-2">
            <div class="label text-grey-darker px-2">Sort By:</div>
            <div class="flex items-center bg-grey rounded hover:bg-grey-dark">
                {{-- this needs to be a vue component --}}
                <form action="/property-search" method="GET" class="flex justify-center items-center md:justify-end">
                    @include('partials.sortbuttons')
                    <input type="hidden" name="sortBy" value="date_modified">
                    <input type="hidden" name="orderBy" value="DESC">
                    {{-- TODO: extract this in the controller and pass a boolean --}}
                    <button
                        class="@if(!isset($_GET['sortBy']) || (isset($_GET['sortBy']) && $_GET['sortBy'] == 'date_modified')) button-grey-darker @else button-grey @endif h-8 w-auto" type="submit" >Modified</button>
                </form>
                <form action="/property-search" method="GET" class="flex justify-center items-center md:justify-end">
                    @include('partials.sortbuttons')
                    <input type="hidden" name="sortBy" value="price">
                    <input type="hidden" name="orderBy" value="ASC">
                    {{-- TODO: extract this in the controller and pass a boolean --}}
                    <button class="@if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'price') button-grey-darker @else button-grey @endif h-8 w-auto" type="submit" >Price</button>
                </form>
            </div>
        </div>
    </div>
</div>