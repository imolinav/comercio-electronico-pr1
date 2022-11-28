import { get, post } from './http.service.js';
import { alert } from '../pages/scripts.js';

export function login(data) {
    if (data.email === '' || data.password === '') return;
    get('login', [{ key: 'email', value: data.email }, { key: 'password', value: data.password }], true).then(res => {
        if (res.status === 'success' && res.data) {
            localStorage.setItem('user', JSON.stringify(res.data));
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

export function addPaymentMethod(data) {
    return post('purchase-details', data, true, 'add_payment_method');
}

export function addDirection(data) {
    return post('purchase-details', data, true, 'add_direction');
}