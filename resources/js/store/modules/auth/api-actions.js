import axios from "../../../../axios/axios-instance";
import router from "../../../router/router";

export default {
  loginUser({commit}, user) {
    return new Promise((resolve) => {
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', {
          email: user.email,
          password: user.password
        })
          .then(response => {
            localStorage.setItem('x-token', response.config.headers['X-XSRF-TOKEN'])
            commit('SET_AUTH_USER_IS_LOGGED_IN')
            this.dispatch('getCurrentUser')
            router.push({name: 'home'})
            // console.log(response)
          }).catch((error) => {
          console.log(error.response)
        })
      });
    });
  },

  registerUser({commit}, user) {
    return new Promise((resolve) => {
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/register', {
          name: user.name,
          email: user.email,
          password: user.password,
          password_confirmation: user.password_confirmation
        })
          .then(response => {
            if (response.data) {
              localStorage.setItem('x-token', response.config.headers['X-XSRF-TOKEN'])
              // commit('setAuthToken', response.config.headers['X-XSRF-TOKEN'])
              // window.location.replace("/")
              router.push({name: 'home'})
              console.log(response)
            }
          }).catch((error) => {
          console.log(error.response)
        })

      });
    });
  },
  logout({commit}) {
    axios.post('/logout')
      .then(response => {
        localStorage.removeItem('x-token')
        commit('SET_AUTH_USER_LOGOUT')
        window.location.replace("/")
        // router.push({name: 'home'})
      })
  }
}
