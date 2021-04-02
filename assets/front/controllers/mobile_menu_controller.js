import { Controller } from 'stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  isOpen = false;

  connect() {
    this.element.addEventListener('click', () => {
      this.menu();
    })
  }

  menu() {
    this.isOpen = !this.isOpen;
    this.changeMenu();
  }

  changeMenu() {
    this.element.classList.remove('opacity-100', 'scale-100', 'duration-100', 'ease-in');
    this.element.classList.add('opacity-0', 'scale-95', 'duration-200', 'ease-out');

    if (true === this.isOpen) {
      this.element.classList.remove('opacity-0', 'scale-95', 'duration-200', 'ease-out');
      this.element.classList.add('opacity-100', 'scale-100', 'duration-100', 'ease-in');
    }
  }
}
