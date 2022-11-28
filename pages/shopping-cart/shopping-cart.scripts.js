import { changeItemQuantity, removeFromShoppingCart, updateShoppingCart } from '../../services/shopping-cart.service.js';
import { updateStyles } from '../scripts.js';

let removeButtons = document.getElementsByClassName('remove-product');
let quantitiesInputs = document.getElementsByName('productQuantity');
let shoppingCartProducts = document.getElementsByClassName('shopping-cart-product-list');
for (let i = 0; i<quantitiesInputs.length; i++) {
    quantitiesInputs[i].addEventListener('change', (event) => updateShoppingCartItem(event.target.id.split('productQuantity').pop(), event.target.value));
}
for (let i = 0; i<removeButtons.length; i++) {
    removeButtons[i].addEventListener('click', (event) => removeShoppingCartItem(event.target.id.split('removeProduct').pop()));
}

(function() {
    updateStyles('shopping-cart');
})();

function removeShoppingCartItem(productId) {
    if (!productId) return;
    removeFromShoppingCart(productId).then(res => {
        if (res.status === 'success' && res.data) {
            for (let i = 0; i < shoppingCartProducts.length; i++) {
                if (shoppingCartProducts[i].id.split('shoppingCartItem').pop() == productId) {
                    shoppingCartProducts[i].parentNode.removeChild(shoppingCartProducts[i]);
                }
            }
            updateShoppingCart(res.data);
        } else {
            alert(res.message, 'danger');
        }
    })
}

function updateShoppingCartItem(productId, quantity) {
    changeItemQuantity(productId, quantity).then(res => {
        if (res.status === 'success' && res.data) {
            for (let i = 0; i < shoppingCartProducts.length; i++) {
                if (shoppingCartProducts[i].id.split('shoppingCartItem').pop() == productId) {
                    const priceHTMLElement = shoppingCartProducts[i].getElementsByClassName('product-total-price')[0];
                    const newPrice = Number(priceHTMLElement.getAttribute('data-price'))
                    priceHTMLElement.innerHTML = `Total: ${newPrice * quantity}€`;
                }
            }
            updateShoppingCart(res.data);
        } else {
            alert(res.message, 'danger');
        }
    })
}
