import axios from "../../../../../axios/axios-instance";

export default {
  getUsers(ctx) {
    axios.get('/api/v1/admin/users')
      .then(response => {
        ctx.commit('setUserList', response.data.data)
        // console.log(response.data, 'user id');
        ctx.commit('changeLoadingState', false)
      }).catch(error => {
      console.log(error)
    })
  },
  getCurrentUser(ctx) {
    ctx.commit('SET_AUTH_IS_LOADING', true)
    axios.get('/api/v1/current/user')
      .then(response => {
        ctx.commit('setCurrentUser', response.data.data)
        ctx.commit('SET_AUTH_USER', response.data.data)
        ctx.commit('SET_AUTH_USER_LOCALE', response.data.data.locale)
        ctx.commit('SET_AUTH_USER_ROLES', response.data.data.role)
        ctx.commit('SET_AUTH_USER_PERMISSIONS', response.data.data.permissions)
        ctx.commit('SET_AUTH_USER_THEME', response.data.data.theme)
        ctx.commit('SET_AUTH_USER_BAN', response.data.data.ban)
        ctx.commit('SET_AUTH_USER_CURRENCY', response.data.data.currency)
        ctx.commit('SET_AUTH_USER_LOGOUT_FLAG', response.data.data.logout)
        // console.log(response.data, 'current user');
      }).catch(error => {
      console.log(error)
    }).finally(() =>{
      ctx.commit('SET_AUTH_IS_LOADING', false)
    })
  },
  getCurrentRoles(ctx) {
    axios.get('/api/v1/current/role')
      .then(response => {
        ctx.commit('setCurrentRoles', response.data)
        // console.log(response.data, 'current role');
      }).catch(error => {
      console.log(error)
    })
  },
  UPDATE_AUTH_USER_LOCALE({commit}, locale) {
    axios.put(`/api/v1/current/user/update`, {
      locale: locale,
    })
      .then(response => {
        commit('setCurrentUser', response.data)
        // console.log(response.data, 'AUTH_USER_LOCALE_UPDATE');
      }).catch(error => {
      console.log(error)
    })
  },
  UPDATE_AUTH_USER_THEME({commit}, theme) {
    axios.put(`/api/v1/current/user/update`, {
      theme: theme,
    })
      .then(response => {
        commit('setCurrentUser', response.data)
        // console.log(response.data, 'AUTH_USER_THEME_UPDATE');
      }).catch(error => {
      console.log(error)
    })
  },
  addUser({}, user) {
    axios.post('/api/v1/admin/users', {
      name: user.name,
      email: user.email,
      role: user.role.name,
      password: user.password,
      password_confirmation: user.password_confirmation,
      theme: user.theme,
      locale: user.locale,
    }).then(response => {
      if (response.data) {
        // window.location.replace('/user/dashboard')
        console.log(response)
      }
    }).catch((error) => {
      console.log(error.response)
    })
  },
  getRoles(ctx) {
    axios.get('/api/v1/admin/roles')
      .then(response => {
        ctx.commit('setRoleList', response.data)
        // console.log(response.data);
      }).catch(error => {
      console.log(error)
    })
  },
  addRole({}, role) {
    axios.post('/api/roles', {
      name: role.name,
    }).then(response => {
      if (response.data) {
        window.location.replace('/user/management')
        console.log(response)
      }
    }).catch((error) => {
      console.log(error.response)
    })
  },
  getPermissions(ctx) {
    axios.get('/api/v1/admin/permissions')
      .then(response => {
        ctx.commit('setPermissionsList', response.data.data)
        // console.log(response.data.data);
      }).catch(error => {
      console.log(error)
    })
  },
  getAllPermissions(ctx) {
    axios.get('/api/v1/admin/permissions/all')
      .then(response => {
        ctx.commit('setAllPermissions', response.data)
        // console.log(response.data);
      }).catch(error => {
      console.log(error)
    })
  },
  addPermission({}, permission) {
    axios.post('/api/permissions', {
      name: permission.name,
    }).then(response => {
      if (response.data) {
        window.location.replace('/user/permissions')
        console.log(response)
      }
    }).catch((error) => {
      console.log(error.response)
    })
  },
}
