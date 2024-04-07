import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '@/Pages/HomeView.vue'; // Make sure this path is correct
import AboutView from '@/Pages/AboutView.vue'; // Make sure this path is correct
import AddMovieView from '@/Pages/AddMovieView.vue';
import MoviesView from '@/Pages/MoviesView.vue';
import LoginView from '@/Pages/LoginView.vue';

// Import other pages as needed

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView,
  },
  {
    path: '/about',
    name: 'About',
    component: AboutView,
  },

  {
    path: '/movies',
    name: 'Movies',
    component: MoviesView,
  },

  {
    path: '/movies/create',
    name: 'AddMovie',
    component: AddMovieView,
  },

  {
    path: '/login',
    name: 'Login',
    component: LoginView
  },

  // ...other routes
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
