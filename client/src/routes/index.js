import { PrivateRoute } from "./PrivateRoute";
import { Navigate } from "react-router-dom";
import Layout from "../components/Layout";
import { useSelector } from "react-redux";
import { PublicRoute } from "./PublicRoute";

const ProtectedRouteCheck = ({ route, children }) => {
    const user = useSelector((state) => state.auth.user);
    if (user) {
        return children;
    } else {
        return <Navigate to="/" />;
    }
};

// Prepare public route for render
const PublicRouteCheck = ({ children }) => {
    return children;
};

// Process all public/private route
export const getRoutes = () => {
    const filterRoute = [];
    PublicRoute.map((route) => {
        route.element = (
            <PublicRouteCheck>{route.element}</PublicRouteCheck>
        );
        filterRoute.push(route);
    });

    PrivateRoute.map((route) => {
        route.element = (
            <ProtectedRouteCheck route={route}>{route.element}</ProtectedRouteCheck>
        );
        filterRoute.push(route);
    });

    // Use as base layout
    return {
        path: "/",
        element: <Layout />,
        children: filterRoute,
    };
};
