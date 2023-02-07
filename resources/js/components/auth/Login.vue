<template>
  <q-card>
    <div class="q-pa-md">
      <h5>{{ $t('login.welcome') }}</h5>
      <div>
        <q-input v-model="user.email" filled type="email" label="E-mail">
          <template v-slot:append>
            <q-icon name="alternate_email"/>
          </template>
        </q-input>
        <br>
        <q-input v-model="user.password" filled :type="isPwd ? 'password' : 'text'" :label="$t('login.pass')" hint="">
          <template v-slot:append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            />
          </template>
        </q-input>
      </div>
      <div class="row justify-center">
        <router-link :to="{name: 'registration'}"><p>{{ $t('login.reg') }}</p></router-link>
      </div>
      <div class="row justify-center">
        <router-link :to="{name: 'admin.dashboard'}">
          <q-btn class="q-ml-sm" :disable="user.email && user.password ? false : true" color="primary" @click.prevent.stop="login">{{ $t('login.login') }}</q-btn>
        </router-link>
      </div>
    </div>
  </q-card>

</template>

<script>
import {ref} from "vue";

export default {
  name: "Login",
  setup() {
    return {
      // password: ref(''),
      isPwd: ref(true),
    }
  },
  data: () => ({
    user: {
      email: '',
      password: ref('')
    }
  }),
  methods: {
    login() {
      this.$store.dispatch('loginUser', this.user)
    }
  }
}
</script>

<style scoped lang="scss">
.q-card {
  width: 500px;
}
span {
  font-size: 12px;
}
h5 {
  text-align: center;
  padding-bottom: 10px;
}
p {
  color: $primary;
}
a {
  text-decoration: none;
}
</style>
