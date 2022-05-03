import './app.scss';
import Glide from '@glidejs/glide';

const config = {
    type: 'carousel',
    startAt: 0,
    perView: 3,
    breakpoints: {
        800: {
            perView: 2
        }
    }
};

new Glide('.glide', config).mount();
