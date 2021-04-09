import { Controller } from 'stimulus';
import { init }  from 'pell';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['input'];

  connect() {
    const editor = init({
      element: this.element.getElementsByClassName('pell-editor')[0],
      onChange: html => this.inputTarget.value = html,
      defaultParagraphSeparator: 'p',
      styleWithCSS: true,
    });

    editor.content.innerHTML = this.inputTarget.value;
  }
}
