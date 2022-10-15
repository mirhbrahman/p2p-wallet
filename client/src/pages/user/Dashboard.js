import { Row, Col, Card, Spinner } from "react-bootstrap";
import { toastMessage } from "../../utils/helpers";

const Dashboard = () => {


    const handleSubmit = (e) => {
        e.preventDefault();
        toastMessage('User created successfully.');
    }


    return (
        <>
            <h3>Dashboard</h3>

            <Row>
                <Col lg={6}>
                    <div className="package-details-form">
                        <Card className="mb-3">
                            <Card.Body>
                                <Card.Title>Card Title</Card.Title>
                                <Card.Text>
                                    Some quick example text to build on the card title and make up the
                                    bulk of the card's content.
                                </Card.Text>
                            </Card.Body>
                        </Card>
                        <Card className="mb-3">
                            <Card.Body>
                                <Card.Title>Card Title</Card.Title>
                                <Card.Text>
                                    Some quick example text to build on the card title and make up the
                                    bulk of the card's content.
                                </Card.Text>
                            </Card.Body>
                        </Card>
                        <Card>
                            <Card.Body>
                                <Card.Title>Card Title</Card.Title>
                                <Card.Text>
                                    Some quick example text to build on the card title and make up the
                                    bulk of the card's content.
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
                                <form onSubmit={handleSubmit}>
                                    <div className="form-group">
                                        <label>Select Account</label>
                                        <select className="form-control">
                                            <option value="">Select Account</option>
                                            <option>test</option>
                                        </select>
                                    </div>
                                    <input
                                        type="number"
                                        className="form-control"
                                        placeholder="Password"
                                    />
                                    <button type="submit" className="main-btn" >
                                        <Spinner animation="border" size="sm" /> Login
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