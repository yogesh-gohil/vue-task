<script setup>
import { ref, onMounted } from 'vue'
import SingleTeam from './SingleTeam.vue'
import SinglePlayer from './SinglePlayer.vue'

import draggable from 'vuedraggable'
import axios from 'axios'

const players = ref([])
const teams = ref([])

onMounted(() => {
    fetchData()
})

async function fetchData() {
    const [playersResponse, teamsResponse] = await Promise.all([
        axios.get('api/players'),
        axios.get('api/teams'),
    ])

    players.value = playersResponse.data.players

    teams.value = teamsResponse.data.teams

    teams.value.forEach((team) => {
        team.players.forEach((player) => {
            players.value = players.value.filter((p) => p.id !== player.id);
        });
    });

}

async function onDropPlayer(evt, team) {
    const { added, removed } = evt

    if (added) {
        try {
            await axios.post('api/save-player-team', {
                player_id: added.element.id,
                team_id: team.id,
            })
        } catch (error) {
            console.error('Error saving to database:', error)
        }
    }

    if (removed) {
        try {
            await axios.post('api/remove-player-team', {
                player_id: removed.element.id,
                team_id: team.id,
            })
        } catch (error) {
            console.error('Error removing from database:', error)
        }
    }
}
</script>

<template>
    <div class="flex justify-center">
        <div class="w-2/3 h-full">
            <h2 class="text-lg font-semibold">Players</h2>
            <div class="w-full h-1/2 p-4">
                <draggable
                    v-model="players"
                    item-key="id"
                    group="teams"
                    tag="div"
                    class="flex flex-wrap"
                >
                    <template #item="{ element, index }" :key="element.id">
                        <SinglePlayer
                            :key="element.id"
                            :index="index"
                            :player="element"
                            class="border p-4 bg-gray-50"
                        />
                    </template>
                </draggable>
            </div>
            <div  v-if="teams.length" class="h-1/2">
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
                                @change="(evt) => onDropPlayer(evt, team)"

                                >
                                <template #item="{ element }">
                                    <SingleTeam :key="element.id" :team="element" />
                                </template>
                            </draggable>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
