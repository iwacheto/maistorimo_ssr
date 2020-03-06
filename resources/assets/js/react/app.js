import Vue from 'vue';
import store from './store';
import router from './router';
import ImageUploader from 'vue-image-upload-resize'
import Vuetify from 'vuetify'
import VeeValidate from 'vee-validate';
import VueSweetalert2 from 'vue-sweetalert2';
import VueToastr from 'vue-toastr';
import * as VueGoogleMaps from "vue2-google-maps";
import CKEditor from '@ckeditor/ckeditor5-vue';
import Vendor from './components/Vendor';
import axios from 'axios';

Vue.use(VueGoogleMaps, {
	load: {
		key: "AIzaSyCX1iw9Pr-kaeGN7IMHB4LrxzaHSRHJtSM",
		libraries: "places" // necessary for places input
	}
});
Vue.component('vue-toastr', VueToastr);
Vue.use(CKEditor);

import 'froala-editor/css/froala_editor.pkgd.min.css';

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg';
Vue.use(VueFroala);

// Global register
Vue.use(VueSweetalert2);
// Vue.use(VueRouter)
Vue.use(Vuetify)
Vue.use(ImageUploader);
Vue.use(VeeValidate);

// window.axios = require('axios');

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// let token = document.head.querySelector('meta[name="csrf-token"]');
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }

export default new Vue({
    store,

    router,

    render: h => h(Vendor),
});





