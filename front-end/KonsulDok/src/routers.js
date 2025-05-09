import Landing from './components/Landing.vue'
import HelloWorld from './components/HelloWorld.vue'
import Login from './components/Login.vue'
import SignUp from './components/SignUp.vue'
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
    },
    {
        name: 'Login',
        component: Login,
        path: '/Login'
    },
    {
        name: 'SignUp',
        component: SignUp,
        path: '/SignUp'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router