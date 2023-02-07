<template>
  <q-layout view="hHh lpR fff">

    <UserBar @toggleUserDrawer="drawer = !drawer"/>

    <UserDrawer v-model="drawer"/>

    <q-page-container>
      <router-view/>
    </q-page-container>

  </q-layout>
</template>

<script>
import {ref} from "vue";

export default {
  name: "DashboardLayout",
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
