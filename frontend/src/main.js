import { createApp } from 'vue'
import App from './App.vue'

import { createRouter, createWebHistory } from 'vue-router';
import ArticleList from './components/ArticleList.vue';
import AddArticle from './components/AddArticle.vue';




const routes = [
  { path: '/articles', component: ArticleList },
  { path: '/add-article', component: AddArticle }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

const app = createApp(App);

app.use(router);
app.mount('#app');
