<template>
    <div class="w-full relative my-2">
        <div class="w-full border-l p-1 text-grey-darkest">
            <div class="pin-r pin-t p-2 absolute text-cta-red">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>
            <div class="pr-12 pl-2 ">
                {{ note.message }} <br><small class="italic text-smoke mt-1">{{ note.diff }}</small>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        note: {
            type: Object,
            default: () => {}
        }
    }
}
</script>
