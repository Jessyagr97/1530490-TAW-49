
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('dashboard-component', require('./components/Dashboard.vue').default);
Vue.component('rol', require('./components/Rol.vue').default);
Vue.component('categoria', require('./components/Categoria.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('perfil', require('./components/Perfil.vue').default);
Vue.component('etiquetas', require('./components/Etiquetas.vue').default);
Vue.component('galeria', require('./components/Galeria.vue').default);

const app = new Vue({
    el: '#app',
    data:{
        menu : 0
    }
});
