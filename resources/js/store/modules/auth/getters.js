export default {
  GET_AUTH_USER(state) {
    return state.authUser
  },
  GET_AUTH_IS_LOADING(state) {
    return state.authUser.isLoading
  },
}
