import { get, post } from './http.service.js';

export function getShoppingCart(userId) {
    if (!userId || userId === 0) return;
    return get('product', [{ key: 'user_id', value: userId }], true);
}

export function addToShoppingCart(productId, quantity) {
    if (!productId || productId === 0) return;
    const userId = JSON.parse(localStorage.getItem('user')).id;
    return post('product', { userId: userId, product: productId, quantity: quantity }, true, 'add_product');
}

export function removeFromShoppingCart(productId) {
    if (!productId || productId === 0) return;
    const userId = JSON.parse(localStorage.getItem('user')).id;
    return post('product', { userId: userId, productId: productId}, true, 'remove_product');
}

export function changeItemQuantity(productId, quantity) {
    if (!productId || productId === 0 || !quantity) return;
    const userId = JSON.parse(localStorage.getItem('user')).id;
    return post('product', { userId: userId, productId: productId, quantity: quantity }, true, 'update_product');
}

export function updateShoppingCart(shoppingCart) {
    if (!shoppingCart) {
        localStorage.setItem('shopping-cart', null);
    } else {
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
}

export function processPurchase(direction, paymentMethod) {
    if (!direction || !paymentMethod) return;
    const userId = JSON.parse(localStorage.getItem('user')).id;
    return post('purchase-details', { userId: userId, direction: direction, paymentMethod: paymentMethod }, true, 'process_purchase');
}