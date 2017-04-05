/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

Vue.component('chatroom-messages', require('./components/ChatroomMessages.vue'));
Vue.component('chatroom-messages-js', require('./components/ChatroomMessages'));
Vue.component('new-message', require('./components/NewMessage.vue'));
Vue.component('new-message-js', require('./components/NewMessage'));

Vue.component('direct-messages', require('./components/DirectMessages.vue'));
Vue.component('direct-messages-js', require('./components/DirectMessages'));
Vue.component('mentions', require('./components/Mentions.vue'));
Vue.component('mentions-js', require('./components/Mentions'));

Vue.component('incoming-emails', require('./components/IncomingEmails.vue'));
Vue.component('incoming-emails-js', require('./components/IncomingEmails'));

const app = new Vue({
    el: '#app'
});