import { updateStyles } from '../scripts.js';

let companyInputs = document.getElementsByName('company');
let typeInputs = document.getElementsByName('type');

(function() {
    updateStyles('search');
})();

companyInputs.forEach(input => input.addEventListener('click', (event) => filterProducts(event)));
typeInputs.forEach(input => input.addEventListener('click', (event) => filterProducts(event)));

function filterProducts(event) {
    const products = document.querySelectorAll(`[data-${event.target.name}="${event.target.value}"]`);
    if(event.target.checked) {
        products.forEach(item => {
            const secondaryFilter = event.target.name === 'company' ? 'type' : 'company';
            const productSecondaryData = item.getAttribute(`data-${secondaryFilter}`);
            const secondaryInputs = document.getElementsByName(secondaryFilter);
            secondaryInputs.forEach(input => {
                if (input.value === productSecondaryData && input.checked) {
                    item.classList.remove('d-none');
                }
            });
        });
    } else {
        products.forEach(item => item.classList.add('d-none'));
    }
}
