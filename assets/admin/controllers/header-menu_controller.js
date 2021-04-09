import { Controller } from 'stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  isOpen = false;
  button = this.element.getElementsByTagName('button')[0];
  mobile = this.element.closest('nav').getElementsByClassName('mobile-menu')[0];

  connect() {
    this.button.addEventListener('click', () => {
      this.menu();
    })
  }

  menu() {
    this.isOpen = !this.isOpen;
    this.changeButton();
  }

  changeButton() {
    let icons = this.button.getElementsByTagName('svg');

    icons.forEach(function(element) {
      element.classList.toggle('block');
      element.classList.toggle('hidden');
    })


    this.mobile.classList.toggle('hidden');
  }
}
