import Landing from './components/Landing.vue'
import HelloWorld from './components/HelloWorld.vue'
import Login from './components/Login.vue'
import SignUp from './components/SignUp.vue'
import Main from './components/Main.vue'
import Profile from './components/Profile.vue'
import DoctorList from './components/DoctorList.vue'
import DocCategory from './components/DocCategory.vue'
import PrivacyPolicy from './components/PrivacyPolicy.vue'
import EditProfile from './components/EditProfile.vue'
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
    },
    {
        name:'Main',
        component: Main,
        path: '/Main'
    },
    {
        name: 'Profile',
        component: Profile,
        path: '/Profile'
    },{
        name: 'DocCategory',
        component: DocCategory,
        path: '/DocCategory'
    },
    {
        name: 'DoctorList',
        component: DoctorList,
        path: '/DoctorList'
    },
    {
        name: 'PrivacyPolicy',
        component: PrivacyPolicy,
        path: '/PrivacyPolicy'
    },
    {
        name: 'EditProfile',
        component: EditProfile,
        path: '/EditProfile'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router