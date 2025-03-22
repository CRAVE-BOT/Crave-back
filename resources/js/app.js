import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
import { createApp } from 'vue';
import Chatbot from './components/Chatbot.vue';

const app = createApp(Chatbot);
app.mount("#app");
