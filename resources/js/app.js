import PremiaComponent from './components/PremiaComponent.vue';
import NavBar from './components/NavBar.vue';
import defaultComponent from './components/defaultComponent.vue';


require('./bootstrap');

window.Vue = require('vue');


Vue.component('premia-component', PremiaComponent);
Vue.component('navbar', NavBar);
Vue.component('default-component', defaultComponent);


const app = new Vue({
    el: '#app',
});
