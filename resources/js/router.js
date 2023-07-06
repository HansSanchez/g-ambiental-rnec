import Vue from 'vue'
import Router from 'vue-router'
import Home from './views_vue/Home.vue'
import Users from './views_vue/admin/User'
import Audits from './views_vue/admin/Audit'
import NotFount from './components/NotFountComponent'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [

        // PÁGINA DE INICIO
        {path: '/v/home', name: 'home', component: Home},


        /// ADMINISTRACIÓN
        {path: '/v/admin/users', name: 'users', component: Users},
        {path: '/v/admin/audits', name: 'audits', component: Audits},
        // END


        // ERROR 404
        {path: '/error-404', name: 'error-404', component: NotFount},
        {path: '/v/*', redirect: 'error-404'},

    ]
})
