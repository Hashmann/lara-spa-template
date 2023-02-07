<template>
  <q-layout view="hHh lpR fff" v-show="!getIsLoad">
    <q-page-container>
      <UserBar @toggleDrawer="drawer = !drawer"/>
      <q-page-container>
        <router-view/>
      </q-page-container>
      <q-inner-loading
        :showing="getIsLoad"
        label="Пожалуйста, подождите..."
        label-class="text-teal"
        label-style="font-size: 1.1em"
      />
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: "MainLayout",
  data: () => ({
    token: false,
    authUser: {},
  }),
  mounted() {
    this.getToken()
    console.log("mounted Home-MainLayout")
    if(this.token) {
      this.$store.dispatch('getCurrentUser')
      this.$store.getters.GET_AUTH_USER.isLoggedIn = true
    } else {
      console.log('User not authenticated')
    }
  },
  unmounted() {
    console.log("unmounted Home-MainLayout")
  },
  computed: {
    getCurrentUser: {
      get() {
          return this.authUser = this.$store.getters.GET_AUTH_USER
      }
    },
    getIsLoad: {
      get() {
        return this.$store.getters.GET_AUTH_IS_LOADING
      }
    },
  },
  methods: {
    getToken() {
      if (localStorage.getItem('x-token') === null) {
        this.token = false
      } else {
        this.token = true
      }
    },
  },
  watch: {
    getCurrentUser() {
      this.authUser.theme = this.getCurrentUser.theme
      if (this.getCurrentUser.theme === 'LIGHT') {
        this.$q.dark.set(false)
      } else {
        this.$q.dark.set(true)
      }
    },
  }
}
</script>

<style scoped>

</style>
