require('./bootstrap');
window.Vue = require('vue');

import vuetify from './vuetify';
import dashboard from './components/Dashboard.vue';

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('dash-board', require('./components/Dashboard.vue').default);

const app = new Vue({
    vuetify,
    render: h =>h(dashboard),
    el: '#app',
});
