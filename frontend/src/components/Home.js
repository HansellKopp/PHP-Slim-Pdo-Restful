import React, { Component } from 'react';
import { DataTable, TableHeader } from 'react-mdl';

class Home extends Component {
  constructor() {
    super();
    this.state = {
      rows: [],
    };
    this.onSelectionChanged = this.onSelectionChanged.bind(this);
  }

  componentWillMount() {
    this.getData();
  }

  onSelectionChanged(event) {
    if (event.length === 1) {
      // eslint-disable-next-line
      this.props.history.push(`/company/${event[0]}`);
    }
  }

  async getData() {
    // eslint-disable-next-line
    const response = await fetch('/company', {
      credentials: 'same-origin',
      // eslint-disable-next-line
      headers: new Headers({
        'Content-Type': 'application/json',
      }),
      method: 'GET',
      mode: 'same-origin',
    });
    if (response.ok) {
      const rows = await response.json();
      this.setState({ rows });
    }
  }

  render() {
    return (
      <DataTable
        style={{ margin: 'auto', width: '80%' }}
        shadow={0}
        rowKeyColumn="id"
        selectable
        sortable
        rows={this.state.rows}
        onSelectionChanged={this.onSelectionChanged}
      >
        <TableHeader name="taxId" >Tax Id</TableHeader>
        <TableHeader name="name">Name</TableHeader>
        <TableHeader name="address">Address</TableHeader>
        <TableHeader name="email">Email</TableHeader>
        <TableHeader name="phoneNumber">Phone Number</TableHeader>
      </DataTable>
    );
  }
}

export default Home;
