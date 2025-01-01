<script setup>
import draggable from 'vuedraggable'
import { ref, onMounted } from 'vue'
import axios from 'axios'

import SinglePlayer from './SinglePlayer.vue'

const emit = defineEmits(['drop'])

const props = defineProps(['players'])
const playersData = ref(props.players)
</script>

<template>
    <div class="h-full w-full border border-red-500">
        <h1>Players</h1>
            <draggable
                v-model="playersData"
                item-key="id"
                group="teams"
                tag="div"
                @change="(event) => emit('drop', event)"
                class="flex flex-wrap"
            >
                <template #item="{ element, index }">
                        <SinglePlayer
                            :key="element.id"
                            :index="index"
                            :player="element"
                            class="border p-4 bg-gray-50"
                        />
                </template>
            </draggable>
        </div>
</template>
