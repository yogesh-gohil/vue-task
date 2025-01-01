import './bootstrap';
import { createApp } from 'vue';
import TeamPlayer from './components/TeamPlayer.vue';

createApp({})
  .component('TeamPlayer', TeamPlayer)
  .mount('#app')
