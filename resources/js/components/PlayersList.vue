<script setup>
import SinglePlayer from './SinglePlayer.vue'
import draggable from 'vuedraggable'
import { computed } from 'vue'
const emit = defineEmits(['update:modelValue'])

const props = defineProps({
    modelValue: {
        type: Array,
        default: []
    }
})

const players = computed({
    get: () => props.modelValue,
    set: (val) => emit('update:modelValue', val)
})

</script>

<template>
    <draggable
        v-model="players"
        item-key="id"
        group="teams"
        tag="div"
        class="flex items-start flex-wrap"
    >
        <template #item="{ element, index }" :key="element.id" >
            <SinglePlayer
                :key="element.id"
                :index="index"
                :player="element"
            />
        </template>
    </draggable>
</template>
