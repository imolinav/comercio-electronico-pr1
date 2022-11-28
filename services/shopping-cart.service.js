import { alert } from '../pages/scripts.js';
import { get, post } from './http.service.js';

export function getShoppingCart(userId) {
    if (!userId || userId === 0) return;
    get('product', [{ key: 'user_id', value: userId }], true).then(res => {
        if (res.status === 'success' && res.data) {
            updateShoppingCart(res.data);
        } else {
            alert(res.message, 'danger');
        }
    })
}

export function addToShoppingCart(userId, productId, quantity) {
    if (!productId || productId === 0) return;
    post('product', { userId: userId, product: productId, quantity: quantity }, true, 'add_product').then(res => {
        if (res.status === 'success' && res.data) {
            updateShoppingCart(res.data);
        } else {
            alert(res.message, 'danger');
        }
    });
}

export function removeFromShoppingCart(productId) {
    if (!productId || productId === 0) return;
    const user = JSON.parse(localStorage.getItem('user'));
    return post('product', { userId: user.id, productId: productId}, true, 'remove_product');
}

export function changeItemQuantity(productId, quantity) {
    if (!productId || productId === 0 || !quantity) return;
    const user = JSON.parse(localStorage.getItem('user'));
    return post('product', { userId: user.id, productId: productId, quantity: quantity }, true, 'update_product');
}

export function updateShoppingCart(shoppingCart) {
    localStorage.setItem('shopping-cart', JSON.stringify(shoppingCart));
    const shoppingCartItems = document.getElementById('shoppingCartItems');
    if (shoppingCart.products.length > 0) {
        const totalItems = shoppingCart.products.reduce((acc, item) => {
            return acc + item.quantity;
        }, 0);
        shoppingCartItems.classList.remove('d-none');
        shoppingCartItems.innerText = totalItems;
    } else {
        shoppingCartItems.classList.add('d-none');
        shoppingCartItems.innerText = '';
    }
}