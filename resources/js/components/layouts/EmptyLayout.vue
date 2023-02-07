<template>
  <q-layout view="hHh lpR fff">
    <q-page-container class="row justify-center content-center">
      <router-view/>
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: "EmptyLayout",
  mounted() {
    console.log("mounted EmptyLayout")
  },
  unmounted() {
    console.log("unmounted EmptyLayout")
  },
}
</script>

<style scoped lang="scss">
.q-page-container {
  height: 100vh;
}
</style>
