import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/registerClientOk',
    name: 'registerClientOk',
    component: () => import('../views/RegisterClientOk.vue')
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes
})

export default router
