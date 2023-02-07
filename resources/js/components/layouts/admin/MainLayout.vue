<template>
  <q-layout view="hHh lpR fff">

    <AdminBar @toggleDrawer="drawer = !drawer"/>

    <AdminDrawer v-model="drawer"/>

    <q-page-container>
      <router-view/>
    </q-page-container>

  </q-layout>
</template>

<script>
import {ref} from 'vue'

export default {
  name: "MainLayout",
  mounted() {
    console.log("mounted Admin-MainLayout")
  },
  unmounted() {
    console.log("unmounted Admin-MainLayout")
  },
  setup() {
    return {
      drawer: ref(false),
    }
  },
  data: () => ({}),
}
</script>

<style scoped>

</style>
