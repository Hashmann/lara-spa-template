<template>
  <div class="q-pl-sm q-pr-sm">
    <q-card class="q-pa-sm">
      <div class="card-header">{{ $t('home.titleHome') }}</div>
      {{ $t('home.titleLayout') }}
      <div class="row justify-between">

        <div>
          <div>
            <router-link v-if="getAuth.isLoggedIn" :to="{name: 'dashboard'}"><span
              class="ml-3">{{ $t('home.menu.dashboard') }}</span></router-link>
          </div>
          <div>
            <router-link :to="{name: 'home.about'}"><span class="ml-3">{{ $t('home.menu.about') }}</span></router-link>
          </div>
          <div>
            <router-link v-if="!getAuth.isLoggedIn" :to="{name: 'login'}"><span>{{ $t('home.menu.login') }}</span>
            </router-link>
          </div>
          <div>
            <router-link v-if="!getAuth.isLoggedIn" :to="{name: 'registration'}"><span
              class="ml-3">{{ $t('home.menu.register') }}</span></router-link>
          </div>
          <div>
            <router-link v-if="getAuth.isLoggedIn" :to="{name: 'admin.dashboard'}"><span
              class="ml-3">{{ $t('home.menu.admin') }}</span></router-link>
          </div>
          <q-btn v-if="getAuth.isLoggedIn" @click.prevent="logout" color="primary" :label=" $t('home.menu.logout') "
                 size="sm"></q-btn>
        </div>
        <div>
<!--          <LanguageSwitcher/>-->
<!--          <ThemeSwitcher/>-->
        </div>

      </div>
    </q-card>
  </div>
</template>

<script>
import axios from "../../../../axios/axios-instance";

export default {
  name: "Home",
  data: () => ({
    token: false,
  }),
  mounted() {
    // this.getData()
    this.getToken()
    console.log("mounted Home")
  },
  unmounted() {
    console.log("unmounted Home")
  },
  methods: {
    // getData() {
    //   axios.get('/api/v1/main')
    //     .then(response => {
    //       console.log(response);
    //     })
    // },
    getToken() {
      if (localStorage.getItem('x-token') === null) {
        this.token = false
      } else {
        this.token = true
      }
    },
    logout() {
      this.$store.dispatch('logout', this.user)
    },
  },
  computed: {
    getAuth: {
      get() {
        return this.$store.getters.GET_AUTH_USER
      }
    },
  },
}
</script>

<style scoped>
a {
  color: grey;
}

.q-page-container {
  padding-top: 0 !important;
}
</style>
