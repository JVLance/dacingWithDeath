// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './App'
import router from './router'

import store from './store';

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VueResource from 'vue-resource'

import BlockUI from 'vue-blockui'

import VeeValidate from 'vee-validate';

import 'vue-awesome/icons/flag'

import 'vue-awesome/icons'

import Icon from 'vue-awesome/components/Icon'

import VModal from 'vue-js-modal'




Vue.component('icon', Icon)


Vue.config.productionTip = false

Vue.use(BootstrapVue)

Vue.use(VueResource)
Vue.http.options.root = 'http://35.231.212.169/dancingunblockhour/api/public/index.php/api'

Vue.use(BlockUI)

Vue.use(VeeValidate)

Vue.use(VModal, { dialog: true })

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>'
})