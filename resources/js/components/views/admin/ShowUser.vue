<template>
  <div class="container q-mt-none q-pt-none">
    <div class="info-wrap column wrap">
      <p>Привет {{ getCurrentUser.surname }} {{ getCurrentUser.name }}! Твои роли: <span class="q-pl-sm"
                                                                                         v-for="role in getCurrentUser.role"
                                                                                         :key="role">{{ role }}</span>
      </p>

      <!--      Роли {{ currentUserRole }}-->

      <!--      Avatar-&#45;&#45; {{ getCurrentUser.avatar }}<br>-->
      <!--      Avatar user.avatar-&#45;&#45; {{ user.avatar }}<br>-->
      <!--      OLD Avatar user.oldAvatar-&#45;&#45; {{ user.oldAvatar }}<br>-->
      <!--      getCurrentRoles-&#45;&#45; {{ getCurrentRoles }}<br>-->
      <!--      getCurrentUser-&#45;&#45; ID: {{ getCurrentUser.id }} SURNAME: {{getCurrentUser.surname}} NAME: {{getCurrentUser.name}}<br>-->

      <div class="row">
        <div class="info col-12 col-md-6 q-mt-xs">
          <q-card class="q-ma-xs" style="height: 100%">
            <div class="q-pa-md row wrap">
              <div class="col-12 col-md-6 q-mt-xs">
                <div class="col-12 col-md-6">
                  <q-avatar style="width: 400px;height: 400px" class="avatar" round>
                    <q-img style="height: 100%;"
                           :src="!this.user.avatar ? '/storage/assets/images/no-avatar-man.svg' : '/storage/' + this.user.avatar"
                           alt="avatar"></q-img>
                  </q-avatar>


                </div>


                <form v-if="is('super-admin | admin')">
                  <label for="task_file">Фото профиля:</label><br>
                  <input name="avatar" type="file" id="task_file" class="form-control" @change="selectedTaskFile">
                  <!--                  <q-btn @click.prevent="saveUser">Сохранить</q-btn>-->
                </form>

                <!--                {{user.avatar.url}}<br>-->


                <!--                <div>-->
                <!--                  <q-uploader-->
                <!--                    url="http://localhost:8000/avatars"-->
                <!--                    label="Изменить аватар"-->
                <!--                    color="purple"-->
                <!--                    square-->
                <!--                    flat-->
                <!--                    bordered-->
                <!--                    accept=".jpg, image/*"-->
                <!--                    @rejected="onRejected"-->
                <!--                    style="max-width: 100%; width: 100%;"-->
                <!--                  />-->
                <!--                </div>-->
              </div>
              <div class="col-12 col-md-6 q-mt-xs">
                <div class="q-pa-md" style="max-width: 100%; display: inline;">
                  <div class="row justify-between" style="padding-right: 6%;padding-left: 2%;">
                    <q-btn @click.stop="logoutUser(user.id)" class="q-ml-sm" round icon="logout" size="sm" color="amber-10" :disable="is('super-admin | admin | support') === false">
                      <q-tooltip class="bg-amber-10 text-bold" transition-show="scale" transition-hide="scale" anchor="top middle" self="center middle" :offset="[15, 15]">Прервать сессию пользователя</q-tooltip>
                    </q-btn>
                    <q-btn @click.stop="deleteUser(user.id)" class="q-ml-sm" round icon="delete" size="sm" color="red-10" :disable="(can('user-delete') === false) && (is('super-admin') === false)">
                      <q-tooltip class="bg-red-10 text-bold" transition-show="scale" transition-hide="scale" anchor="top middle" self="center middle" :offset="[15, 15]">Удалить пользователя</q-tooltip>
                    </q-btn>
                  </div>
                  <div class="row justify-center">
                    <!--                TODO переделать, вычисления выполняются два раза-->
                    <span style="font-size: 12px;">
                      {{ formatOnline ? 'Сейчас' : 'Последний раз онлайн:   ' }}
                      <q-badge class="q-ml-sm" :color="activityColor(this.formatOnline)"
                               :label="dateFormatOnline(user.last_activity_at)"/>
                    </span>
                    <!--                TODO END-->
                  </div>

                  <q-list bordered separator>

                    <q-item disable v-ripple>
                      <q-item-section>
                        <q-input :loading="loading" borderless v-model="user.id" label="ID"/>
                      </q-item-section>
                      <q-item-section>

                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar text-color="red-10" icon="lock"/>
                      </q-item-section>
                    </q-item>

                    <q-item clickable v-ripple>
                      <q-item-section>
                        <q-input :disable="can('user-edit') === false && is('super-admin') === false" :loading="loading" borderless v-model="user.surname" @blur="saveUser"
                                 :label="this.$t('infoUser.surname')"/>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar :text-color="can('user-edit') === true || is('super-admin') === true ? 'green-10' : 'red-10'" :icon="can('user-edit') === true || is('super-admin') === true ? 'lock_open' : 'lock'"/>
                      </q-item-section>
                    </q-item>

                    <q-item clickable v-ripple>
                      <q-item-section>
                        <q-input :disable="can('user-edit') === false && is('super-admin') === false" :loading="loading" borderless v-model="user.name" @blur="saveUser"
                                 :label="this.$t('infoUser.name')"/>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar :text-color="can('user-edit') === true || is('super-admin') === true ? 'green-10' : 'red-10'" :icon="can('user-edit') === true || is('super-admin') === true ? 'lock_open' : 'lock'"/>
                      </q-item-section>
                    </q-item>


                    <q-item clickable v-ripple>
                      <q-item-section>
                        <q-input :disable="can('user-edit') === false && is('super-admin') === false" :loading="loading" borderless v-model="user.patronymic" @blur="saveUser"
                                 :label="this.$t('infoUser.patronymic')"/>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar :text-color="can('user-edit') === true || is('super-admin') === true ? 'green-10' : 'red-10'" :icon="can('user-edit') === true || is('super-admin') === true ? 'lock_open' : 'lock'"/>
                      </q-item-section>
                    </q-item>

                    <q-item clickable v-ripple>
                      <q-item-section>
                        <q-select :disable="can('user-edit') === false && is('super-admin') === false" :loading="loading" map-options emit-value transition-show="jump-up"
                                  transition-hide="jump-up" borderless v-model="user.gender" @popup-hide="saveUser"
                                  :options="gender" :label="this.$t('infoUser.gender.gender')"/>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar :text-color="can('user-edit') === true || is('super-admin') === true ? 'green-10' : 'red-10'" :icon="can('user-edit') === true || is('super-admin') === true ? 'lock_open' : 'lock'"/>
                      </q-item-section>
                    </q-item>

                    <!--                    <q-input borderless v-model="user.birth_date" @blur="saveUser" label="Фамилия" />-->

                    <q-item clickable v-ripple>
                      <q-item-section>
                        <div class="" style="">
                          <q-input :disable="can('user-edit') === false && is('super-admin') === false" :loading="loading" class="q-pa-none" :label="this.$t('infoUser.birthday')" borderless
                                   v-model="user.birth_date" mask="date" :rules="['date']">
                            <template v-slot:append>
                              <q-icon name="event" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                  <q-date v-model="user.birth_date">
                                    <div class="row items-center justify-end">
                                      <q-btn v-close-popup label="Сохранить" color="primary" flat
                                             @click.prevent="saveUser"/>
                                    </div>
                                  </q-date>
                                </q-popup-proxy>
                              </q-icon>
                            </template>
                          </q-input>
                        </div>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar :text-color="can('user-edit') === true || is('super-admin') === true ? 'green-10' : 'red-10'" :icon="can('user-edit') === true || is('super-admin') === true ? 'lock_open' : 'lock'"/>
                      </q-item-section>
                    </q-item>

                    <q-item clickable v-ripple>
                      <q-item-section>
                        <q-input :disable="can('user-edit-more') === false && is('super-admin') === false" :loading="loading" borderless v-model="user.email" @blur="saveUser" label="E-mail"/>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar :text-color="can('user-edit-more') === true || is('super-admin') === true ? 'green-10' : 'red-10'" :icon="can('user-edit-more') === true || is('super-admin') === true ? 'lock_open' : 'lock'"/>
                      </q-item-section>
                    </q-item>

                    <q-item clickable v-ripple>
                      <q-item-section>
                        <q-select
                          :disable="can('user-role') === false && is('super-admin') === false"
                          borderless
                          v-model="user.role"
                          use-input
                          use-chips
                          multiple
                          input-debounce="0"
                          @new-value="createValue"
                          :options="getRoles"
                          @filter="filterFn"
                          :label="this.$t('infoUser.role')"
                          @popup-hide="saveRole"
                          @remove="saveRole"
                          @add="saveRole"
                          @blur="saveRole"
                          @update="saveRole"
                          :loading="loading"
                        />
                        <!--                        {{getRoles}}-->
                        <!--                        user.role:{{user.role}}<br>-->
                        <!--                        user.role.name:{{user.role.name}}<br>-->
                        <!--                        getRoles:{{getRoles}}<br>-->
                        <!--                        <br>-->
                        <!--                        {{currentRole}}-->
                        <!--                        <span v-for="role in getRoles" key="role">{{role}}</span>-->

                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar :text-color="can('user-role') === true || is('super-admin') === true ? 'green-10' : 'red-10'" :icon="can('user-role') === true || is('super-admin') === true ? 'lock_open' : 'lock'"/>
                      </q-item-section>
                    </q-item>

                    <q-item clickable v-ripple>
                      <q-item-section>
                        <q-select :disable="can('user-edit-more') === false && is('super-admin') === false" :loading="loading" transition-show="jump-up" transition-hide="jump-up" borderless
                                  v-model="user.status" @popup-hide="saveUser" :options="status"
                                  :label="this.$t('infoUser.status.status')"/>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar :text-color="can('user-edit-more') === true || is('super-admin') === true ? 'green-10' : 'red-10'" :icon="can('user-edit-more') === true || is('super-admin') === true ? 'lock_open' : 'lock'"/>
                      </q-item-section>
                    </q-item>

                    <!--                    <q-item clickable v-ripple>-->
                    <!--                      <q-item-section>-->
                    <!--                        <q-badge :color="activityColor(dateFormatOnline(user.last_activity_at))" :label="dateFormatOnline(user.last_activity_at)" />-->
                    <!--                      </q-item-section>-->
                    <!--                      <q-item-section avatar>-->
                    <!--                        <q-avatar text-color="green-10" icon="lock_open" />-->
                    <!--                      </q-item-section>-->
                    <!--                    </q-item>-->

                    <q-item disable v-ripple>
                      <q-item-section>
                        <span>{{ this.$t('infoUser.create') }}</span><span>{{ dateFormat(user.created_at) }}</span>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar text-color="red-10" icon="lock"/>
                      </q-item-section>
                    </q-item>

                    <q-item disable v-ripple>
                      <q-item-section>
                        <span>{{ this.$t('infoUser.update') }}</span><span>{{ dateFormat(user.updated_at) }}</span>
                      </q-item-section>
                      <q-item-section avatar>
                        <q-avatar text-color="red-10" icon="lock"/>
                      </q-item-section>
                    </q-item>

                  </q-list>
                </div>
              </div>


            </div>
          </q-card>
        </div>

        <ShowUserTabs/>
      </div>


      <div class="row q-mt-xs">
        <div class="info col-12">
          <q-card class="q-ma-xs">
            Статистика
          </q-card>
        </div>
      </div>


    </div>
  </div>
</template>

<script>
import {ref} from "vue";
import axios from "../../../../axios/axios-instance";

import {date, useQuasar} from 'quasar'
// import {mapActions, mapGetters} from 'vuex'

import moment from 'moment/src/moment';
import 'moment/src/locale/ru.js'

moment.locale('ru')

const stringOptions = [
  'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
]
export default {
  name: "ShowUser",
  props: [
    'userId'
  ],
  setup() {
    const $q = useQuasar()

    function onRejected(rejectedEntries) {
      // Notify plugin needs to be installed
      // https://quasar.dev/quasar-plugins/notify#Installation
      $q.notify({
        type: 'negative',
        message: `${rejectedEntries.length} file(s) did not pass validation constraints`
      })
    }

    const filterOptions = ref(stringOptions)

    return {
      tab: ref('information'),
      label: ref(''),

      model: ref(null),

      filterOptions,

      createValue(val, done) {
        // Calling done(var) when new-value-mode is not set or "add", or done(var, "add") adds "var" content to the model
        // and it resets the input textbox to empty string
        // ----
        // Calling done(var) when new-value-mode is "add-unique", or done(var, "add-unique") adds "var" content to the model
        // only if is not already set
        // and it resets the input textbox to empty string
        // ----
        // Calling done(var) when new-value-mode is "toggle", or done(var, "toggle") toggles the model with "var" content
        // (adds to model if not already in the model, removes from model if already has it)
        // and it resets the input textbox to empty string
        // ----
        // If "var" content is undefined/null, then it doesn't tampers with the model
        // and only resets the input textbox to empty string

        if (val.length > 2) {
          if (!stringOptions.includes(val)) {
            done(val, 'add-unique')
          }
        }
      },

      filterFn(val, update) {
        update(() => {
          if (val === '') {
            filterOptions.value = stringOptions
          } else {
            const needle = val.toLowerCase()
            filterOptions.value = stringOptions.filter(
              v => v.toLowerCase().indexOf(needle) > -1
            )
          }
        })
      },

      showNotify(message, type) {
        $q.notify({
          message: message,
          //INFO type - 'positive', 'negative', 'warning', 'info', 'ongoing'
          type: type,
          // color: 'purple',
          position: 'bottom-right',
          timeout: 1500,
        })
      }
    }
  },
  data() {
    return {
      user: {
        surname: '',
        patronymic: '',
        gender: ref(null),
        avatar: '',
        birth_date: ref('2019-02-01'),
        role: {
          name
        },
        status: '',
        name: '',
        oldAvatar: '',
        last_activity_at: '',
      },
      // rook: '',
      // image: '',
      getRolesAll: [],
      currentRole: [],
      // currentUser: null,
      errored: false,
      loading: ref(true),
      formatOnline: '',
      // createdAt: '',
      // timeStamp: '',
      date: ref('2019-02-01'),

      // gender: [
      //   'Не указан', 'Женский', 'Мужской'
      // ],
      // gender: [
      //   {
      //     label: this.$t('gender.notSpecified'),
      //     value: '0',
      //   },
      //   {
      //     label: this.$t('gender.male'),
      //     value: '1',
      //   },
      //   {
      //     label: this.$t('gender.female'),
      //     value: '2',
      //   }
      // ],

      // file: ref(null),
      //TODO сделать для статусов таблицу
      status: [
        'not confirmed', 'active', 'inactive', 'deleted'
      ],
      // url : '/api/v1/',
      // currentUser: null,
      // currentUserRole: null,
      uploadPercentage: 0,
      modelMultiple: ref(['admin']),
    }
  },
  mounted() {
    this.getInfoUser()
    console.log("mounted ShowUser")
  },
  unmounted() {
    console.log("unmounted ShowUser")
  },
  methods: {
    async getInfoUser() {
      await axios.get('/api/v1/admin/users/' + this.$route.params.userId)
        .then(response => {
          this.user = response.data.data[0]
          this.user.oldAvatar = response.data.data[0].avatar
          // console.log(this.user, 'user')
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
    dateFormat(value) {
      return date.formatDate(value, 'DD.MM.YYYY Время: hh:mm:ss')
    },
    saveUser() {
      axios.put('/api/v1/admin/users/' + this.$route.params.userId, {
        name: this.user.name,
        surname: this.user.surname,
        patronymic: this.user.patronymic,
        birth_date: this.user.birth_date,
        email: this.user.email,
        gender: this.user.gender,
        status: this.user.status,
        avatar: this.user.avatar,
      })
        .then(response => {
          // this.user = response.data.data[0]
          // console.log(this.user, 'USEEER')
          this.showNotify('Данные пользователя успешно обновлены', 'positive')
          this.$store.dispatch('getCurrentUser')
        })
        .catch(error => {
          console.log(error)
          this.showNotify('Ошибка обновления данных пользователя', 'negative')
          // this.errored = true
        })
        .finally(() => {
          this.loading = false
        })

      // axios.put('/api/v1/admin/users/' + this.$route.params.userId, {
      //   name: this.user.name,
      // }).then(res => {
      //   // this.$router.push({name: 'dashboard'})
      //   console.log(res)
      // })
    },
    saveRole() {
      setTimeout(() => {
        axios.put('/api/v1/admin/update/role/' + this.$route.params.userId, {
          role: this.user.role,
        })
          .then(response => {
            // this.user = response.data.data[0]
            // console.log(response.data, 'RoolEEE')
            this.showNotify('Роли пользователя успешно обновлены', 'positive')
            this.$store.dispatch('getCurrentRoles')
            //TODO !!!
            // this.$store.dispatch('getCurrentUser')
          })
          .catch(error => {
            console.log(error)
            this.showNotify('Ошибка обновления роли пользователя', 'negative')
            // this.errored = true
          })
      }, 1)
    },
    // uploadFile (file, updateProgress) {
    //   const fd = new FormData()
    //   fd.append('image', file)
    //   // this.user.avatar = file.name
    //   updateProgress(0)
    //   return new Promise((resolve, reject) => {
    //     axios.post('/api/v1/upload/',
    //       fd,
    //       {
    //         headers: { 'Content-Type': 'multipart/form-data' },
    //         onUploadProgress: (progressEvent) => {
    //           updateProgress(Math.round((progressEvent.loaded / progressEvent.total) * 100) / 100)
    //         }
    //       })
    //       .then(res => {
    //         resolve(file)
    //       })
    //       .catch(err => reject(err))
    //   })
    // },
    selectedTaskFile(e) {
      const formData = new FormData()
      formData.set('image', e.target.files[0])

      if (this.user.oldAvatar) {
        axios.post('/api/v1/upload/del', {path: this.user.oldAvatar})
          .then(res => {
            // console.log(res, 'res')
            this.saveUser()
            this.user.oldAvatar = this.user.avatar
            this.$store.dispatch('getCurrentUser')
          })
      }
      axios.post('/api/v1/upload/', formData, {
        headers: {'Content-Type': 'multipart/form-data'},
      })
        .then(res => {
          // console.log(res, 'upload image')
          this.user.avatar = res.data
          this.saveUser()
          this.user.oldAvatar = this.user.avatar
          this.$store.dispatch('getCurrentUser')
        })
    },
    activityColor(value) {
      if (value === 'online') {
        return 'green'
      } else {
        return 'red'
      }
    },
    dateFormatOnline(value) {
      let firstDateRaw = new Date(value)
      let firstDate = firstDateRaw.getTime()
      // console.log(firstDate, 'firstDate')
      let secondDateRaw = new Date()
      let secondDate = secondDateRaw.getTime()
      // console.log(secondDate, 'secondDate')

      let result = (secondDate - firstDate) / 60 / 60
      // console.log(result, 'result')

      if (result < 60 * 2) {
        this.formatOnline = 'online'
        return 'online'
      } else {
        this.formatOnline = ''
        return moment(value).startOf('second').fromNow();
      }
    },
    logoutUser(id) {
      axios.get('/api/v1/logout-user/' + id).then(res => {
        // this.$store.dispatch('getUsers')
        console.log('User logout')
      })
    },
    deleteUser(id) {
      axios.delete('/api/v1/admin/users/' + id).then(res => {
        this.$router.push({name: 'admin.users'})
        this.$store.dispatch('getUsers')
      })
    },
  },
  // methods: mapActions(["getUser"]),
  computed: {
    getCurrentUser: {
      get() {
        return this.$store.state.users.currentUser
      }
    },
    getCurrentRoles: {
      get() {
        return this.$store.state.users.currentRoles
      }
    },
    getRoles: {
      get() {
        return this.$store.state.users.roleList
      }
    },
    gender() {
      let gender = [
        {
          label: this.$t('infoUser.gender.notSpecified'),
          value: '0',
        },
        {
          label: this.$t('infoUser.gender.male'),
          value: '1',
        },
        {
          label: this.$t('infoUser.gender.female'),
          value: '2',
        }
      ]
      return gender
    },
  },
  // computed: mapGetters(["user"]),
  // created() {
  //   this.$store.dispatch('getUser')
  //   // console.log(this.user);
  // },

  created() {
    this.currentUser = this.$store.dispatch('getCurrentUser')
    this.currentUserRole = this.$store.dispatch('getCurrentRoles')
    this.getRolesAll = this.$store.dispatch('getRoles')

    // if (window.Laravel.currentUser) {
    //   this.currentUser = window.Laravel.currentUser
    //   this.currentUserRole = window.Laravel.currentUserRole
    // }

    // this.getCurrentRoles.forEach(r => {
    //   this.roles.add(r.name);
    // });
  }

}
</script>

<style scoped>
.row {
  /*max-width: 100%;*/
}

.q-item {
  border: none !important;
}

.q-focus-helper {
  border: none !important;
}

.q-pa-md {
  border: none !important;
}

.q-list.q-list--bordered.q-list--separator.q-list--dark {
  border: none !important;
}

.q-list.q-list--bordered.q-list--separator {
  border: none !important;
}

.q-uploader__list {
  min-height: auto !important;
  border: none !important;
  padding: 0 !important;
}

.q-uploader.column.no-wrap.q-uploader--dark.q-dark.q-uploader--bordered.q-uploader--square.no-border-radius.q-uploader--flat.no-shadow {
  max-width: 100%;
  width: 100%;
  height: fit-content;
  display: contents;
}

.q-tabs__content {
  max-width: 90% !important;
  justify-content: center !important;
}

.check:hover {
  color: darkgreen !important;
}

.q-item {
  padding-left: 5%;
  padding-right: 5%;
  padding-top: 0;
  padding-bottom: 0;
}

.q-item:hover {
  cursor: pointer;
}

.q-field__inner.relative-position.col.self-stretch:hover {
  cursor: pointer;
}

.q-img {
  /*height: 100%;*/
}

.green {
  color: darkgreen !important;
}

.q-badge {
  width: min-content;
}
</style>
