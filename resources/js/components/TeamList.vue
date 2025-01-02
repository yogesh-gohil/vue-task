<script setup>
import { computed } from 'vue'
import SinglePlayer from './SinglePlayer.vue'
import draggable from 'vuedraggable'

const emit = defineEmits(['drop'])

const props = defineProps({
    modelValue: {
        type: Array,
        default: []
    }
})

const teams = computed({
    get: () => props.modelValue,
    set: (val) => emit('update:modelValue', val)
})

</script>

<template>
    <div class="h-1/2">
        <h2 class="text-lg font-semibold">Teams</h2>
            <div class="flex flex-wrap gap-4">
                <div
                    v-for="(team, index) in teams"
                    :key="team.id"
                    class="p-4 border rounded shadow-sm bg-gray-50 h-full flex-1  min-h-1/2"
                >
                    <div class="font-semibold h-full border min-h-96 p-4">
                        {{ team.name }}
                        <draggable
                            v-model="team.players"
                            group="teams"
                            item-key="id"
                        >
                            <template #item="{ element }">
                                <SinglePlayer :key="element.id" :player="element" />
                            </template>
                        </draggable>
                    </div>
                </div>
            </div>
        </div>
</template>
