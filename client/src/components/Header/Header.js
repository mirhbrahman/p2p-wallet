import React from "react";
import { useSelector, useDispatch } from "react-redux";
import "./header.css";
import { Container, Nav, Navbar } from "react-bootstrap";
import { NavLink } from "react-router-dom";
import { userLoggedOut } from "../../features/auth/authSlice";

const Header = () => {

    const user = useSelector((state) => state.auth.user);
    const dispatch = useDispatch();

    const handleLogout = () => {
        dispatch(userLoggedOut());
        localStorage.clear();
    };

    return (
        <Navbar className="navbar-warper" collapseOnSelect expand="lg">
            <Container>
                <Navbar.Brand>
                    <NavLink to="/">P2P WALLET</NavLink>
                </Navbar.Brand>
                <Navbar.Toggle aria-controls="responsive-navbar-nav" />
                <Navbar.Collapse id="responsive-navbar-nav">
                    {user && (
                        <>
                            <Nav className="ml-auto m-navbar">
                                <Nav.Link as={NavLink} to="/dashboard">
                                    Dashboard
                                </Nav.Link>
                            </Nav>
                            <Nav className="ml-auto m-navbar">
                                <a href="/" className="nav-link" onClick={handleLogout}>
                                    Log Out
                                </a>
                            </Nav>
                        </>
                    )}
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
};

export default Header;