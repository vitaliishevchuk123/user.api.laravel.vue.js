import { createRouter, createWebHistory } from 'vue-router'
import UserIndex from '../views/user/Index.vue'
import UserCreate from '../views/user/Create.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: UserIndex
    },
    {
      path: '/create-user',
      name: 'create',
      component: UserCreate
    },
  ]
})

export default router
