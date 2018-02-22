
<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1 flex-grow" >
    <div class="card border-grey shadow h-full text-left">
        <div class="card-title py-2 px-4 bg-brand font-bold">
            <p class="text-white">{{ $key }}</p>
        </div>
        <div class="card-block p-2">
            <ul class="py-2 px-6">
            @if(count($value) > 0)
                @foreach ($value as $feature)
                    <li class="text-grey-darkest py-1">{{ $feature }}</li>
                @endforeach
            @endif
            </ul>
        </div>
    </div>
</div>