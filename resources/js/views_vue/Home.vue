<template>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row justify-content-center text-center mb-3">
                <!------------------- WELCOME ------------------->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 style="font-family: 'Nunito', sans-serif" class="mb-0 text-primary">
                        <b>¡BIENVENIDOS A G • AMBIENTAL RNEC!</b>
                    </h1>
                    <p class="mb-0"><b>GESTIÓN Y CONTROL DE LA COORDINACIÓN AMBIENTAL EN LA RNEC</b></p>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <img :src="'/assets/img/Web/welcome7.png'" alt="welcome">
                </div>
                <!----------------- END WELCOME ----------------->
            </div>
        </div>

        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">

                <---------------- USUARIOS ACTIVOS ---------------
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="accordion" id="accordionActiveUsers">
                        <div class="card">
                            <div class="card-header bg-dark" id="headingActiveUsers">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left"
                                            type="button" data-toggle="collapse"
                                            data-target="#collapseActiveUsers"
                                            aria-expanded="true" aria-controls="collapseActiveUsers">
                                        <h5 class="text-white mb-0 pb-0">
                                            <i class="fas fa-people-group mr-2"></i>
                                            USUARIOS ACTIVOS: <b>{{ SumActiveUsers }}</b>
                                        </h5>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseActiveUsers" class="collapse" aria-labelledby="headingActiveUsers"
                                 data-parent="#accordionActiveUsers">
                                <div class="card-body">
                                    <div class="row" v-for="(ActiveUser, index) in ActiveUsers" :key="index">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pb-0">
                                            <span class="text-medium-emphasis small">
                                                {{ ActiveUser.a_name }}
                                                <b class="text-info">( {{ ActiveUser.quantity }} PERSONAS )</b>
                                                <b class="text-success">
                                                ( {{
                                                        Number(ActiveUser.quantity * 100 / (SumActiveUsers + SumInactiveUsers)).toFixed(2)
                                                    }}% )
                                            </b>
                                            </span>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pb-0">
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin" style="background: antiquewhite; border: 1px solid">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         v-bind:style="{ width: Number(ActiveUser.quantity * 100 / (SumActiveUsers + SumInactiveUsers)).toFixed(5) + '%' }"
                                                         :aria-valuenow="ActiveUser.quantity"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100">
                                                    </div>
                                                    <span><b></b></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <------------------ END USUARIOS -----------------

                <-------------- USUARIOS INACTIVOS ---------------
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pb-0">
                    <div class="accordion" id="accordionInactiveUsers">
                        <div class="card">
                            <div class="card-header bg-dark" id="headingInactiveUsers">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left"
                                            type="button" data-toggle="collapse"
                                            data-target="#collapseInactiveUsers"
                                            aria-expanded="true" aria-controls="collapseInactiveUsers">
                                        <h5 class="text-white mb-0">
                                            <i class="fas fa-people-group mr-2"></i>
                                            USUARIOS INACTIVOS: <b>{{ SumInactiveUsers }}</b>
                                        </h5>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseInactiveUsers" class="collapse" aria-labelledby="headingInactiveUsers"
                                 data-parent="#accordionInactiveUsers">
                                <div class="card-body">
                                    <div class="row" v-for="(InactiveUser, index) in InactiveUsers" :key="index">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pb-0">
                                <span class="text-medium-emphasis small">
                                    {{ InactiveUser.a_name }}
                                    <b class="text-info">( {{ InactiveUser.quantity }} PERSONAS )</b>
                                    <b class="text-danger">
                                        ( {{
                                            Number(InactiveUser.quantity * 100 / (SumActiveUsers + SumInactiveUsers)).toFixed(2)
                                        }}% )
                                    </b>
                                </span>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pb-0">
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin" style="background: antiquewhite; border: 1px solid">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                         :style="{ width: Number(InactiveUser.quantity * 100 / (SumActiveUsers + SumInactiveUsers)).toFixed(5) + '%' }"
                                                         :aria-valuenow="InactiveUser.quantity"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100">
                                                    </div>
                                                    <span><b></b></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <----------------- END USUARIOS -----------------
            </div>
        </div> -->
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            ActiveUsers: [],
            SumActiveUsers: 1,
            InactiveUsers: [],
            SumInactiveUsers: 1,
            permissions: []
        }
    },
    methods: {
        // queryUsers() {
        //     let api = "/EntryControl/home/queryUsers";
        //     axios.post(api)
        //         .then((response) => {
        //             this.permissions = response.data.permissions;
        //             this.ActiveUsers = response.data.ActiveUsers;
        //             this.SumActiveUsers = response.data.SumActiveUsers;
        //             this.InactiveUsers = response.data.InactiveUsers;
        //             this.SumInactiveUsers = response.data.SumInactiveUsers;
        //         })
        //         .catch((errors) => console.log(errors))
        // },
    },
    created() {
        // this.queryUsers();
    }
}
</script>

<style scoped></style>
