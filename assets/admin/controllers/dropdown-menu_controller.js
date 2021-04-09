import { Controller } from 'stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  isOpen = false;
  dropdown = this.element.getElementsByClassName('dropdown')[0]
  button = this.element.getElementsByTagName('button')[0];

  connect() {
    this.button.addEventListener('click', () => {
      this.menu();
    })
  }

  menu() {
    this.isOpen = !this.isOpen;
    this.changeDropdown();
  }

  changeDropdown() {
    this.dropdown.classList.remove('transition', 'ease-out', 'duration-200', 'transform', 'opacity-100', 'scale-100');
    this.dropdown.classList.add('transition', 'ease-in', 'duration-75', 'transform', 'opacity-0', 'scale-95', 'hidden');

    if (true === this.isOpen) {
      this.dropdown.classList.remove('transition', 'ease-in', 'duration-75', 'transform', 'opacity-0', 'scale-95', 'hidden');
      this.dropdown.classList.add('transition', 'ease-out', 'duration-200', 'transform', 'opacity-100', 'scale-100');
    }
  }
}
