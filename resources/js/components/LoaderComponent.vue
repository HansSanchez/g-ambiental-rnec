<template>
    <div class="container-loader">
        <div class="cargando-loader">
            <div class="pelotas-loader"></div>
            <div class="pelotas-loader"></div>
            <div class="pelotas-loader"></div>
            <h1 class="texto-cargando-loader">Cargando</h1>
        </div>
    </div>
</template>

<script>
export default {
    name: "LoaderComponentComponent"
}
</script>

<style scoped>
/* ======================== */
.container-loader {
    display: grid;
    place-content: center;
    height: 100vh;
}

.cargando-loader {
    width: 120px;
    height: 30px;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    justify-content: space-between;
    margin: 0 auto;
}

.texto-cargando-loader {
    padding-top: 20px
}

.cargando-loader h1 {
    font-size: 20px;
    text-transform: uppercase;
}

.pelotas-loader {
    width: 30px;
    height: 30px;
    background-color: #00b782;
    animation: salto .5s alternate infinite;
    border-radius: 50%
}

.pelotas-loader:nth-child(2) {
    animation-delay: .18s;
}

.pelotas-loader:nth-child(3) {
    animation-delay: .37s;
}

@keyframes salto {
    from {
        transform: scaleX(1.25);
    }

    to {
        transform:
            translateY(-50px) scaleX(1);
    }
}
</style>
