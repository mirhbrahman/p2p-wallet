import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { Row, Col, Spinner, Alert } from "react-bootstrap";
import { useForm } from "react-hook-form";
import { yupResolver } from '@hookform/resolvers/yup';
import * as yup from "yup";
import { capitalize } from "../../utils/helpers";
import { useSelector } from "react-redux";

import "./public.css";
import HomeBGImage from '../../assets/images/home.jpg';
import { useLoginMutation } from "../../features/auth/authApi";


// Validation schema
const schema = yup.object({
    email: yup.string().email().required(),
    password: yup.string().required(),
}).required();

const Home = () => {
    // Local state
    const authUser = useSelector((state) => state.auth.user);
    const [login, { data, isLoading, isSuccess, isError, error: responseError }] =
        useLoginMutation();
    const [errorMessage, setErrorMessage] = useState("");
    const navigate = useNavigate();

    // Handle form validation
    const { register, handleSubmit, formState: { errors }, reset } = useForm({
        resolver: yupResolver(schema)
    });

    // Handle form submit
    const onSubmit = (data, e) => {
        login({
            email: data.email,
            password: data.password,
        });
    }


    useEffect(() => {
        setErrorMessage(responseError?.data.message);

        if (authUser) {
            navigate("/dashboard");
        }

        if (data?.data && data?.data?.token) {
            navigate("/dashboard");
        }
    }, [responseError, data, navigate, authUser]);

    return (
        <div className="package-details-warper p-80">
            <Row>
                <Col lg={8}>
                    <div className="package-details">
                        <div className="details-image">
                            <img
                                src={HomeBGImage}
                                className="img-fluid"
                                alt="E-wallet"
                            />
                        </div>
                    </div>
                </Col>
                <Col lg={4}>
                    <div className="package-details-form">
                        <h2>Login</h2>
                        <form onSubmit={handleSubmit(onSubmit)}>
                            <input
                                {...register("email")}
                                type="email"
                                className="form-control mb-0"
                                placeholder="Email"
                            />
                            <p className="error-txt">{capitalize(errors.email?.message)}</p>
                            <input
                                {...register("password")}
                                type="password"
                                className="form-control mb-0"
                                placeholder="Password"
                            />
                            <p className="error-txt">{capitalize(errors.password?.message)}</p>
                            {isError && (
                                <Alert key="error" variant="danger">
                                    {errorMessage}
                                </Alert>
                            )}
                            <button type="submit" className="main-btn" >{isLoading && (<Spinner animation="border" size="sm" />)} Login</button>
                        </form>
                        <br />
                        <p className="login-info"><b>Login Info</b></p>
                        <p className="login-info">User: usera@app.com / userb@app.com</p>
                        <p className="login-info">Password: 12345678</p>
                    </div>
                </Col>
            </Row>
        </div>
    );
};

export default Home;
