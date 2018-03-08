<template>
    <div>
        <div class="w-full sm:w-1/6 border-right h-auto md:h-10 overflow-hidden">
            <div class="flex h-auto md:h-10 justify-start items-center bg-grey-lighter rounded-t sm:rounded-t-none sm:rounded-l">
                <span class="flex-grow h-auto py-2 px-3 text-grey-darker" >Status</span>
            </div>
        </div>
        <div class="w-full sm:w-auto flex-grow p-0 m-0">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-center flex-wrap px-2">
                <label class="custom-input-container h-auto md:h-10 flex items-center justify-center flex-wrap">
                    <input type="checkbox" name="status[]" value="active" class="radio-input" >
                    <span class="input-description checkbox px-1 text-grey-darker">Active</span>
                    <span class="custom-input checkmark"></span>
                </label>
                <label class="custom-input-container h-auto md:h-10 flex items-center justify-center flex-wrap">
                    <input type="checkbox" name="status[]" value="sold" class="radio-input" >
                    <span class="input-description checkbox px-1 text-grey-darker">Sold</span>
                    <span class="custom-input checkmark"></span>
                </label>
                <label class="custom-input-container h-auto md:h-10 flex items-center justify-center flex-wrap">
                    <input type="checkbox" name="status[]" value="pending" class="radio-input" >
                    <span class="input-description checkbox px-1 text-grey-darker">Pending</span>
                    <span class="custom-input checkmark"></span>
                </label>
            </div>
        </div>
    </div>
</template>