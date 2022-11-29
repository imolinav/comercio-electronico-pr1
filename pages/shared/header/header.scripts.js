import { post } from "../../../services/http.service.js";
import { searchHeaderProducts } from "../../../services/products.service.js";
import { createCookie } from "../../scripts.js";

let searchInput = document.getElementById('searchInput');
let searchButton = document.getElementById('searchButton');
let shoppingCartContainer = document.getElementById('shoppingCartContainer');
let shoppingCartButton = document.getElementById('shoppingCartButton');
let languageButtons = document.getElementsByClassName('language-select');
searchButton.addEventListener('click', () => {
    location.href = `/search?text=${searchInput.value}`;
});
for (let i = 0; i < languageButtons.length; i++) {
    languageButtons[i].addEventListener('click', (event) => {
        createCookie('locale', event.target.dataset.language, 30);
        post('../index', { language: event.target.dataset.language}, true, 'locale').then(() => location.reload());
    });
}

searchInput.addEventListener('keyup', (event) => {
    if (!event.isTrusted) return;
    if (event.key === 'Enter') {
        location.href = `/search?text=${searchInput.value}`;
    } else if (searchInput.value.length > 2) {
        searchHeaderProducts(searchInput.value).then(res => {
            if (res.status === 'success' && res.data) {
                createResultBox(res.data);
            } else {
                clearResultBox();
            }
        });
    } else {
        clearResultBox();
    }
});

shoppingCartButton.addEventListener('click', () => {
    if (document.getElementById('shoppingCartList')) {
        clearShoppingCartBox();
    } else {
        const shoppingCart = JSON.parse(localStorage.getItem('shopping-cart'));
        const shoppingCartList = document.createElement('div');
        shoppingCartList.setAttribute('id', 'shoppingCartList');
        if (!shoppingCart || shoppingCart.products.length == 0) {
            shoppingCartList.innerHTML = [
                `<p>No has añadido nada al carrito todavia.</p>`
            ].join('');
        } else {
            let productList = '';
            shoppingCart.products.forEach(product => {
                const productPrice = product.offer 
                    ? `<p class="result-element-price">${product.offer}€</p><p class="result-element-previous">${product.price}€</p>`
                    : `<p class="result-element-price">${product.price}€</p>`
                productList += [
                    `<a class="shopping-cart-product" href="${product.name.toLowerCase().replace(' ', '-')}">`,
                    `   <div class="shopping-cart-product-info">`,
                    `       <p class="shopping-cart-product-name">${product.name}</p>`,
                    `       <p class="shopping-cart-product-quantity">Total: x${product.quantity}</p>`,
                    `   </div>`,
                    `   <div class="d-flex">`,
                    productPrice,
                    `   </div>`,
                    `</a>`
                ].join('');
            });
            shoppingCartList.innerHTML = productList;
            const shoppingButton = document.createElement('a');
            shoppingButton.setAttribute('class', 'btn btn-primary shopping-cart-button bg-primary-color text-secondary-color');
            shoppingButton.innerText = 'Ir al carrito';
            shoppingButton.setAttribute('href', 'shopping-cart');
            shoppingCartList.appendChild(shoppingButton);
        }
        shoppingCartContainer.appendChild(shoppingCartList);
    }
})

searchInput.addEventListener('focus', (event) => {
    if (searchInput.value.length > 2) {
        searchHeaderProducts(searchInput.value).then(res => {
            if (res.status === 'success' && res.data) {
                createResultBox(res.data);
            } else {
                clearResultBox();
            }
        });
    }
});

document.body.addEventListener('click', (event) => {
    const resultBox = document.getElementById('resultContainer');
    if (!resultBox || resultBox.contains(event.target) || searchInput.contains(event.target)) {
        return
    }
    clearResultBox();
})

function createResultBox(data) {
    if (document.getElementById('resultContainer')) clearResultBox();
    const resultBox = document.createElement('div');
    resultBox.setAttribute('class', 'result-container');
    resultBox.setAttribute('id', 'resultContainer');
    data.forEach(element => {
        const elementBox = document.createElement('div');
        const priceText = element.offer 
            ? `<p class="result-element-price">${element.offer}</p><p class="result-element-previous">${element.price}</p>`
            : `<p class="result-element-price">${element.price}</p>`
        elementBox.innerHTML = [
            `<div class="result-element">`,
            `   <div>`,
            `       <p class="result-element-name">${element.name}</p>`,
            `       <p class="result-element-company">${element.company} - ${element.type}</p>`,
            `   </div>`,
            `   <div class="result-element-prices">`,
            priceText,
            `   </div>`,
            `</div>`
        ].join('');
        resultBox.appendChild(elementBox);
    });
    document.getElementsByClassName('header')[0].appendChild(resultBox);
}

function clearResultBox() {
    const resultContainer = document.getElementById('resultContainer');
    if (!resultContainer) return;
    document.getElementsByClassName('header')[0].removeChild(resultContainer);
}

function clearShoppingCartBox() {
    shoppingCartContainer.removeChild(document.getElementById('shoppingCartList'));
}
