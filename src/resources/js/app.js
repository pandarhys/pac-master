import './bootstrap';

import Vue from 'vue';
import VModal from 'vue-js-modal';
import axios from 'axios';
import Form from './core/Form.js';
import VTooltip from 'v-tooltip';
import PrettyCheckbox from 'pretty-checkbox-vue';
import vSelect from 'vue-select'
import './components/reuse/vue2Dropzone.css';
import VuePictureSwipe from 'vue-picture-swipe';
import VueViewer from 'v-viewer';

Vue.use(VModal);
Vue.use(VTooltip);
Vue.use(PrettyCheckbox);


window.vue = Vue;
window.axios = axios;
window.form = Form;

Vue.config.productionTip = true;
Vue.config.devtools = true;

Vue.component('article-form', require('./components/ArticleForm.vue').default);
Vue.component('v-select', vSelect);
Vue.component('CountrySelector', require('./components/reuse/CountrySelector.vue').default);
Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
Vue.component('new-article-modal', require('./components/NewArticleModal.vue').default);
Vue.component('new-article-modal2', require('./components/NewArticleModal2.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);
Vue.component('FileUpload', require('./components/reuse/FileUpload.vue').default);
Vue.component('PACDatePicker',require('./components/PACDatePicker.vue').default);
Vue.component('ArticleCard',require('./components/ArticleCard.vue').default);
Vue.component('vue-picture-swipe', VuePictureSwipe);
Vue.component('ArticlePictureSwipe',require('./components/ArticlePictureSwipe.vue').default);

new Vue({
    el: '#app',
});

