<template>
  <q-header reveal elevated class="bg-primary text-white" height-hint="98">
    <div class="row no-wrap shadow-1">
      <q-toolbar>
        <q-btn size="md" flat @click.prevent="$emit('toggleUserDrawer')" round dense icon="menu"/>
        <!--                <q-separator dark vertical  />-->
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          Dashboard
        </q-toolbar-title>
      </q-toolbar>

      <q-toolbar class="col-4 bg-primary text-white">
        <q-space/>
        <div class="search-wrap" :class="{active: isOpen}">
          <q-input ref="search" clearable dense label="Искать"/>
        </div>
        <q-btn size="md" flat round dense icon="search" @click.stop="searchOpen"/>
        <span v-if="!this.getCurrentUser.id">
          <router-link :to="{name: 'login'}"><q-btn flat rounded color="white" label="Вход" size="sm"/></router-link>
          <span style="font-size: 12px;line-height: 27px;">или</span>
          <router-link :to="{name: 'registration'}"><q-btn flat rounded color="white" label="Регистрация" size="sm"/></router-link>
        </span>
        <ThemeSwitcher/>
        <!--        {{darkMode}} |-->
        <!--        {{$q.dark.mode}} |-->
        <!--        {{$q.dark}} |-->

        <!--        $q.dark.toggle()-->
        <!--                <q-btn size="md" flat round dense icon="translate"/>-->
        <LanguageSwitcher/>
        <!--{{window.Laravel.currentUser}}-->
        <q-btn size="md" flat round dense icon="sms" v-if="can('user-panel')"/>
        <q-btn round push size="md" v-if="can('user-panel')">
          <q-avatar>
            <q-img style="height: 100%"
                   :src="!getCurrentUser.avatar ? '/storage/assets/images/no-avatar-man.svg' : '/storage/'+getCurrentUser.avatar"></q-img>
          </q-avatar>
          <q-menu fit anchor="bottom left" transition-show="jump-down" transition-hide="jump-up" self="top left">
            <div class="row no-wrap q-pa-md">
              <div class="column items-center">
                <q-avatar size="72px">
                  <q-img style="height: 100%"
                         :src="!getCurrentUser.avatar ? '/storage/assets/images/no-avatar-man.svg' : '/storage/'+getCurrentUser.avatar"></q-img>
                </q-avatar>
                <div class="text-subtitle1 q-mt-md q-mb-xs">
                  <span>{{ !getCurrentUser.surname ? 'Hi' : getCurrentUser.surname }}</span><br>
                  <span>{{ !getCurrentUser.name ? 'Bro' : getCurrentUser.name }}</span>
                </div>
                <router-link :to="{name: 'dashboard'}">
                  <q-btn
                    color="primary"
                    label="Профиль"
                    push
                    size="sm"
                    v-close-popup
                  />
                </router-link>
                <q-btn @click.prevent="logout"
                       color="primary"
                       label="Выход"
                       push
                       size="sm"
                       v-close-popup
                />
              </div>
            </div>
          </q-menu>
        </q-btn>

        <q-btn size="md" flat round dense icon="more_vert">
          <q-menu fit anchor="bottom left" transition-show="scale" transition-hide="scale" self="top left">
            <router-link :to="{name: 'home'}">
              <q-item clickable>
                <q-item-section>На главную сайта</q-item-section>
              </q-item>
            </router-link>
            <router-link :to="{name: 'admin.dashboard'}">
              <q-item clickable>
                <q-item-section>Админка</q-item-section>
              </q-item>
            </router-link>
          </q-menu>
        </q-btn>
      </q-toolbar>

      <!--        <q-tabs align="left">-->
      <!--            <q-route-tab to="/page1" label="Page One" />-->
      <!--            <q-route-tab to="/page2" label="Page Two" />-->
      <!--            <q-route-tab to="/page3" label="Page Three" />-->
      <!--        </q-tabs>-->
    </div>
  </q-header>
</template>

<script>
import {Quasar, useQuasar} from 'quasar'
import axios from "../../../axios/axios-instance";
import {mapActions, mapMutations, mapGetters} from 'vuex'

export default {
  name: "UserBar",
  mounted() {
    console.log("mounted UserBar")
    // this.user.theme = this.getCurrentUser.theme
  },
  unmounted() {
    console.log("unmounted UserBar")
  },
  setup() {
    // const $q = useQuasar()
  },
  created() {

    // this.currentUser = this.$store.dispatch('getCurrentUser')

    // if (window.Laravel.currentUser) {
    //   this.currentUser = window.Laravel.currentUser
    //   this.currentUserRole = window.Laravel.currentUserRole
    // }
  },
  data: () => ({
    isOpen: false,
    darkMode: '',
    user: {
      initials: 'https://cdn.vuetifyjs.com/images/john.jpg',
      avatar: '',
      fullName: 'John Doe',
      email: 'john.doe@doe.com',
      theme: ''
    },
  }),
  methods: {
    ...mapMutations([
      'SET_AUTH_USER_THEME'
    ]),
    ...mapGetters([
      'GET_AUTH_USER'
    ]),
    ...mapActions([
      'UPDATE_AUTH_USER_THEME'
    ]),
    searchOpen() {
      this.isOpen = !this.isOpen
      if (this.isOpen) {
        this.$refs.search.focus()
      }
    },
    searchClose() {
      this.$refs.search.blur()
      this.isOpen = false
    },
    logout() {
      this.$store.dispatch('logout', this.user)
    },

  },
  watch: {
    isOpen() {
      if (this.isOpen === true) {
        document.body.addEventListener('click', this.searchClose)
      } else {
        document.body.removeEventListener('click', this.searchClose)
      }
    },
    getCurrentUser() {
      this.user = this.getCurrentUser
    },
  },
  computed: {
    getCurrentUser: {
      get() {
        return this.user = this.$store.state.users.currentUser
      }
    },
  },
}
</script>

<style scoped lang="scss">
.search-wrap {
  width: 0%;
  transition: all 0.6s ease;
  top: -10px;
  position: relative;
}

.active {
  width: 300px;
  //transition: all 0.4s 0.7s ease;
  transition: all 0.6s ease;
}

.fi {
  background-size: contain;
  background-position: 100%;
  background-repeat: no-repeat;
  width: 50px;
  height: 50px;
}

img {
  object-fit: cover;
}
a {
  text-decoration: none;
}
</style>
