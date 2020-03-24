import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';

class Clock extends React.Component {
    constructor(props) {
      super(props);
      this.state = { time: new Date() };
    }

    componentDidMount() {
      this.timer = setInterval( () => this.tick(),1000);
    }

    componentWillUnmount() {
      this.timer = clearInterval(this.timer);
    }

    tick() {
      this.setState( {time: new Date()}  );
    }

    render() {
      return (
        <div>
          <h1>Привіт, світе!</h1>
          <h2>Зараз {this.state.time.toLocaleTimeString()} </h2>
        </div>
      );
    }
}


ReactDOM.render(
  <Clock />,
  document.getElementById('root')
);
