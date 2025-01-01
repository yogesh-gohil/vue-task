<script setup>
import { ref, onMounted } from 'vue'

defineProps({
    player: {
        type: Object,
        default: null,
    }
})
</script>

<template>
 <div class="bg-gray-100 text-gray-800 w-96 p-2 m-2 font-medium rounded-md" >
    <span>Name: </span><span class="">{{ player.name }}</span> <br />
    <span>Email: </span><span class="">{{ player.email }}</span> <br />
    <span>Date Of Birth: </span><span class="">{{ player.date_of_birth }}</span>
 </div>
</template>
