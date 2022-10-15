import React from "react";
import { Row, Col, Spinner } from "react-bootstrap";
import { useForm } from "react-hook-form";
import { yupResolver } from '@hookform/resolvers/yup';
import * as yup from "yup";
import { capitalize } from "../../utils/helpers";

import "./public.css";
import HomeBGImage from '../../assets/images/home.jpg';


// Validation schema
const schema = yup.object({
    email: yup.string().email().required(),
    password: yup.string().required(),
}).required();

const Home = () => {

    // Handle form validation
    const { register, handleSubmit, formState: { errors }, reset } = useForm({
        resolver: yupResolver(schema)
    });

    const onSubmit = (data, e) => {

        console.log(data)
    }

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
                            <button type="submit" className="main-btn" ><Spinner animation="border" size="sm" /> Login</button>
                        </form>
                    </div>
                </Col>
            </Row>
        </div>
    );
};

export default Home;
