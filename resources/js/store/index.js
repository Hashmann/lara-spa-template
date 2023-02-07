import Vuex from 'vuex'
import auth from './modules/auth/auth.js'
import users from "./modules/admin/users/users.js";


export default new Vuex.Store({
  // strict: false,
  modules: {
    auth,
    users
  },
})
