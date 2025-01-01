<script setup>
import { ref, onMounted } from 'vue'
import SingleTeam from './SingleTeam.vue'
import draggable from 'vuedraggable'
import axios from 'axios'

const emit = defineEmits(['drop'])

defineProps(['teams'])
</script>

<template>
    <div>
        <h2 class="text-lg font-semibold">Teams</h2>
        <div class="flex flex-wrap gap-4">
            <div
                v-for="(team, index) in teams"
                :key="team.id"
                class="p-4 border rounded shadow-sm bg-gray-50 h-96 flex-1"
            >
                <h3 class="font-semibold">{{ team.name }}</h3>
                <draggable
                    v-model="team.players"
                    group="teams"
                    item-key="id"
                    @change="(event) => emit('drop', event)"
                >
                    <template #item="{ element }">
                        <SingleTeam :player="element" />
                    </template>
                </draggable>
            </div>
        </div>
    </div>
</template>
