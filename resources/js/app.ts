import axios from 'axios';

// Set axios defaults for CSRF
const metaToken = document.querySelector('meta[name="csrf-token"]');
if (metaToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = metaToken.getAttribute('content') ?? '';
}

export default axios;
