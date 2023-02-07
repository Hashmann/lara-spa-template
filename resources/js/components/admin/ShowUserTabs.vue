<template>
  <div class="info col-12 col-md-6 q-mt-xs">
    <q-card class="q-ma-xs" style="height: 100%">
      <q-tabs
        v-model="tab"
        dense
        active-color="primary"
        indicator-color="purple"
        align="justify"
      >
        <q-tab name="information" label="Информация"/>
        <q-tab name="expert" label="Эксперт" v-if="is('super-admin | admin | support')"/>
        <q-tab name="author" label="Автор" v-if="is('super-admin | admin | support | employee')"/>
        <q-tab name="employee" label="Сотрудник" v-if="is('super-admin')"/>
        <q-tab name="order" label="Заказы" v-if="is('super-admin | admin | support | employee')"/>
        <q-tab name="comments" label="Комментарии" v-if="is('super-admin | admin | support | employee')"/>
        <q-tab name="messages" label="Сообщения" v-if="is('super-admin | admin | support')"/>
        <q-tab name="reviews" label="Отзывы" v-if="is('super-admin | admin | support | employee')"/>
        <q-tab name="photos" label="Фото" v-if="is('super-admin | admin | support')"/>
        <q-tab name="support" label="Поддержка" v-if="is('super-admin')"/>
        <q-tab name="rating" label="Оценки" v-if="is('super-admin | admin | support')"/>
      </q-tabs>
      <q-tab-panels v-model="tab" animated swipeable class="">
        <q-tab-panel name="information">
          <div class="text-h6">Информация</div>
          ФОТО, wishList, Награды
          <q-item clickable v-ripple>
            <q-item-section>
              <q-select :loading="loading" map-options emit-value transition-show="jump-up"
                        transition-hide="jump-up" borderless v-model="user.locale" @popup-hide="saveUser"
                        :options="locale" :label="'Локаль'"/>
            </q-item-section>
            <q-item-section avatar>
              <q-avatar text-color="green-10" icon="lock_open"/>
            </q-item-section>
          </q-item>
          <q-item clickable v-ripple>
            <q-item-section>
              <q-select :loading="loading" map-options emit-value transition-show="jump-up"
                        transition-hide="jump-up" borderless v-model="user.theme" @popup-hide="saveUser"
                        :options="theme" :label="'Тема оформления'"/>
            </q-item-section>
            <q-item-section avatar>
              <q-avatar text-color="green-10" icon="lock_open"/>
            </q-item-section>
          </q-item>
          <q-item clickable v-ripple>
            <q-item-section>
              <q-select :loading="loading" map-options emit-value transition-show="jump-up"
                        transition-hide="jump-up" borderless v-model="user.currency" @popup-hide="saveUser"
                        :options="currency" :label="'Валюта'"/>
            </q-item-section>
            <q-item-section avatar>
              <q-avatar text-color="green-10" icon="lock_open"/>
            </q-item-section>
          </q-item>
          <q-item clickable v-ripple>
            <q-item-section>
              <q-select :loading="loading" map-options emit-value transition-show="jump-up"
                        transition-hide="jump-up" borderless v-model="user.ban" @popup-hide="saveUser"
                        :options="ban" :label="'Бан'"/>
            </q-item-section>
            <q-item-section avatar>
              <q-avatar text-color="green-10" icon="lock_open"/>
            </q-item-section>
          </q-item>
        </q-tab-panel>
        <q-tab-panel name="expert" v-if="is('super-admin | admin | support')">
          <div class="text-h6">expert</div>
          Организация
          Продукт
          Сотрудники
        </q-tab-panel>
        <q-tab-panel name="author" v-if="is('super-admin | admin | support | employee')">
          <div class="text-h6">author</div>
          Статьи
        </q-tab-panel>
        <q-tab-panel name="employee" v-if="is('super-admin')">
          <div class="text-h6">employee</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
        <q-tab-panel name="order" v-if="is('super-admin | admin | support | employee')">
          <div class="text-h6">order</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
        <q-tab-panel name="comments" v-if="is('super-admin | admin | support | employee')">
          <div class="text-h6">comments</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
        <q-tab-panel name="messages" v-if="is('super-admin | admin | support')">
          <div class="text-h6">messages</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
        <q-tab-panel name="reviews" v-if="is('super-admin | admin | support | employee')">
          <div class="text-h6">reviews</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
        <q-tab-panel name="photos" v-if="is('super-admin | admin | support')">
          <div class="text-h6">photos</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
        <q-tab-panel name="support" v-if="is('super-admin')">
          <div class="text-h6">support</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
        <q-tab-panel name="rating" v-if="is('super-admin | admin | support')">
          <div class="text-h6">rating</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
      </q-tab-panels>
    </q-card>
  </div>
</template>

<script>
import {ref} from "vue";
import {Quasar} from "quasar";
import axios from "../../../axios/axios-instance";

export default {
  name: "ShowUserTabs",
  setup() {
    return {
      tab: ref('information'),
    }
  },
  data: () => ({
    user: {},
    loading: false,
    locale: ['ru-RU', 'en-US'],
    theme: ['LIGHT', 'DARK'],
    currency: ['RUB', 'USD'],
    // ban: ['НЕТ', 'ДА']
  }),
  mounted() {
    console.log("mounted ShowUserTabs")
    this.getInfoUser()
  },
  unmounted() {
    console.log("unmounted ShowUserTabs")
  },
  computed: {
    getCurrentUser: {
      get() {
        return this.$store.getters.GET_AUTH_USER
      }
    },
    ban() {
      let ban = [
        {
          label: 'НЕТ',
          value: '0',
        },
        {
          label: 'ДА',
          value: '1',
        },
      ]
      return ban
    },
  },
  watch: {
    getCurrentUser() {
      this.authUser = this.getCurrentUser
    },
  },
  methods: {
    async getInfoUser() {
      await axios.get('/api/v1/admin/users/' + this.$route.params.userId)
        .then(response => {
          this.user = response.data.data[0]
          console.log(this.user, 'user')
          this.loading = false
        })
        .catch(error => {
          console.log(error)
          this.errored = true
        })
        .finally(() => {
          this.loading = false
        })
    },
  }
}
</script>

<style scoped>

</style>
