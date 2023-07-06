<template>
    <router-view></router-view>
</template>

<script>
export default {
    name: "ContentComponent",
    watch: {
        '$route'(to, from) {
            const toDepth = to.path.split('/').length
            const fromDepth = from.path.split('/').length
            this.transitionName = toDepth < fromDepth ? 'slide-left' : 'slide-right'
        }
    },
    updated() {
        const element = document.querySelector('#sl');
        if (element) {
            element.remove();
        }
    }
}
</script>

<style>
.slide-fade-enter-active {
    transition: all .3s ease;
}

.slide-fade-leave-active {
    transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter,
.slide-fade-leave-to

/* .slide-fade-leave-active below version 2.1.8 */
    {
    transform: translateX(10px);
    opacity: 0;
}
</style>
