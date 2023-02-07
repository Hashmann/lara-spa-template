import store from "../store"
export default {
  install: (app, options) => {
    app.config.globalProperties.can = function(value){
      // if(window.Laravel.permissions == 0){
      if(store.getters.GET_AUTH_USER.userPermissions == 0){
        return false
      }
      // let permissions = window.Laravel.permissions
      let permissions = store.getters.GET_AUTH_USER.userPermissions
      let _return = false
      if(!Array.isArray(permissions)){
        return false
      }
      if(value.includes('|')){
        value.split('|').forEach(function (item) {
          if(permissions.includes(item.trim())){
            _return = true
          }
        })
      }else if(value.includes('&')){
        _return = true
        value.split('&').forEach(function (item) {
          if(!permissions.includes(item.trim())){
            _return = false
          }
        })
      }else{
        _return = permissions.includes(value.trim())
      }
      return _return
    }
    app.config.globalProperties.is = function(value){
      // if(window.Laravel.currentUserRole == 0){
      if(store.getters.GET_AUTH_USER.userRoles == 0){
        return false
      }
      // let roles = window.Laravel.currentUserRole
      let roles = store.getters.GET_AUTH_USER.userRoles
      let _return = false
      if(!Array.isArray(roles)){
        return false
      }
      if(value.includes('|')){
        value.split('|').forEach(function (item) {
          if(roles.includes(item.trim())){
            _return = true
          }
        })
      }else if(value.includes('&')){
        _return = true
        value.split('&').forEach(function (item) {
          if(!roles.includes(item.trim())){
            _return = false
          }
        })
      }else{
        _return = roles.includes(value.trim())
      }
      return _return
    }
  }
}
