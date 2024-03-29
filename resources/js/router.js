import Vue from "vue";
import Router from "vue-router";
import Home from "./views_vue/Home.vue";
import Users from "./views_vue/admin/User";
import Headquarters from "./views_vue/admin/Headquarter";
import FollowUp from "./views_vue/admin/FollowUp";
import NotFount from "./components/NotFountComponent";

import CoResponsibilityAgreements from "./views_vue/modules/CoResponsibilityAgreements/index.vue";
import CoResponsibilityAgreementsDetail from "./views_vue/modules/CoResponsibilityAgreements/detail.vue";

import ElectricalConsumptions from "./views_vue/modules/ElectricalConsumptions/index.vue";
import ElectricalConsumptionsDetail from "./views_vue/modules/ElectricalConsumptions/detail.vue";

import TreePlantation from "./views_vue/modules/TreePlantations/index.vue";
import TreePlantationDetail from "./views_vue/modules/TreePlantations/detail.vue";

import WasteManagement from "./views_vue/modules/WasteManagement/index.vue";
import WasteManagementDetail from "./views_vue/modules/WasteManagement/detail.vue";

import WaterConsumptions from "./views_vue/modules/WaterConsumptions/index.vue";
import WaterConsumptionsDetail from "./views_vue/modules/WaterConsumptions/detail.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        // PÁGINA DE INICIO
        { path: "/v/home", name: "home", component: Home },

        /// ADMINISTRACIÓN
        { path: "/v/admin/users", name: "users", component: Users },
        { path: "/v/admin/headquarters", name: "headquarters", component: Headquarters },
        { path: "/v/admin/follow-up", name: "follow-up", component: FollowUp },

        // ACUERDOS
        {
            path: "/v/co-responsibility-agreements/index",
            name: "co-responsibility-agreements-index",
            component: CoResponsibilityAgreements,
        },
        {
            path: "/v/co-responsibility-agreements/detail/:id",
            name: "co-responsibility-agreements-detail",
            component: CoResponsibilityAgreementsDetail,
        },

        // CONSUMOS ELÉCTRICOS
        {
            path: "/v/electrical-consumptions/index",
            name: "electrical-consumptions-index",
            component: ElectricalConsumptions,
        },
        {
            path: "/v/electrical-consumptions/detail/:id",
            name: "electrical-consumptions-detail",
            component: ElectricalConsumptionsDetail,
        },

        // PLANTACIÓN DE ARBOLES
        {
            path: "/v/tree-plantations/index",
            name: "tree-plantations-index",
            component: TreePlantation,
        },
        {
            path: "/v/tree-plantations/detail/:id",
            name: "tree-plantations-detail",
            component: TreePlantationDetail,
        },


        // GESTIÓN DE RESIDUOS
        {
            path: "/v/waste-management/index",
            name: "waste-management-index",
            component: WasteManagement,
        },
        {
            path: "/v/waste-management/detail/:id",
            name: "waste-management-detail",
            component: WasteManagementDetail,
        },

        // CONSUMOS HÍDRICOS
        {
            path: "/v/water-consumptions/index",
            name: "water-consumptions-index",
            component: WaterConsumptions,
        },
        {
            path: "/v/water-consumptions/detail/:id",
            name: "water-consumptions-detail",
            component: WaterConsumptionsDetail,
        },

        // ERROR 404
        { path: "/error-404", name: "error-404", component: NotFount },
        { path: "/v/*", redirect: "error-404" },
    ],
});
