import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import VueAxios from 'vue-axios'
import store from './store';

const app = createApp(App)

app.use(VueAxios)

app.use(store)

app.use(router)

app.mount('#app')