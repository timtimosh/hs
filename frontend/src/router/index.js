import signUpClient from '@/views/SignUpClient.vue';
import signUpClientOk from '@/views/SignUpClientOk.vue';
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'signUpClient',
    component: signUpClient
  },
  {
    path: '/signUpClientOk',
    name: 'signUpClientOk',
    component: signUpClientOk
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes
})

export default router
