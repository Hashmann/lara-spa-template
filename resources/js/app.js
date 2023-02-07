/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// import './bootstrap';
import {createApp} from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import App from './App.vue'
import router from "./router/router";
import store from "./store";

import RoleAndPermissionsVue from './prototype/index'


//INFO COMPONENTS
import components from './components'

components.forEach(component => {
  app.component(component.name, component)
})
//INFO END COMPONENTS


//INFO LAYOUTS
import HomeMainLayout from './components/layouts/main/MainLayout.vue'
import AdminMainLayout from './components/layouts/admin/MainLayout.vue'
import EmptyLayout from './components/layouts/EmptyLayout.vue'
import DashboardLayout from './components/layouts/main/DashboardLayout.vue'

app.component('main-app', App);
app.component('main-layout', HomeMainLayout);
app.component('admin-layout', AdminMainLayout);
app.component('empty-layout', EmptyLayout);
app.component('dashboard-layout', DashboardLayout);
//INFO END LAYOUTS


//INFO QUASAR
import {Quasar} from 'quasar'
import {Dark} from 'quasar'
import {Notify} from 'quasar'
import ru from 'quasar/lang/ru'
import en from 'quasar/lang/en-US'
import quasarIconSet from 'quasar/icon-set/svg-material-icons'
// Import icon libraries
import '@quasar/extras/roboto-font/roboto-font.css'
import '@quasar/extras/material-icons/material-icons.css'
// import '@quasar/extras/material-icons-outlined/material-icons-outlined.css'
// import '@quasar/extras/material-icons-round/material-icons-round.css'
// import '@quasar/extras/material-icons-sharp/material-icons-sharp.css'
// import '@quasar/extras/material-symbols-outlined/material-symbols-outlined.css'
// import '@quasar/extras/material-symbols-rounded/material-symbols-rounded.css'
// import '@quasar/extras/material-symbols-sharp/material-symbols-sharp.css'
// import '@quasar/extras/mdi-v6/mdi-v6.css'
// import '@quasar/extras/fontawesome-v5/fontawesome-v5.css'
// import '@quasar/extras/fontawesome-v6/fontawesome-v6.css'

// A few examples for animations from Animate.css:
// import @quasar/extras/animate/fadeIn.css
// import @quasar/extras/animate/fadeOut.css

// Import Quasar css
import 'quasar/src/css/index.sass'

//INFO I18n
import {createI18n} from 'vue-i18n'
import messages from './i18n'

const i18n = createI18n({
  // locale: 'ru-RU',
  // fallbackLocale: 'en-US',
  locale: Quasar.lang.getLocale(),
  globalInjection: true,
  messages
})
app.use(i18n)
//INFO END I18n

app.use(Quasar, {
  plugins: {Dark, Notify}, // import Quasar plugins and add here
  lang: ru,
  iconSet: quasarIconSet,
  config: {
    dark: 'auto',
    brand: {
      // primary: '#e46262',
      // ... or all other brand colors
    },
    notify: {}, // default set of options for Notify Quasar plugin
    loading: {}, // default set of options for Loading Quasar plugin
    // loadingBar: {}, // settings for LoadingBar Quasar plugin
    // and many more (check Installation card on each Quasar component/directive/plugin)
  },

})

//INFO END QUASAR


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

// app.directive('can', function (el, binding) {
//   return console.log(window.Laravel.permissions.indexOf(binding) !== -1) ;
// })
//
// app.config.globalProperties.can = function(value){
//   return window.Laravel.permissions.includes(value);
// }

app
  // .use(moment)
  .use(RoleAndPermissionsVue)
  .use(store)
  .use(router)
  .mount('#app');
