import NotFound from "./pages/Errors/NotFound";
import Dashboard from "./pages/Dashboard";
import Login from "./pages/Login";

export const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    },
]
