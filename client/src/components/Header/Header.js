import React from "react";
import "./header.css";
import { Container, Nav, Navbar } from "react-bootstrap";
import { NavLink } from "react-router-dom";

const Header = () => {
    return (
        <Navbar className="navbar-warper" collapseOnSelect expand="lg">
            <Container>
                <Navbar.Brand>
                    <NavLink to="/">P2P WALLET</NavLink>
                </Navbar.Brand>
                <Navbar.Toggle aria-controls="responsive-navbar-nav" />
                <Navbar.Collapse id="responsive-navbar-nav">
                    <Nav className="ml-auto m-navbar">
                        <Nav.Link as={NavLink} to="/">
                            Home
                        </Nav.Link>
                    </Nav>
                    <Nav className="ml-auto m-navbar">
                        <Nav.Link as={NavLink} to="/dashboard">
                            Dashboard
                        </Nav.Link>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
};

export default Header;