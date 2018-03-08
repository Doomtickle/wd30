<template>
    <div>
        <select
            name="acreage"
            class="block shadow appearance-none w-full border rounded text-grey-darker hover:border-grey h-10 px-3 py-2 pr-8"
        >
            <option value="">Acreage</option>
            <option value=".5" >1/2 or more</option>
            <option value="1" >1 or more</option>
            <option value="2" >2 or more</option>
            <option value="5" >5 or more</option>
            <option value="10" >10 or more</option>
        </select>
        <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
            <svg
                    class="fill-current h-4 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    style="enable-background:new 0 0 20 20; width: 20px;"
                    xml:space="preserve"
            >
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
            </svg>
        </div>
    </div>
</template>