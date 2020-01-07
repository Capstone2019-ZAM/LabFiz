require('./bootstrap');
window.Vue = require('vue');

import vuetify from './vuetify';
import loginform from './components/Login.vue';

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('app', require('./components/App.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login-form', require('./components/Login.vue').default);
Vue.component('table-component', require('./components/TableComponent.vue').default);
Vue.component('dash-button', require('./components/DashButton.vue').default);
Vue.component('dash-board', require('./components/DashBoard.vue').default);

const app = new Vue({
    vuetify,

    el: '#app',
});

//    render: h =>h(loginform),