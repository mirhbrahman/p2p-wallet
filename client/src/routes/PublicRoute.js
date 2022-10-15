import Home from "../pages/public/Home";
import Dashboard from "../pages/user/Dashboard";

export const PublicRoute = [
    {
        path: "/",
        element: <Home />,
    },
    {
        path: "/dashboard",
        element: <Dashboard />,
    }
];
