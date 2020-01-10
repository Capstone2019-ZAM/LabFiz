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
Vue.component('template-list', require('./components/TemplateList.vue').default);
Vue.component('template-builder', require('./components/TemplateForm.vue').default);
Vue.component('inspection-form', require('./components/InspectionForm.vue').default);
Vue.component('inspection-table', require('./components/InspectionTable.vue').default);
Vue.component('assignments-manager', require('./components/InspectionManage.vue').default);

Vue.component('issue-form', require('./components/IssueTrackerForm.vue').default);
Vue.component('accountmanage-form', require('./components/AccountManagment.vue').default);
const app = new Vue({
    vuetify,

    el: '#app',
});

//    render: h =>h(loginform),
