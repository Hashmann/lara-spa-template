<template>
  <q-card>
    <div style="color: red">Ooops...Такой страницы не существует</div>
    <router-link :to="{name: 'home'}">Главная</router-link>
  </q-card>
</template>

<script>
export default {
  name: "404"
}
</script>

<style scoped>

</style>
