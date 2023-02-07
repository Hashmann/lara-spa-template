<template>
  <q-btn size="md" flat round dense @click="switchLocale()">
    <q-avatar size="24px">
      <img :src="localeRu === true ? '/storage/assets/images/admin/ru.svg' : '/storage/assets/images/admin/en-us.svg'">
    </q-avatar>
  </q-btn>
  {{}}
</template>


<script>
import {Quasar} from 'quasar'
import langRu from 'quasar/lang/ru'
import langEn from 'quasar/lang/en-Us'
import axios from "../../../axios/axios-instance";
import {mapActions, mapGetters, mapMutations} from 'vuex'
import {ref} from 'vue'

export default {
  name: "LanguageSwitcher",
  data: () => ({
    // locales: process.env.VUE_APP_I18N_SUPPORTED_LOCALE.split(','),
    // locales: ['ru-RU', 'en-US'],
    localeRu: true,
    user: {
      locale: '',
    },
    locale: '',
  }),
  mounted() {
    // localStorage.setItem('LOCALE', '')
    this.user.locale = this.getCurrentUser.locale
    // this.locale = this.getCurrentUser.locale
    this.loadLocalStorage()
  },
  methods: {
    ...mapActions([
      'UPDATE_AUTH_USER_LOCALE'
    ]),
    ...mapMutations([
      'SET_AUTH_USER_LOCALE'
    ]),
    ...mapGetters([
      'GET_AUTH_USER'
    ]),
    loadLocalStorage() {
      if (this.getCurrentUser.locale === undefined) {
        this.locale = localStorage.getItem('LOCALE')
        // console.log(this.locale)
        if (this.locale === null) {
          this.locale = 'ru-RU'
          localStorage.setItem('LOCALE', this.locale)
        } else {
          this.locale = localStorage.getItem('LOCALE')
        }
      } else {
        this.locale = this.getCurrentUser.locale
        if (this.locale === 'ru-RU') {
          this.localeRu = true
        } else {
          this.localeRu = false
        }
        // console.log(this.user, 'LOCALE1')
      }
    },
    //TODO Подумать над реализацией переключателя
    switchLocale() {
      if (this.getCurrentUser.locale === undefined) {
        // console.log(this.getCurrentUser.locale, 'locale')
        // this.localeRu = !this.localeRu
        if (this.localeRu !== true) {
          this.$i18n.locale = 'ru-RU'
          localStorage.setItem('LOCALE', 'ru-RU')
          Quasar.lang.set(langRu)
          // this.localeRu = !this.localeRu
        } else {
          this.$i18n.locale = 'en-US'
          localStorage.setItem('LOCALE', 'en-US')
          Quasar.lang.set(langEn)
          // this.localeRu = !this.localeRu
        }
        this.localeRu = !this.localeRu
      } else {
        this.localeRu = !this.localeRu
        // console.log(this.GET_AUTH_USER().userLocale)
        if (this.localeRu === true) {
          this.$i18n.locale = 'ru-RU'
          Quasar.lang.set(langRu)
          // this.getAuth.locale = 'ru-RU'
          this.user.locale = 'ru-RU'
          this.SET_AUTH_USER_LOCALE(this.user.locale)
          this.UPDATE_AUTH_USER_LOCALE(this.user.locale)
        } else {
          this.$i18n.locale = 'en-US'
          Quasar.lang.set(langEn)
          // this.getAuth.locale = 'en-US'
          this.user.locale = 'en-US'
          this.SET_AUTH_USER_LOCALE(this.user.locale)
          this.UPDATE_AUTH_USER_LOCALE(this.user.locale)
        }
      }
    },

  },
  computed: {
    getCurrentUser: {
      get() {
        return this.$store.state.users.currentUser
      }
    },
    getLocaleLocalStorage: {
      get() {
        return localStorage.getItem('LOCALE')
      }
    },
  },
  watch: {
    getCurrentUser() {
      this.user.locale = this.getCurrentUser.locale
      if (this.user.locale === 'ru-RU') {
        this.localeRu = true
        this.$i18n.locale = 'ru-RU'
        Quasar.lang.set(langRu)
      } else {
        this.localeRu = false
        this.$i18n.locale = 'en-US'
        Quasar.lang.set(langEn)
      }
    },
    locale() {
      // this.theme = this.getThemeLocalStorage
      if (this.locale === null) {
        Quasar.lang.set(langRu)
        this.localeRu = true
        this.$i18n.locale = 'ru-RU'
      } else if (this.locale === 'ru-RU') {
        Quasar.lang.set(langRu)
        this.localeRu = true
        this.$i18n.locale = 'ru-RU'
      } else {
        Quasar.lang.set(langEn)
        this.localeRu = false
        this.$i18n.locale = 'en-US'
      }
    }
  }
}
</script>

<style scoped>

</style>
