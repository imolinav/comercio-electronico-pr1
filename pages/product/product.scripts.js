import { addToShoppingCart } from '../../services/shopping-cart.service.js';
import { updateStyles } from '../scripts.js';

let quantityInput = document.getElementById('quantity');
let shoppingCartButton = document.getElementById('addToCart');
let productId = document.getElementById('productId');

(function() {
    updateStyles('product');
    shoppingCartButton.addEventListener('click', () => {
        const userId = JSON.parse(localStorage.getItem('user')).id
        addToShoppingCart(userId, productId.value, quantityInput.value);
    });
})();
