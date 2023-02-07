import actionsAuth from './actions'
import apiActionsAuth from './api-actions'
import mutationsAuth from './mutations'
import gettersAuth from './getters'

const state = {
  authUser: {
    isLoggedIn: false,
    isLoading: false,
    user: [],
    userPermissions: [],
    userRoles: [],
    userLocale: '',
    userTheme: '',
    userCurrency: '',
    userBan: '',
    userLogout: '',
  },
}

const actions = {
  ...actionsAuth,
  ...apiActionsAuth
}

const mutations = {
  ...mutationsAuth
}

const getters = {
  ...gettersAuth
}

export default {
  namespace: true,
  state,
  actions,
  mutations,
  getters
}
