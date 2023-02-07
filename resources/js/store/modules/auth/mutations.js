export default {
  SET_AUTH_USER_IS_LOGGED_IN(state, payload) {
    state.authUser.isLoggedIn = true
  },
  SET_AUTH_USER_LOGOUT(state, payload) {
    state.authUser.user = []
    state.authUser.userRoles = []
    state.authUser.userPermissions = []
    state.authUser.isLoggedIn = false
  },
  SET_AUTH_USER_ROLES(state, payload) {
    state.authUser.userRoles = payload
  },
  SET_AUTH_USER_PERMISSIONS(state, payload) {
    state.authUser.userPermissions = payload
  },
  SET_AUTH_IS_LOADING(state, payload) {
    state.authUser.isLoading = payload
  },
  SET_AUTH_USER(state, payload) {
    state.authUser.user = payload
  },
  SET_AUTH_USER_LOCALE(state, payload) {
    state.authUser.userLocale = payload
  },
  SET_AUTH_USER_THEME(state, payload) {
    state.authUser.userTheme = payload
  },
  SET_AUTH_USER_BAN(state, payload) {
    state.authUser.userBan = payload
  },
  SET_AUTH_USER_CURRENCY(state, payload) {
    state.authUser.userCurrency = payload
  },
  SET_AUTH_USER_LOGOUT_FLAG(state, payload) {
    state.authUser.userLogout = payload
  }
}
