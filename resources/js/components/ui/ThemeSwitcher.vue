<template>
  <q-btn size="md" flat round dense :icon="$q.dark.isActive === true ? 'light_mode' : 'dark_mode'"
         @click="themeSwitcher()"/>
  <!--  {{getThemeLocalStorage}} -&#45;&#45; {{theme}}-->
</template>


<script>
import {mapActions, mapMutations, mapGetters} from 'vuex'
import {ref} from "vue";

export default {
  name: "ThemeSwitcher",
  data: () => ({
    darkMode: '',
    user: {
      theme: '',
    },
    theme: '',
    currTheme: '',
  }),
  mounted() {
    console.log("mounted ThemeSwitcher")
    this.user.theme = this.getCurrentUser.theme
    this.currTheme = this.user.theme

    // this.theme = localStorage.getItem('THEME')
    this.loadLocalStorage()

    // let theme = localStorage.getItem('THEME')
    // if (theme === 'LIGHT') {
    //   this.$q.dark.set(false)
    //   this.darkMode = false
    // } else {
    //   this.$q.dark.set(true)
    //   this.darkMode = true
    // }
  },
  unmounted() {
    console.log("unmounted ThemeSwitcher")
  },
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
    loadLocalStorage() {
      if (this.getCurrentUser.theme === undefined) {
        this.theme = localStorage.getItem('THEME')
        // console.log(this.theme)
        if (this.theme === null) {
          this.theme = 'DARK'
          localStorage.setItem('THEME', this.theme)
          this.$q.dark.isActive = true
        } else {
          this.theme = localStorage.getItem('THEME')
        }
      } else {
        this.theme = this.user.theme
      }
    },
    themeSwitcher() {
      if (this.getCurrentUser.theme === undefined) {
        // console.log(this.getCurrentUser.theme, 'theme')
        // console.log(this.$q.dark.isActive, 'isActive')
        this.$q.dark.toggle()
        if (this.$q.dark.isActive === true) {
          this.darkMode = true
          localStorage.setItem('THEME', 'DARK')
          this.theme = 'DARK'
          // this.user.theme = 'DARK'
          // this.$q.dark.toggle()
        } else {
          this.darkMode = false
          localStorage.setItem('THEME', 'LIGHT')
          this.theme = 'LIGHT'
          // this.user.theme = 'LIGHT'
          // this.$q.dark.toggle()
        }
        // this.$q.dark.toggle()
      } else {
        this.$q.dark.toggle()
        if (this.$q.dark.isActive === true) {
          this.user.theme = 'DARK'
          this.SET_AUTH_USER_THEME('DARK')
          // this.$store.dispatch('UPDATE_AUTH_USER', this.user)
          this.UPDATE_AUTH_USER_THEME(this.user.theme)
          return this.user.theme = 'DARK'
        } else {
          this.user.theme = 'LIGHT'
          this.SET_AUTH_USER_THEME('LIGHT')
          // this.$store.dispatch('UPDATE_AUTH_USER', this.user)
          this.UPDATE_AUTH_USER_THEME(this.user.theme)
          return this.user.theme = 'LIGHT'
        }
      }
    },
  },
  watch: {
    getCurrentUser() {
      // this.theme = localStorage.getItem('THEME')
      this.user.theme = this.getCurrentUser.theme
      // if (this.theme === 'LIGHT') {
      //   this.$q.dark.set(false)
      // } else {
      //   this.$q.dark.set(true)
      // }
      if (this.getCurrentUser.theme === 'LIGHT') {
        this.$q.dark.set(false)
      } else {
        this.$q.dark.set(true)
      }
    },
    theme() {
      // this.theme = this.getThemeLocalStorage
      if (this.theme === null) {
        this.$q.dark.set(true)
        this.theme = 'DARK'
        this.currTheme = 'DARK'
      } else if (this.theme === 'LIGHT') {
        this.$q.dark.set(false)
        this.theme = 'LIGHT'
        this.currTheme = 'LIGHT'
      } else {
        this.$q.dark.set(true)
        this.theme = 'DARK'
        this.currTheme = 'DARK'
      }
    }
  },
  computed: {
    getCurrentUser: {
      get() {
        return this.$store.state.users.currentUser
      }
    },
    getThemeLocalStorage: {
      get() {
        return localStorage.getItem('THEME')
      }
    },
  },
}
</script>

<style scoped>

</style>
