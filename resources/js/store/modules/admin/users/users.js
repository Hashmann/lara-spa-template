import actionsUsers from './actions'
import apiActionsUsers from './api-actions'
import mutationsUsers from './mutations'
import gettersUsers from './getters'

const state = {
  userList: [],
  currentUser: [],
  currentRoles:[],
  roleList: [],
  permissionsList: [],
  allPermissions: [],
  loading: true,
}

const actions = {
  ...actionsUsers,
  ...apiActionsUsers
}

const mutations = {
  ...mutationsUsers
}

const getters = {
  ...gettersUsers
}

export default {
  namespace: true,
  state,
  actions,
  mutations,
  getters
}
