import Landing from './components/Landing.vue'
import HelloWorld from './components/HelloWorld.vue'
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        name: 'Home',
        component: Landing,
        path: '/'
    },
    {
        name: 'Test',
        component: HelloWorld,
        path: '/HelloWorld'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router