export default {
  setUserList(state, payload) {
    state.userList = payload
  },
  setCurrentUser(state, payload) {
    state.currentUser = payload
  },
  setCurrentRoles(state, payload) {
    state.currentRoles = payload
  },
  setRoleList(state, payload) {
    state.roleList = payload
  },
  setPermissionsList(state, payload) {
    state.permissionsList = payload
  },
  setAllPermissions(state, payload) {
    state.allPermissions = payload
  },
  changeLoadingState(state, loading) {
    state.loading = loading
  }
}
