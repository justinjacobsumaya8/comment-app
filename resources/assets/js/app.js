
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import store from './store/index'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('post', require('./components/Post'));

Vue.component('comment', require('./components/Comment'));
Vue.component('comment-reply', require('./components/CommentReply'));
Vue.component('comment-reply-third', require('./components/CommentReplyThird'));

Vue.component('comments', require('./components/Comments'))
Vue.component('new-comment', require('./components/NewComment'))

const app = new Vue({
  	el: '#app',
  	store
});
