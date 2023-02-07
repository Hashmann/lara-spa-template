<template>
  <div class="container row justify-between">
<!--    <q-card class="card">-->
<!--      <BarChart/>-->
<!--    </q-card>-->
<!--    <q-card class="card">-->
<!--      <RadarChart/>-->
<!--    </q-card>-->
<!--    <q-card class="card">-->
<!--      <LineChart/>-->
<!--    </q-card>-->

    <q-card class="card">
      <div class="q-pa-md">
        <div class="q-gutter-md row items-start">
          <q-date v-model="date"/>
          <q-date
            v-model="date"
            minimal
          />
        </div>
      </div>
    </q-card>
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
    console.log("mounted User-Dashboard")
  },
  unmounted() {
    console.log("unmounted User-Dashboard")
  },
}
</script>

<style scoped>

</style>
