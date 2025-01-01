<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

defineProps({
    team: {
        type: Object,
        default: null,
    }
})


</script>

<template>
    <div v-if="team" class="bg-gray-100 text-gray-800 w-96 p-2 m-2 font-medium rounded-md" >
        <span>Name: </span><span class="">{{ team.name }}</span> <br />
        <span>Email: </span><span class="">{{ team.email }}</span> <br />
        <span>Date Of Birth: </span><span class="">{{ team.date_of_birth }}</span>
    </div>
</template>
