<template>
  <div class="container row justify-between">
    <q-card class="card">
      <BarChart/>
    </q-card>
    <q-card class="card">
      <RadarChart/>
    </q-card>
    <q-card class="card">
      <LineChart/>
    </q-card>

    <div class="q-pa-md">
      <div class="q-gutter-md row items-start">
        <q-date v-model="date"/>
        <q-date
          v-model="date"
          minimal
        />
      </div>
    </div>
  </div>
</template>

<script>
import {ref} from "vue";

export default {
  name: "Dashboard",
  data: () => ({
    date: ref('2022/05/12'),
  }),
  mounted() {
    this.title()
    console.log("mounted Dashboard")
  },
  unmounted() {
    console.log("unmounted Dashboard")
  },
  methods: {
    title() {
      document.title = "Dashboard"
    },
  },
}
</script>

<style scoped lang="scss">
.card {
  width: 100%;
  max-width: 500px;
  padding: 10px;
}
</style>
