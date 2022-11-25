import { get, post } from './http.service.js';
import { alert } from '../pages/scripts.js';
import { getShoppingCart } from './shopping-cart.service.js';

export function login(data) {
    if (data.email === '' || data.password === '') return;
    get('login', [{ key: 'email', value: data.email }, { key: 'password', value: data.password }], true).then(res => {
        if (res.status === 'success' && res.data) {
            localStorage.setItem('user', JSON.stringify(res.data));
            getShoppingCart(res.data.id);
            location.href = '/';
        } else {
            alert(res.message, 'danger');
        }
    });
}

export function register(data) {
    if (data.email === '' || data.password === '') return;
    post('register', data, true, 'register').then(res => {
        if (res.status === 'success' && res.data) {
            localStorage.setItem('user', JSON.stringify(res.data));
            location.href = '/';
        } else {
            alert(res.message, 'danger');
        }
    });
}