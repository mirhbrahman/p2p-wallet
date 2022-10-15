// import { PrivateRoute } from "./PrivateRoute";
// import { Navigate } from "react-router-dom";
import Layout from "../components/Layout";
import { useSelector } from "react-redux";
import { PublicRoute } from "./PublicRoute";
import { Route } from "react-router-dom";

const ProtectedRoute = ({ route, children }) => {

    const user = useSelector((state) => state.auth.user);

    if (user) {
        if (user?.role === route.role) {
            return children;
        } else {
            // return <Navigate to="/not-access" />;
        }
    } else {
        // return <Navigate to="/login" />;
    }
};

// Prepare public route for render
const PublicRouteCheck = ({ children }) => {
    return children

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

    // Use as base layout
    return {
        path: "/",
        element: <Layout />,
        children: filterRoute,
    };
};
