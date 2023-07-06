<template>
    <div class="row justify-content-center text-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 justify-content-center text-center">
            <h1 style="font-family: 'Nunito', sans-serif">
                <b>¡UPS!</b>
                <b class="text-danger">NO</b>
                tienes acceso a este módulo, regresa al
                <router-link
                    :to="{ name:'home' }"
                    title="Página de inicio"
                    @click="show = !show">
                    inicio
                </router-link>
                <br>
                Si consideras que es un error contacta el área de informática.
            </h1>
        </div>
        <div class="col-lg-6 col-md-10 col-sm-12 col-xs-12 justify-content-center text-center">
            <img :src="'/assets/img/Web/403.svg'" alt="403">
        </div>
    </div>
</template>

<script>
export default {
    name: "ForbiddenComponent"
}
</script>

<style scoped>

</style>
