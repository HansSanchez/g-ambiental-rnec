import Vue from 'vue'
import Router from 'vue-router'
import Home from './views_vue/Home.vue'
import Users from './views_vue/admin/User'
import Audits from './views_vue/admin/Audit'
import NotFount from './components/NotFountComponent'

import TreePlantation from './views_vue/modules/TreePlantations/index.vue'
import TreePlantationDetail from './views_vue/modules/TreePlantations/detail.vue'

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

        // PLANTACIÓN DE ARBOLES
        {path: '/v/tree-plantations/index', name: 'tree-plantations-index', component: TreePlantation},
        {path: '/v/tree-plantations/detail/:id', name: 'tree-plantations-detail', component: TreePlantationDetail},


        // ERROR 404
        {path: '/error-404', name: 'error-404', component: NotFount},
        {path: '/v/*', redirect: 'error-404'},

    ]
})
