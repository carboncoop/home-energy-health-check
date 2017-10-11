
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
window.Vue = require('vue')

import Vuex from 'vuex'
import VueRouter from 'vue-router'
import store from './store/submission.js'

Vue.use(Vuex)
Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ActionPlanSection from './components/section/ActionPlanSection.vue'
import DetailsSection from './components/section/DetailsSection.vue'
import ComfortSection from './components/section/ComfortSection.vue'
import HealthSection from './components/section/HealthSection.vue'
import SubmitSection from './components/section/SubmitSection.vue'


if (document.getElementById('submission-edit') != null) {

    Vue.component('submission-edit', require('./components/Submission.vue'));

    const routes = [
      { name: 'part', path: '/part/:partId', component: ActionPlanSection, props: true },
      { name: 'details', path: '/details', component: DetailsSection, props: true },
      { name: 'comfort', path: '/comfort', component: ComfortSection, props: true },
      { name: 'health', path: '/health', component: HealthSection, props: true },
      { name: 'submit', path: '/submit', component: SubmitSection, props: true }
    ]

    const router = new VueRouter({ routes })

    const app = new Vue({
        el: '#submission-edit',
        store,
        router
    });

}

if (document.getElementById('submission-create') != null) {

    Vue.component('submission-create', require('./components/SubmissionCreate.vue'));

    const app = new Vue({
        el: '#submission-create',
        store
    });
}
