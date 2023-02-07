<template>
  <div>
    About
    <router-link :to="{name: 'home'}">Главная</router-link>
  </div>
</template>

<script>
export default {
  name: "About",
  mounted() {
    console.log("mounted About")
  },
  unmounted() {
    console.log("unmounted About")
  },
}
</script>

<style scoped>

</style>
