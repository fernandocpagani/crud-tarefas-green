import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import CreateUser from '../views/CreateUser.vue'
import Dashboard from '../views/Dashboard.vue'
import TodayTaskView from '../views/TodayTaskView.vue'
import DelayTaskView from '../views/DelayTaskView.vue'
import ModalViewTask from '../components/ModalViewTask.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'login',
    component: Login
  },
  {
    path: '/createuser',
    name: 'createuser',
    component: CreateUser
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
  {
    path: '/todaytaskview',
    name: 'todaytaskview',
    component: TodayTaskView
  },
  {
    path: '/delaytaskview',
    name: 'delaytaskview',
    component: DelayTaskView
  },
  {
    path: '/modalviewtask/:id',
    name: 'modalviewtask',
    component: ModalViewTask
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
