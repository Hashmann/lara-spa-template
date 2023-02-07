<template>
  <q-drawer
    v-model="drawer"
    show-if-above

    :mini="miniState"
    @mouseover="miniState = false"
    @mouseout="miniState = true"
    mini-to-overlay

    :width="200"
    :breakpoint="500"
    bordered

  >
    <q-scroll-area class="fit">
      <q-list padding>
        <router-link :to="{name: 'dashboard'}">
          <q-item
            :active="url.user.includes(currentLink)"
            @click="link = $t('admin.drawer.home')"
            clickable
            v-ripple>
            <q-item-section avatar>
              <q-icon name="account_circle"/>
            </q-item-section>

            <q-item-section>
              {{ $t('home.profile.drawer.aboutMe') }}
            </q-item-section>
          </q-item>
        </router-link>

        <router-link :to="{name: 'dashboard'}">
          <q-item
            :active="url.user.includes(currentLink)"
            @click="link = $t('admin.drawer.home')"
            clickable
            v-ripple>
            <q-item-section avatar>
              <q-icon name="public"/>
            </q-item-section>

            <q-item-section>
              {{ $t('home.profile.drawer.myProducts') }}
            </q-item-section>
          </q-item>
        </router-link>

        <router-link :to="{name: 'dashboard'}">
          <q-item
            :active="url.user.includes(currentLink)"
            @click="link = $t('admin.drawer.home')"
            clickable
            v-ripple>
            <q-item-section avatar>
              <q-icon name="article"/>
            </q-item-section>

            <q-item-section>
              {{ $t('home.profile.drawer.myArticles') }}
            </q-item-section>
          </q-item>
        </router-link>

        <router-link :to="{name: 'dashboard'}">
          <q-item
            :active="url.user.includes(currentLink)"
            @click="link = $t('admin.drawer.home')"
            clickable
            v-ripple>
            <q-item-section avatar>
              <q-icon name="store"/>
            </q-item-section>

            <q-item-section>
              {{ $t('home.profile.drawer.myCompany') }}
            </q-item-section>
          </q-item>
        </router-link>

        <router-link :to="{name: 'dashboard'}">
          <q-item
            :active="url.user.includes(currentLink)"
            @click="link = $t('admin.drawer.home')"
            clickable
            v-ripple>
            <q-item-section avatar>
              <q-icon name="checklist_rtl"/>
            </q-item-section>

            <q-item-section>
              {{ $t('home.profile.drawer.myWishList') }}
            </q-item-section>
          </q-item>
        </router-link>

        <q-separator/>

        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="settings"/>
          </q-item-section>

          <q-item-section>
            {{ $t('home.profile.drawer.settings') }}
          </q-item-section>
        </q-item>

      </q-list>
    </q-scroll-area>
  </q-drawer>
</template>

<script>
import {ref} from 'vue'

export default {
  name: "UserDrawer",
  props: ['drawer'],
  mounted() {
    console.log("mounted UserDrawer")
  },
  unmounted() {
    console.log("unmounted UserDrawer")
  },
  setup() {
    return {
      miniState: ref(true)
    }
  },
  data: () => ({
    link: '',
    url: {
      user: ['dashboard'],
      // users: ['admin.users','admin.user.show'],
      // permissions: ['admin.permissions']
    }
  }),
  methods: {

  },
  computed: {
    currentLink() {
      return this.$route.name
    }
  }
}
</script>

<style scoped lang="scss">
a {
  text-decoration: none;
  color: #202020c7;
}
.q-router-link--active {
  color: #1976d2 !important;
}
.q-item--dark.q-router-link--active {
  color: #1976d2 !important;
}
</style>
