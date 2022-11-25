import { searchHeaderProducts } from "../../../services/products.service.js";

let searchInput = document.getElementById('searchInput');
let searchButton = document.getElementById('searchButton');
searchButton.addEventListener('click', () => {
    location.href = `/search?text=${searchInput.value}`;
});

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
