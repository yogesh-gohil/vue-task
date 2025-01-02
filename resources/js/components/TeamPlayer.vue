<script setup>
import { ref, onMounted } from 'vue'
import PlayersList from './PlayersList.vue'
import TeamList from './TeamList.vue'
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
        const payload = [];

        teams.value.forEach((team,index) => {
            payload[index] = {'team_id': team.id, players: []}
            let obj = {}
            team.players.forEach((player, p_index) => {
                obj[player.id] = {sort_order: p_index}
                payload[index]['players'] = {... obj } ?? []
            })
        })

        await axios.post('/api/save-teams-players', {teams: payload});

        alert('Teams and players saved successfully!');
    } catch (error) {
        console.error('Error saving teams and players:', error);
        alert('Failed to save teams and players.');
    }
}
</script>

<template>
    <div class="container h-full mx-auto p-4">
        <div class="flex justify-between mb-4 items-center">
            <h2 class="text-lg font-semibold">Players</h2>
            <button class="bg-indigo-500 p-2 text-white mt-2 rounded-md" @click="saveTeams">
                Save
            </button>
        </div>

        <div class="flex flex-col lg:flex-row h-screen">
            <div class="h-full flex lg:flex-auto flex-col gap-y-10">
                <PlayersList v-model="players" class="bg-gray-50 min-h-[200px] p-2 rounded-md "/>
                <TeamList v-if="teams.length" v-model="teams" class="h-1/2 min-h-[100px]"/>
            </div>
        </div>
    </div>
</template>
