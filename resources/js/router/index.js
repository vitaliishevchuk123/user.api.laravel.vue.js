import { createRouter, createWebHistory } from 'vue-router'
import UserIndex from '../views/user/Index.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: UserIndex
    },
  ]
})

export default router
