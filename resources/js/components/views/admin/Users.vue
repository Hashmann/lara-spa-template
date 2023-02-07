<template>
  <div class="q-pa-md">
    <q-table
      :grid="$q.screen.xs"
      :title="$t('admin.page.users.title')"
      :rows="getUsers"
      :columns="columnsI18n"
      row-key="id"
      :filter="filter"
      virtual-scroll
      @row-click="userEdit"
      :loading="loading"
      :pagination="pagination"
    >

      <template v-slot:loading>
        <q-inner-loading showing color="primary" />
      </template>
      <template v-slot:top-left>
        <q-btn :label="$t('admin.page.users.addUser')" color="primary" @click="icon = true" />
        <q-dialog v-model="icon">
          <q-card>
            <q-card-section class="row items-center q-pb-none">
              <div class="text-h6">Новый пользователь</div>
              <q-space />
              <q-btn icon="close" flat round dense v-close-popup />
            </q-card-section>
            <q-card-section>
              <q-input v-model="user.name" filled type="text" label="Имя">
                <template v-slot:append>
                  <q-icon name="badge"/>
                </template>
              </q-input>
              <q-input v-model="user.email" filled type="email" label="E-mail">
                <template v-slot:append>
                  <q-icon name="alternate_email"/>
                </template>
              </q-input>
              <q-input v-model="user.password" filled :type="isPwd ? 'password' : 'text'" label="Пароль" hint="">
                <template v-slot:append>
                  <q-icon
                    :name="isPwd ? 'visibility_off' : 'visibility'"
                    class="cursor-pointer"
                    @click="isPwd = !isPwd"
                  />
                </template>
              </q-input>
              <q-input v-model="user.password_confirmation" filled :type="isPwdConf ? 'password' : 'text'" label="Подтверждение пароля" hint="">
                <template v-slot:append>
                  <q-icon
                    :name="isPwdConf ? 'visibility_off' : 'visibility'"
                    class="cursor-pointer"
                    @click="isPwdConf = !isPwdConf"
                  />
                </template>
              </q-input>
            </q-card-section>
            <q-card-actions align="right" class="bg-white text-teal">
              <q-btn @click.prevent="addUser" :disable="user.email && user.password && user.password_confirmation ? false : true" flat label="Добавить пользователя" color="primary" v-close-popup />
            </q-card-actions>
          </q-card>
        </q-dialog>
      </template>

      <template v-slot:top-right>
        <q-input borderless dense debounce="300" v-model="filter" :placeholder="$t('admin.page.users.table.search')">
          <template v-if="filter" v-slot:prepend>
            <q-icon name="cancel" @click.stop.prevent="filter = null" class="cursor-pointer"/>
          </template>
          <template v-slot:append>
            <q-icon name="search"/>
          </template>
        </q-input>
      </template>
      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <div class="my-table-actions">
<!--            <q-btn round icon="edit" size="xs" color="green-8"></q-btn>-->
            <q-btn class="q-ml-sm" round icon="sms" size="xs" color="green-8"></q-btn>
            <q-btn @click.stop="logoutUser(props.key)" class="q-ml-sm" round icon="logout" size="xs" color="amber-10">
              <q-tooltip class="bg-amber-10 text-bold" transition-show="scale" transition-hide="scale" anchor="top middle" self="center middle" :offset="[15, 15]">Прервать сессию пользователя</q-tooltip>
            </q-btn>
            <q-btn @click.stop="confirmDeleteFunc(props)" class="q-ml-sm" round icon="delete" size="xs" color="red-10" v-if="can('user-delete') || is('super-admin')">
              <q-tooltip class="bg-red-10 text-bold" transition-show="scale" transition-hide="scale" anchor="top middle" self="center middle" :offset="[15, 15]">Удалить пользователя</q-tooltip>
            </q-btn>

            <q-dialog  v-model="confirmDelete" persistent>
              <q-card>
                <q-card-section class="row items-center no-wrap">
                  <q-avatar size="70px">
                    <q-img style="height: 100%" :src="!this.deleteItem.avatar ? '/storage/assets/images/no-avatar-man.svg' : '/storage/' + this.deleteItem.avatar"></q-img>
                  </q-avatar>
                  <span class="q-ml-sm">Удалить пользователя: {{this.deleteItem.surname}} {{this.deleteItem.name}} {{this.deleteItem.patronymic}}?</span>
                </q-card-section>
                <q-card-actions align="right">
                  <q-btn flat label="Отмена" color="positive" v-close-popup />
                  <q-btn flat label="Удалить" color="negative" @click.stop="deleteUser(this.deleteItem.id)" v-close-popup />
                </q-card-actions>
              </q-card>
            </q-dialog>
          </div>
        </q-td>
      </template>
      <template v-slot:body-cell-id="props">
        <q-td :props="props">
          <q-badge color="accent" :label="props.value"/>
        </q-td>
      </template>
      <template v-slot:body-cell-patronymic="props">
        <q-td :props="props">
          {{props.value}}
        </q-td>
      </template>
      <template v-slot:body-cell-avatar="props">
        <q-td :props="props">
          <q-avatar size="xl">
            <q-img style="height: 100%" :src="!props.value ? '/storage/assets/images/no-avatar-man.svg' : '/storage/' + props.value"></q-img>
          </q-avatar>
        </q-td>
      </template>
      <template v-slot:body-cell-role="props">
        <q-td class="td-roles" :props="props">
          <div class="row role-wrap">
            <div class="role" v-for="role in props.value" :key="role">
              <q-chip dense size="12px" :color="changeColorRole(role)"
                      text-color="white">
<!--            <q-chip dense size="12px" :color="changeColorRole(props.value.name)">-->
<!--                {{ props.value.name }}-->
                {{ role }}
              </q-chip>
            </div>
          </div>
        </q-td>
      </template>
      <template v-slot:body-cell-status="props">
        <q-td :props="props">
          <!--                    <q-badge :color="-->
          <!--                            props.value === 'active' ? 'green' : 'blue' &&-->
          <!--                            props.value === 'inactive' ? 'amber-10' : 'blue' &&-->
          <!--                            props.value === 'delete' ? 'red-10' : 'blue'" :label="props.value" />-->
          <q-badge ref="badge" :color="changeColorStatus(props.value)" :label="props.value"/>
        </q-td>
      </template>
      <template v-slot:body-cell-last_activity_at="props">
        <q-td :props="props">
<!--          TODO переделать, вычисления выполняются два раза-->
          <q-badge ref="badgeState" :color="activityColor(dateFormatOnline(props.value))" :label="dateFormatOnline(props.value)" />
<!--          TODO END-->
        </q-td>
      </template>
    </q-table>
  </div>




</template>

<script>
import {ref} from 'vue'
import axios from "../../../../axios/axios-instance";
import {date} from "quasar";


import moment from 'moment/src/moment';
import 'moment/src/locale/ru.js'
moment.locale('ru')


export default {
  name: "Users",
  setup() {
    return {
      filter: ref(''),
      // rows,

      icon: ref(false),
      isPwd: ref(true),
      isPwdConf: ref(true),
      confirmDelete: ref(false),
      // loading: ref(false),
      pagination: {
        rowsPerPage: 15
      },
    }
  },
  mounted() {
    this.mTitle()
    console.log("mounted Users")
  },
  unmounted() {
    console.log("unmounted Users")
  },

  methods: {
    mTitle() {
      document.title = 'Пользователи'
    },
    activityColor(value) {
      if (value === 'online') {
        return 'green'
      } else {
        return 'red'
      }
    },
    changeColorStatus(value) {
      if (value === 'delete') {
        return 'red-10'
      }
      if (value === 'active') {
        return 'green'
      } else {
        return 'amber-10'
      }
    },
    changeColorRole(value) {
      if (value === 'admin') {
        return 'red-10'
      }
      if (value === 'user') {
        return 'green-10'
      }
      if (value === 'expert') {
        return 'accent'
      }
      if (value === 'staff') {
        return 'amber-10'
      }
      if (value === 'author') {
        return 'cyan-10'
      }
      if (value === 'employee') {
        return 'secondary'
      }
      if (value === 'support') {
        return 'deep-purple-13'
      }
    },
    addUser() {
      this.$store.dispatch('addUser', this.user)
      this.user.name = ''
      this.user.email = ''
      this.user.password = ''
      this.user.password_confirmation = ''
      this.user.surname = ''
      this.user.patronymic = ''
      this.user.gender = ''
      this.user.role = ''
      this.user.birth_date = ''
      this.$store.dispatch('getUsers')
    },
    deleteUser(id) {
      axios.delete('/api/v1/admin/users/' + id).then(res => {
        this.$store.dispatch('getUsers')
      })
    },
    userEdit(event, row) {
      // this.$router.push('/admin/users/' + row.id)
      this.$router.push({name : 'admin.user.show', params: {userId: row.id}})
      // console.log(row);
    },
    dateFormat(value) {
      return date.formatDate(value, 'DD.MM.YYYY Время: hh:mm:ss')
      // return date.formatDate(value, 'hh:mm:ss')
    },
    dateFormatOnline(value) {
      // let firstDate = date.formatDate(value, 'hh:mm')
      // let firstDateRaw = value
      let firstDateRaw = new Date(value)
      let firstDate = firstDateRaw.getTime()
      // console.log(firstDate, 'firstDate')
      let secondDateRaw = new Date()
      // let secondDate = date.formatDate(secondDateRaw, 'hh:mm')
      let secondDate = secondDateRaw.getTime()
      // console.log(secondDate, 'secondDate')

      let result = (secondDate - firstDate) / 60 / 60
      // console.log(result, 'result')

      if (result < 60 * 2) {
        return 'online'
      } else {
        return moment(value, '', 'ru').startOf('second').fromNow();
      }
      // let getDate = (string) => new Date(0, 0,0, string.split(':')[0], string.split(':')[1]);
      // let different = (getDate(secondDate) - getDate(firstDate));
      // let differentRes, hours, minuts;
      // if(different > 0) {
      //   differentRes = different;
      //   hours = Math.floor((differentRes % 86400000) / 3600000);
      //   minuts = Math.round(((differentRes % 86400000) % 3600000) / 60000);
      // } else {
      //   differentRes = Math.abs((getDate(firstDate) - getDate(secondDate)));
      //   hours = Math.floor(24 - (differentRes % 86400000) / 3600000);
      //   minuts = Math.round(60 - ((differentRes % 86400000) % 3600000) / 60000);
      // }
      // let result = hours + ':' + minuts;
      // console.log(result, 'RESULT')
      //
      // if (minuts === 60 || minuts < 2 && hours === 24 ) {
      //   return 'online'
      //
      // } else {
      //   return moment(value, '', 'ru').startOf('second').fromNow();
      // }

    },
    logoutUser(id) {
      axios.get('/api/v1/logout-user/' + id).then(res => {
        // this.$store.dispatch('getUsers')
        console.log('User logout')
      })
    },
    confirmDeleteFunc(item) {
      this.confirmDelete = true
      // this.deleteIndex = this.data.indexOf(item)
      this.deleteItem.id = item.key
      this.deleteItem.name = item.row.name
      this.deleteItem.surname = item.row.surname
      this.deleteItem.patronymic = item.row.patronymic
      this.deleteItem.email = item.row.email
      this.deleteItem.avatar = item.row.avatar
    }
  },
  data: () => ({
    search: '',
    user: {
      name:  '',
      email: '',
      patronymic: '',
      surname: '',
      password: ref(''),
      password_confirmation: ref(''),
      role: '',
      last_activity_at: '',
    },
    // deleteIndex: -1,
    deleteItem: {
      name: '',
      email: '',
      patronymic: '',
      surname: '',
      id: '',
      avatar: ''
    },
  }),
  computed: {
    columnsI18n() {
      let columns = [
        {
          name: 'id',
          label: '#',
          align: 'left',
          field: row => row.id,
          format: val => `${val}`,
          sortable: true
        },
        {name: 'avatar', label: this.$t('admin.page.users.table.avatar'), field: 'avatar', align: 'left'},
        {name: 'surname', align: 'left', label: this.$t('admin.page.users.table.surname'), field: 'surname', sortable: true},
        {name: 'name', align: 'left', label: this.$t('admin.page.users.table.name'), field: 'name', sortable: true},
        {name: 'patronymic', align: 'left', label: this.$t('admin.page.users.table.patronymic'), field: 'patronymic', sortable: true},
        {name: 'email', align: 'center', label: 'E-mail', field: 'email', sortable: true},
        {name: 'role', label: this.$t('admin.page.users.table.role'), field: 'role', align: 'left'},
        {name: 'status', label: this.$t('admin.page.users.table.status'), field: 'status', align: 'left', sortable: true},
        {name: 'last_activity_at', label: this.$t('admin.page.users.table.state'), field: 'last_activity_at', align: 'left', sortable: true},
        {name: 'actions', label: this.$t('admin.page.users.table.actions'), align: 'center'}
      ]
      return columns
    },
    getUsers: {
      get() {
        return this.$store.state.users.userList
      }
    },
    loading: {
      get() {
        return this.$store.state.users.loading
      }
    }
  },
  created() {
    this.$store.dispatch('getUsers')
  }
}
</script>

<style scoped lang="scss">
.q-avatar__content, .q-avatar img:not(.q-icon):not(.q-img__image) {
  object-fit: cover;
}
.role-wrap {
  width: fit-content;
}
.td-roles {
  width: min-content;
}
.q-card{
  width: 500px;
}
.q-td {
  width: min-content;
}
</style>
