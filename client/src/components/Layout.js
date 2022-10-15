import React from "react";
import { Outlet } from "react-router-dom";
import Header from "./Header/Header";
import { ToastContainer } from "react-toastify";
import { Container } from "react-bootstrap";

const Layout = () => {
    return (
        <>
            <nav className="p-2 bg-slate-800 fixed w-full">
                <ToastContainer />
                <Header />
            </nav>
            <Container>
                <Outlet />
            </Container>
        </>
    );
};

export default Layout;
