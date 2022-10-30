import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from 'axios'
import VueAxios from 'vue-axios'

import App from './App.vue'
import router from './router'

import './assets/css/main.css'

const app = createApp(App)
const axiosInstance = axios.create({
  baseURL: 'http://localhost/',
  // headers: {
  //   common: {
  //
  //   },
  //   post: {
  //
  //   }
  // }
});

app.use(createPinia())
app.use(router)
app.use(VueAxios, axiosInstance)

app.mount('#app')
