import './bootstrap';

import Vue from 'vue';
import VModal from 'vue-js-modal';
import axios from 'axios';
import Form from './core/Form.js';
import VTooltip from 'v-tooltip';
Vue.use(VModal);
Vue.use(VTooltip);

window.vue = Vue;
window.axios = axios;
window.form = Form;



Vue.config.productionTip = false;
Vue.config.devtools = true;

Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
Vue.component('new-article-modal', require('./components/NewArticleModal.vue').default);
Vue.component('new-article-modal2', require('./components/NewArticleModal2.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);
Vue.component('FileUpload', require('./components/FileUpload.vue').default);
Vue.component('PACDatePicker',require('./components/PACDatePicker.vue').default);
Vue.component('ArticleForm', require('./components/ArticleForm.vue').default);

import './components/vue2Dropzone.css';

new Vue({
    el: '#app'
});




