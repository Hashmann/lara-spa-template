<template>
    <component :is="layout">
        <router-view></router-view>
    </component>
</template>

<script>
export default {
    name: "App",
    computed: {
        layout() {
            return (this.$route.meta.layout || 'main') + '-layout'
        }
    },
}
</script>

<style lang="scss">
    .container {
        padding: 20px;
    }
</style>
