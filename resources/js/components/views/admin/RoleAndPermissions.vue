<template>
  <div class="container q-mt-none q-pt-none">
    <div class="info-wrap row wrap justify-between">
      <q-card class="q-my-sm q-pa-sm col-12 col-md-12 row justify-between items-center">
        <span>Управление ролями и правами пользователей</span>
        <q-btn color="primary">Добавить роль</q-btn>
      </q-card>

      <q-card class="q-pa-md col-12 col-md-12">
        <q-list bordered class="rounded-borders">
          <q-expansion-item
            expand-separator
            v-for="role in getPermissions" :key="role.id"
          >
            <template v-slot:header>
              <q-item-section avatar>
                <q-avatar icon="perm_identity" color="primary" text-color="white"/>
              </q-item-section>

              <q-item-section>
                {{ role.name }}
              </q-item-section>

              <q-item-section side>
                <!--                <div class="row items-center">-->
                <!--                  <q-btn round icon="edit" size="xs" color="green-8"></q-btn>-->
                <!--                  <q-btn class="q-ml-sm" round icon="delete" size="xs" color="red-10"></q-btn>-->
                <!--                </div>-->
              </q-item-section>
            </template>

            <q-card>
              <q-card-section>
                <q-select

                  borderless
                  v-model="role.permissions"
                  use-input
                  use-chips
                  multiple
                  input-debounce="0"
                  @new-value="createValue"
                  :options="getAllPermissions"
                  @filter="filterFn"
                  label="Разрешения"
                  :loading="loading"
                  @popup-hide="savePermissions(role)"
                  @remove="savePermissions(role)"
                  @add="savePermissions(role)"
                  @blur="savePermissions(role)"
                  @update="savePermissions(role)"
                />
              </q-card-section>
            </q-card>
          </q-expansion-item>
        </q-list>
      </q-card>
    </div>
  </div>
</template>

<script>
import {ref} from "vue";
import axios from "../../../../axios/axios-instance";


const stringOptions = [
  'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
]
export default {
  name: "RoleAndPermissions",
  setup() {
    const filterOptions = ref(stringOptions)
    return {
      filterOptions,
      createValue(val, done) {
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
      }
    }
  },
  created() {
    this.$store.dispatch('getPermissions')
    this.$store.dispatch('getAllPermissions')
  },
  mounted() {
    console.log("mounted RoleAndPermissions")
  },
  unmounted() {
    console.log("unmounted RoleAndPermissions")
  },
  data: () => ({
    loading: false,
  }),
  // data() {
  //   return {
  //     loading: false,
  //   }
  // },
  computed: {
    getAllPermissions: {
      get() {
        return this.$store.state.users.allPermissions
      }
    },
    getPermissions: {
      get() {
        return this.$store.state.users.permissionsList
      }
    },
  },
  methods: {
    savePermissions(role) {
      setTimeout(() => {
        axios.put('/api/v1/admin/role/update/' + role.id, {
          permissions: role.permissions,
        })
          .then(response => {
            // console.log(response.data, 'PERMISSIONS')
            this.$store.dispatch('getPermissions')
          })
      }, 1)
    },
  },
}
</script>

<style scoped>

</style>
