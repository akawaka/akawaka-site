import { Controller } from 'stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  isOpen = false;
  button = this.element.getElementsByTagName('button')[0];
  svg = this.element.getElementsByTagName('svg')[0];
  flyout = this.element.getElementsByClassName('flyout')[0]

  connect() {
    this.button.addEventListener('click', () => {
      this.menu();
    })
  }

  menu() {
    this.isOpen = !this.isOpen;
    this.changeSvg();
    this.changeButton();
    this.changeFlyout();
  }

  changeButton() {
    this.button.classList.remove('text-gray-900');
    this.button.classList.add('text-gray-500');
    this.button.setAttribute('aria-expanded', false);

    if (true === this.isOpen) {
      this.button.classList.remove('text-gray-500');
      this.button.classList.add('text-gray-900');
      this.button.setAttribute('aria-expanded', true);
    }
  }

  changeSvg() {
    this.svg.classList.remove('text-gray-600');
    this.svg.classList.add('text-gray-400');

    if (true === this.isOpen) {
      this.svg.classList.remove('text-gray-400');
      this.svg.classList.add('text-gray-600');
    }
  }

  changeFlyout() {
    this.flyout.classList.remove('opacity-100', 'translate-y-0', 'transition', 'ease-in', 'duration-150');
    this.flyout.classList.add('opacity-0', 'translate-y-1', 'transition', 'ease-out', 'duration-200');

    if (true === this.isOpen) {
      this.flyout.classList.remove('opacity-0', 'translate-y-1', 'transition', 'ease-out', 'duration-200');
      this.flyout.classList.add('opacity-100', 'translate-y-0', 'transition', 'ease-in', 'duration-150');
    }
  }
}
