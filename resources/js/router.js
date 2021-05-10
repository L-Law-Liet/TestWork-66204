import router from 'vue-router';
import vue from 'vue';
vue.use(router);

import Index from './components/Index';
import Edit from './components/Edit';
import View from './components/View';

const routes = [
    {
        path: '',
        component: Index
    },
    {
        path: '/add',
        component: Edit
    },
    {
        path: '/edit/:id',
        component: Edit
    },
    {
        path: '/show/:id',
        component: View
    }
]

export default new router({
    mode: 'history',
    routes
});
