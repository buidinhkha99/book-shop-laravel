import React from 'react';
import { Card, Col, Row, Pagination } from 'antd';
import callApi from '../../api/axios'

const { Meta } = Card;

class HomeBook extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            loading: false,
            book: []
        };
    }

    logpagination = (page, pageSize) => {
        console.log(page + ", " + pageSize)
    }

    componentDidMount() {
        callApi(`book`, 'GET', null).then(item => {
            //setState data
            this.setState({
                loading: true,
                _products: item.data.data
            })
        });
    }


    render() {
        const { loading, _products } = this.state;
        if (!loading) {
            return (
                <h1>Loading...</h1>
            )
        }
        return (
            <div style={{padding: 5}}>
                <h1>Book Home</h1>
                <div className="site-card-wrapper">
                    <Row gutter={{ xs: 8, sm: 16, md: 24, lg: 32 }} wrap="true">
                        {
                            _products.map((item, index) => (
                                <Col span={4} className="gutter-row" key={index}>
                                    <Card
                                        hoverable
                                        style={{ width: 240 }}
                                        cover={<img alt="example" src={item.image} />}
                                    >
                                        <Meta title={item.name} description="www.instagram.com" />
                                    </Card>
                                </Col>
                            ))
                        }
                    </Row>
                    <br />
                    <div style={{ textAlign: "center" }}>
                        <Pagination defaultCurrent={1} total={50} pageSize={5} onChange={this.logpagination} />
                    </div>
                    <br />
                </div>
            </div>
        )
    }
}


export default HomeBook