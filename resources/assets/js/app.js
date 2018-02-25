/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import PostIndex from './components/Posts.vue';
import CreatePost from './components/PostForm.vue';
import ShowPost from './components/ShowPost.vue';
import ListPost from './components/ListPost.vue';
import EditPost from './components/EditPost.vue';

Vue.component('paginate', require('vuejs-paginate'));

const routes = [
  {
    path: '/',
    components: {
      postsIndex: PostIndex
    }
  },
  { path: '/post/create', component: CreatePost, name: 'createPost' },
  { path: '/post/show/:id', component: ShowPost, name: 'showPost' },
  { path: '/post/list', component: ListPost, name: 'listPost' },
  { path: '/post/edit/:id', component: EditPost, name: 'editPost' }
];

const router = new VueRouter({ routes });

const app = new Vue({ router }).$mount('#app');
