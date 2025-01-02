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

async function saveTeams() {
    try {
        const payload = teams.value.map(team => ({
            team_id: team.id,
            players: team.players.map((player, index) => ({
                player_id: player.id,
                sort_order: index,
            })),
        }));

        await axios.post('/api/save-teams-players', { teams: payload });

        alert('Teams and players saved successfully!');
    } catch (error) {
        console.error('Error saving teams and players:', error);
        alert('Failed to save teams and players.');
    }
}
</script>

<template>
    <div class="flex justify-center">

        <div class="w-2/3 h-full">
            <div class="flex justify-between">
                <h2 class="text-lg font-semibold">Players</h2>
                <button class="bg-indigo-500 p-2 text-white mt-2 rounded-md" @click="saveTeams">
                    Save
                </button>
            </div>
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
