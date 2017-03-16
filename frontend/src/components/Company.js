import React, { Component } from 'react';
import { Card,
         Textfield,
         CardTitle,
         CardText,
         Button,
         CardActions,
         Grid,
         Cell } from 'react-mdl';

class Company extends Component {
  constructor(props) {
    super(props);
    this.id = this.props.match.params.id;
    this.state = {
      row: {
        id: '',
        taxId: '',
        name: '',
        address: '',
        email: '',
        phoneNumber: '',
      },
      action: this.id === 'new' ? 'New' : 'Edit / Delete',
    };
    this.save = this.save.bind(this);
    this.cancel = this.cancel.bind(this);
    this.delete = this.delete.bind(this);
    this.updateState = this.updateState.bind(this);
  }

  componentWillMount() {
    if (this.id !== 'new') {
      this.getData();
    }
  }

  async getData() {
    try {
      // eslint-disable-next-line
      const response = await fetch(`/company/${this.id}`, {
        credentials: 'same-origin',
        // eslint-disable-next-line
        headers: new Headers({
          'Content-Type': 'application/json',
        }),
        method: 'GET',
        mode: 'same-origin',
      });
      if (response.ok) {
        const row = await response.json();
        this.setState({ row });
      }
    } catch (e) {
        // eslint-disable-next-line
        console.log(e.message);
    }
  }

  cancel() {
    // eslint-disable-next-line
    this.props.history.push("/");
  }

  updateState(event) {
    const row = this.state.row;
    row[event.target.name] = event.target.value;
    this.setState({ row });
  }

  async save() {
    try {
      // eslint-disable-next-line
      const response = await fetch("/company", {
        credentials: 'same-origin',
        // eslint-disable-next-line
        headers: new Headers({
          'Content-Type': 'application/json',
        }),
        body: JSON.stringify(this.state.row),
        method: this.id === 'new' ? 'POST' : 'PUT',
        mode: 'same-origin',
      });
      if (response.ok) {
        // eslint-disable-next-line
        this.props.history.push("/");
      }
    } catch (e) {
      // eslint-disable-next-line
      console.log(e);
    }
  }

  async delete() {
    try {
      // eslint-disable-next-line
      const response = await fetch(`/company/${this.id}`, {
        credentials: 'same-origin',
        // eslint-disable-next-line
        headers: new Headers({
          'Content-Type': 'application/json',
        }),
        method: 'DELETE',
        mode: 'same-origin',
      });
      if (response.ok) {
          // eslint-disable-next-line
         this.props.history.push("/");
      }
    } catch (e) {
      // eslint-disable-next-line
      console.log(e);
    }
  }

  render() {
    return (
      <Card shadow={0} style={{ margin: 'auto', width: '50%' }}>
        <CardTitle>{this.state.action} Company</CardTitle>
        <CardText>
          <Grid>
            <Cell col={6}>
              <Textfield
                name="taxId"
                label="Tax ID"
                value={this.state.row.taxId}
                onChange={this.updateState}
                floatingLabel
                required
              />
            </Cell>
            <Cell col={6}>
              <Textfield
                name="name"
                label="Name"
                value={this.state.row.name}
                onChange={this.updateState}
                floatingLabel
                required
              />
            </Cell>
            <Cell col={12}>
              <Textfield
                name="address"
                label="Address"
                value={this.state.row.address}
                onChange={this.updateState}
                style={{ width: '100%' }}
                floatingLabel
              />
            </Cell>
            <Cell col={6}>
              <Textfield
                name="email"
                label="Email"
                onChange={this.updateState}
                value={this.state.row.email}
                floatingLabel
                required
                type="email"
              />
            </Cell>
            <Cell col={6}>
              <Textfield
                name="phoneNumber"
                label="Phone Number"
                onChange={this.updateState}
                value={this.state.row.phoneNumber}
                floatingLabel
              />
            </Cell>
          </Grid>
        </CardText>
        <CardActions border>
          <Button colored onClick={this.save}>
            {this.state.action === 'New' ? 'Save' : 'Update'}
          </Button>
          {
            this.state.action === 'Edit / Delete' &&
            <Button colored onClick={this.delete}>Delete</Button>
          }
          <Button colored onClick={this.cancel}>Cancel</Button>
        </CardActions>
      </Card>
    );
  }
}

export default Company;
