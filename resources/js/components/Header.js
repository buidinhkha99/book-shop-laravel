import { Menu, Input } from 'antd';
import { HomeOutlined, AppstoreOutlined, UnorderedListOutlined, BookOutlined } from '@ant-design/icons';
import MenuItem from 'antd/lib/menu/MenuItem';

const { Search } = Input;

const onSearch = (value) => console.log(value);

const Header = () => (
    <Menu mode="horizontal" defaultSelectedKeys={['home']}>
        <Menu.Item key="home" icon={<HomeOutlined />}>
            Home
        </Menu.Item>
        <Menu.SubMenu key="book" title="Book" icon={<BookOutlined />}>
            <Menu.Item key="two" icon={<AppstoreOutlined />}>
                Book 1
            </Menu.Item>
        </Menu.SubMenu>
        <Menu.SubMenu key="category" title="Category" icon={<UnorderedListOutlined />}>
            <Menu.Item key="three" icon={<AppstoreOutlined />}>
                Book 1
            </Menu.Item>
        </Menu.SubMenu>
        <Menu.Item key="search" >
        <Search
            placeholder="input search text"
            allowClear
            enterButton="Search"
            onSearch={onSearch}
            style={{ width: 500, height: 10, margin: "6px 0 0 100px"}}
        />
        </Menu.Item>
    </Menu >
);

export default Header;