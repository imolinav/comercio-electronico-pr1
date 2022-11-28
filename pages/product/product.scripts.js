import { addToShoppingCart, updateShoppingCart } from '../../services/shopping-cart.service.js';
import { updateStyles } from '../scripts.js';

let quantityInput = document.getElementById('quantity');
let shoppingCartButton = document.getElementById('addToCart');
let productId = document.getElementById('productId');

(function() {
    updateStyles('product');
    shoppingCartButton.addEventListener('click', () => {
        addToShoppingCart(productId.value, quantityInput.value).then(res => {
            if (res.status === 'success' && res.data) {
                updateShoppingCart(res.data);
            } else {
                alert(res.message, 'danger');
            }
        });
    });
})();
