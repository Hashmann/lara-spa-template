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
        <router-link :to="{name: 'admin.dashboard'}">
          <q-item
            :active="url.admin.includes(currentLink)"
            @click="link = $t('admin.drawer.home')"
            clickable
            v-ripple>
            <q-item-section avatar>
              <q-icon name="home_work"/>
            </q-item-section>

            <q-item-section>
              {{ $t('admin.drawer.home') }}
            </q-item-section>
          </q-item>
        </router-link>

        <router-link :to="{name: 'admin.users'}" v-if="is('super-admin | admin | employee | support')">
          <q-item
            :active="url.users.includes(currentLink)"
            @click="link = $t('admin.drawer.users')"
            clickable
            v-ripple>

            <q-item-section avatar>
              <q-icon name="groups"/>
            </q-item-section>

            <q-item-section>
              {{ $t('admin.drawer.users') }}
            </q-item-section>
          </q-item>
        </router-link>

        <router-link :to="{name: 'admin.permissions'}" v-if="can('admin-panel') || is('super-admin')">
          <q-item
            :active="url.permissions.includes(currentLink)"
            @click="link = $t('admin.drawer.permissions')"
            clickable
            v-ripple>

            <q-item-section avatar>
              <q-icon name="policy"/>
            </q-item-section>

            <q-item-section>
              {{ $t('admin.drawer.permissions') }}
            </q-item-section>
          </q-item>
        </router-link>

        <q-separator/>

        <q-item clickable v-ripple>
          <q-item-section avatar>
            <q-icon name="settings"/>
          </q-item-section>

          <q-item-section>
            Settings
          </q-item-section>
        </q-item>

      </q-list>
    </q-scroll-area>
  </q-drawer>
</template>

<script>
import {ref} from 'vue'

export default {
  name: "AdminDrawer",
  props: ['drawer'],
  mounted() {
    console.log("mounted AdminDrawer")
  },
  unmounted() {
    console.log("unmounted AdminDrawer")
  },
  setup() {
    return {
      miniState: ref(true)
    }
  },
  data: () => ({
    link: '',
    url: {
      admin: ['admin.dashboard'],
      users: ['admin.users','admin.user.show'],
      permissions: ['admin.permissions']
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
