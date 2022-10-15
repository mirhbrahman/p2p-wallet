import Home from "../pages/public/Home";
import NotFound from "../pages/utils/NotFound";

export const PublicRoute = [
    {
        path: "/",
        element: <Home />,
    },
    {
        path: "*",
        element: <NotFound />,
    }
];
