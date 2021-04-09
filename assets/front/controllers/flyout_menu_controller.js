import { Controller } from 'stimulus';
import ReactDOM from 'react-dom';
import React from 'react';
import FlyoutMenu from "../../components/FlyoutMenu";

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static values = {
    menu: Object
  }

  connect() {
    ReactDOM.render(<FlyoutMenu menu={ this.menuValue } />, this.element);
  }
}
