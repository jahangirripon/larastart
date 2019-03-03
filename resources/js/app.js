require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';

import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);

import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast;

window.Form = Form;
import VueRouter from 'vue-router';

import VueProgressBar from 'vue-progressbar';
const options = {
  color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}
Vue.use(VueProgressBar, options)

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/orders', component: require('./components/Orders.vue').default },
    { path: '/agents', component: require('./components/Agents.vue').default },
    { path: '/status', component: require('./components/Status.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/*', component: require('./components/NotFound.vue').default }, //not found
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })

  Vue.filter('upText', function(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
  });

  Vue.filter('myDate', function(created){
    return moment(created).format('LL');
  });

  let Fire = new Vue();

  window.Fire = Fire;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
  'not-found',
  require('./components/NotFound.vue').default
);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data: {
      search: ''
    },
    methods: {
      searchit: _.debounce(() => {
        Fire.$emit('searching');
      }, 1000)
    }
});
