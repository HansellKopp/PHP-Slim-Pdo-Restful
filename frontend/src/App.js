import React from 'react';
import {
  BrowserRouter as Router,
  Route,
  Link,
} from 'react-router-dom';

import { Layout,
         Header,
         Navigation,
         Content,
         Drawer,
         Footer,
       } from 'react-mdl';
import Home from './components/Home';
import Company from './components/Company';

const MenuOptions = () => (
  <Navigation>
    <Link to="/"><i className="material-icons">list</i>&nbsp;List</Link>
    <Link to="/company/new"><i className="material-icons">add</i>&nbsp;New</Link>
    <a href="https://github.com/HansellKopp/PHP-Slim-Pdo-Restful"><i className="material-icons">link</i>&nbsp;GitHub</a>
  </Navigation>
);

const App = () => (
  <Router>
    <Layout fixedHeader>
      <Header title="Slim-Crud Restful Api Consumer" scroll>
        <MenuOptions />
      </Header>
      <Drawer title="Api Consumer">
        <MenuOptions />
      </Drawer>
      <Content style={{ padding: '10px' }}>
        <Route exact path="/" component={Home} />
        <Route path="/company/:id" component={Company} />
      </Content>
      <Footer size="mini" />
    </Layout>
  </Router>
);

export default App;
