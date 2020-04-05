import './bootstrap';

import Vue from 'vue';
import VModal from 'vue-js-modal';
import axios from 'axios';
import Form from './core/Form.js'

window.vue = Vue;
window.axios = axios;
window.form = Form;


Vue.use(VModal);
Vue.config.productionTip = false


Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
Vue.component('new-article-modal', require('./components/NewArticleModal.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);
Vue.component('FileUpload', require('./components/FileUpload.vue').default);
Vue.component('ArticleForm', require('./components/ArticleForm.vue').default);s

import './components/vue2Dropzone.css'

new Vue({
    el: '#app'
});


