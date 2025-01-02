<script setup>
defineProps({
    player: {
        type: Object,
        default: null,
    }
})
</script>

<template>
 <div class="bg-white text-gray-500 w-96 m-2 font-medium rounded-md shadow-sm border p-4" >
    <span>Name: </span><span class="">{{ player.name }}</span> <br />
    <span>Email: </span><span class="">{{ player.email }}</span> <br />
    <span>Date Of Birth: </span><span class="">{{ player.date_of_birth }}</span>
 </div>
</template>
