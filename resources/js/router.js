import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home';
import PuzzleIndex from './views/puzzles/PuzzleIndex';
import PuzzleCreate from './views/puzzles/PuzzleCreate';
import PuzzleView from './views/puzzles/PuzzleView';

Vue.use(Router);

export const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/puzzle',
      name: 'puzzle.index',
      component: PuzzleIndex
    },
    {
      path: '/puzzle/create',
      name: 'puzzle.create',
      component: PuzzleCreate
    },
    {
      path: '/puzzle/:id',
      name: 'puzzle.view',
      component: PuzzleView
    }
  ]
});
