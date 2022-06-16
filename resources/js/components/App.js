import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from 'react-router-dom';
import 'antd/dist/antd.css';
import Header from './Header';
import HomeBook from './book/HomeBook'
import Footer from './Footer'

function Example() {
    return (
        <BrowserRouter>
            <div>
                <Header />
                <HomeBook />
                <br />
                <Footer />
            </div>
        </BrowserRouter>
    );
}

export default Example;


if (document.getElementById('app')) {
    ReactDOM.render(<Example />, document.getElementById('app'));
}

