import { get, post } from './http.service.js';
import { alert, createCookie } from '../pages/scripts.js';

export function login(data) {
    console.log(data);
    if (data.email === '' || data.password === '') return;
    get('login', [{ key: 'email', value: data.email }, { key: 'password', value: data.password }], true).then(res => {
        console.log(res);
        if (res.status === 'success' && res.data) {
            localStorage.setItem('user', JSON.stringify(res.data));
            const user = JSON.parse(res.data);
            console.log(res.data.id);
            console.log(user.id);
            createCookie('userId', user.id, 30);
            /* location.href = '/';
            location.reload(); */
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
            const user = JSON.parse(res.data);
            console.log(res.data.id);
            console.log(user.id);
            createCookie('userId', user.id, 30);
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