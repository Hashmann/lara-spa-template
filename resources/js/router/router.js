import {createWebHistory, createRouter} from "vue-router"
import Home from "../components/views/main/Home.vue";
import store from '../store'

//fix 1.5 вариант
// import role from './middleware/role'
// import middlewarePipeline from './middlewarePipeline';
//fix END 1.5 вариант


function getAuthUserRole() {
  return new Promise((resolve, reject) => {
    if (store.state.auth.authUser.user.role === undefined) {
      const unwatch = store.watch(
        () => store.state.auth.authUser.user.role,
        (value) => {
          unwatch()
          resolve(value)
        }
      )
    } else {
      resolve(store.state.auth.authUser.user.role)
    }
  })
}

//fix Первый вариант

// async function roleAccess(to, from, next) {
//   const roleAccess = to.meta.role
//   const userRoles = await getAuthUserRole()
//
//   const token = localStorage.getItem('x-token')
//   const requiredAuth = to.matched.some(record => record.meta.auth)

// console.log('%c ROLE ACCESS', 'background: #222; color: #bada55', roleAccess)
// console.log('%c USER ROLES', 'background: #222; color: #bada55',  userRoles)

//fix 1.5 вариант
// const middleware = to.meta.middleware;
// const context = { to, from, next, store }
// middleware[0]({
//   ...context,
//   next: middlewarePipeline(context, middleware, 1),
// });
//fix END 1.5 вариант

//   if(roleAccess.includes(',')){
//     roleAccess.split(',').forEach(function (item) {
//       if(userRoles.includes(item.trim())){
//         // console.log('ACCESS: if')
//         return next()
//       }
//     })} else {
//     if (userRoles.includes(roleAccess.trim())) {
//       // console.log('ACCESS: First else')
//       return next()
//     } else {
//       // console.log('NO ACCESS: Two else')
//       return next({name: 'error'})
//     }
//   }
//   return next({name: 'error'})
// }
//fix END Первый вариант


//INFO Lazzy loading компонентов
const Login = () =>
  import('../components/auth/Login.vue')
const Registration = () =>
  import('../components/auth/Registration.vue')
const NotFound = () =>
  import('../components/views/404.vue')

const Dashboard = () =>
  import('../components/views/main/Dashboard.vue')
const HomeAbout = () =>
  import('../components/views/main/About.vue')

const AdminDashboard = () =>
  import('../components/views/admin/Dashboard.vue')
const AdminUsers = () =>
  import('../components/views/admin/Users.vue')
const AdminShowUser = () =>
  import('../components/views/admin/ShowUser.vue')
const AdminPermissions = () =>
  import('../components/views/admin/RoleAndPermissions.vue')


const routes = [
  {
    path: "/login",
    name: "login",
    meta: {layout: 'empty'},
    component: Login,
  },
  {
    path: "/registration",
    name: "registration",
    meta: {layout: 'empty'},
    component: Registration,
  },
  //INFO Home
  {
    path: "/",
    name: "home",
    meta: {layout: 'main'},
    component: Home,
  },
  {
    path: "/about",
    name: "home.about",
    meta: {layout: 'main'},
    component: HomeAbout,
  },
  {
    path: "/dashboard",
    name: "dashboard",
    meta: {layout: 'dashboard', auth: true},
    component: Dashboard,
  },

  //INFO Admin
  {
    path: "/admin",
    name: "admin.dashboard",
    meta: {layout: 'admin', auth: true, role: 'super-admin, admin, employee, support'}, // middleware: [role] //fix 1.5 вариант
    component: AdminDashboard,
    // beforeEnter: roleAccess,   //fix Первый вариант
  },
  {
    path: "/admin/users",
    name: "admin.users",
    meta: {layout: 'admin', auth: true},
    component: AdminUsers,
  },
  {
    path: "/admin/users/:userId",
    name: "admin.user.show",
    meta: {layout: 'admin', auth: true},
    props: true,
    component: AdminShowUser,
  },
  {
    path: "/admin/permissions",
    name: "admin.permissions",
    meta: {layout: 'admin', auth: true},
    component: AdminPermissions,
  },


  {
    path: "/:catchAll(.*)",
    name: "notFound",
    meta: {layout: 'empty'},
    component: NotFound,
  },
  {
    path: "/error",
    name: "error",
    meta: {layout: 'empty'},
    component: NotFound,
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

//INFO Второй вариант
router.beforeEach(beforeEach)

async function beforeEach(to, from, next) {
  const token = localStorage.getItem('x-token')
  const requiredAuth = to.matched.some(record => record.meta.auth)

  const roleAccess = to.meta.role
  let userRoles

  if (store.state.auth.authUser.isLoggedIn === true) {
    userRoles = await getAuthUserRole()
  } else {
    userRoles = null
  }

  // console.log('%c ROLE ACCESS', 'background: #222; color: #bada55', roleAccess)
  // console.log('%c USER ROLES', 'background: #222; color: #bada55', userRoles)

  if (requiredAuth && !token) {
    return next({name: 'login'})
  } else if (to.meta.role) {
    if (roleAccess.includes(',')) {
      roleAccess.split(',').forEach(function (item) {
        if (userRoles.includes(item.trim())) {
          // console.log('ACCESS: if')
          return next()
        }
      })
    } else {
      if (userRoles.includes(roleAccess.trim())) {
        // console.log('ACCESS: First else')
        return next()
      } else {
        // console.log('NO ACCESS: Two else')
        return next({name: 'error'})
      }
    }
    return next({name: 'error'})
  } else {
    next()
  }
}
//INFO END Второй вариант


//fix Первый вариант
// router.beforeEach((to, from, next) => {
//   const token = localStorage.getItem('x-token')
//   const requiredAuth = to.matched.some(record => record.meta.auth)
//
//   const roleAccess = to.meta.role
//   async function getAuth () {
//     return await getAuthUserRole()
//   }
//   const userRoles = getAuth()
//   // const userRoles = await getAuthUserRole()
//   console.log('%c ROLE ACCESS', 'background: #222; color: #bada55', roleAccess)
//   console.log('%c USER ROLES', 'background: #222; color: #bada55',  userRoles)
//
//   if (requiredAuth && !token) {
//     return next({name: 'login'})
//   } else {
//     next()
//   }
// })
//fix END Первый вариант

export default router
