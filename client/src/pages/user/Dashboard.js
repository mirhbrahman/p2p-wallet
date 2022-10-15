import React, { useState, useEffect } from "react";
import { Row, Col, Card, Spinner, Alert } from "react-bootstrap";
import { useListUserQuery, useStatsQuery, useTransferMutation } from "../../features/user/userApi";
import { toastMessage } from "../../utils/helpers";
import { useForm } from "react-hook-form";
import { yupResolver } from '@hookform/resolvers/yup';
import * as yup from "yup";
import { capitalize } from "../../utils/helpers";
import { useSelector } from "react-redux";

// Validation schema
const schema = yup.object({
    account_no: yup.string().email().required('Account no is a required field'),
    amount: yup.string().required(),
}).required();

const Dashboard = () => {
    const [errorMessage, setErrorMessage] = useState("");
    const [transfer, { isLoading, isSuccess, isError, error: responseError }] = useTransferMutation();
    const authUser = useSelector(state => state.auth.user);

    const { data: userList, isSuccess: userSuccess } = useListUserQuery({ refetchOnMountOrArgChange: true });
    const { data: statsData, isSuccess: statsSuccess, refetch } = useStatsQuery({ refetchOnMountOrArgChange: true });
    const statsInfo = statsData?.data;
    // Handle form validation
    const { register, handleSubmit, formState: { errors }, reset } = useForm({
        resolver: yupResolver(schema)
    });


    // Handle submit
    const onSubmit = (data, e) => {
        transfer({
            account_no: data.account_no,
            amount: data.amount
        })
    }

    useEffect(() => {
        setErrorMessage(responseError?.data.message);

        if (isSuccess) {
            reset();
            toastMessage('Money send successfully.');
            refetch();
        }

    }, [responseError, isSuccess]);


    return (
        <>
            <h3>Dashboard | Welcome {authUser?.name}</h3>

            <Row>
                <Col lg={6}>
                    <div className="package-details-form">
                        <Card className="mb-3">
                            <Card.Body>
                                <Card.Title>Most Conversion User</Card.Title>
                                <Card.Text>
                                    Name: {statsInfo?.most_conversion_user?.name} |
                                    Account: {statsInfo?.most_conversion_user?.email} |
                                    Total Conversions: {statsInfo?.most_conversion_user?.total_conversion}
                                </Card.Text>
                            </Card.Body>
                        </Card>
                        <Card className="mb-3">
                            <Card.Body>
                                <Card.Title>Total Amount Converted</Card.Title>
                                <Card.Text>
                                    {statsInfo?.total_converted} {authUser?.default_currency}
                                </Card.Text>
                            </Card.Body>
                        </Card>
                        <Card>
                            <Card.Body>
                                <Card.Title>Third Highest Amount of Transactions</Card.Title>
                                <Card.Text>
                                    {statsInfo?.third_highest_transaction} {authUser?.default_currency}
                                </Card.Text>
                            </Card.Body>
                        </Card>
                    </div>
                </Col>
                <Col lg={6}>
                    <div className="package-details-form">
                        <Card>
                            <Card.Body>
                                <Card.Title>Transfer</Card.Title>
                                <form onSubmit={handleSubmit(onSubmit)}>
                                    <div className="form-group">
                                        <label>Select Account</label>
                                        <select {...register("account_no")} className="form-control">
                                            <option value="">Select Account</option>
                                            {userSuccess && userList?.data.map(user => {
                                                return (<option key={user.id} value={user.email}>{user.email}</option>)
                                            })}
                                        </select>
                                        <p className="error-txt">{capitalize(errors.account_no?.message)}</p>
                                    </div>
                                    <div className="form-group">
                                        <label>Amount ({authUser?.default_currency})</label>
                                        <input
                                            {...register("amount")}
                                            type="number"
                                            className="form-control"
                                            placeholder="Amount"
                                            step="any"
                                        />
                                        <p className="error-txt">{capitalize(errors.amount?.message)}</p>
                                    </div>
                                    {isError && (
                                        <Alert key="error" variant="danger">
                                            {errorMessage}
                                        </Alert>
                                    )}
                                    <button type="submit" className="main-btn" >
                                        {isLoading && (<Spinner animation="border" size="sm" />)} Send
                                    </button>
                                </form>
                            </Card.Body>
                        </Card>
                    </div>
                </Col>
            </Row>
        </>
    )
}

export default Dashboard;