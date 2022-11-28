import { processPurchase, updateShoppingCart } from '../../services/shopping-cart.service.js';
import { addDirection, addPaymentMethod } from '../../services/user-management.service.js';
import { updateStyles } from '../scripts.js';

let newPaymentMethodForm = {};
let newDirectionForm = {};
let paymentMethodContainer = document.getElementById('paymentMethodContainer');
let directionContainer = document.getElementById('sendingContainer');
document.getElementById('savePaymentMethod').addEventListener('click', handleNewPaymentMethod);
document.getElementById('saveDirection').addEventListener('click', handleNewDirection);
document.getElementById('processPurchase').addEventListener('click', handleProcessPurchase);

(function() {
    updateStyles('purchase-details');
    newPaymentMethodForm = {
        type: document.getElementById('paymentMethodType'),
        value: document.getElementById('paymentMethodValue')
    };
    newDirectionForm = {
        name: document.getElementById('directionName'),
        surname: document.getElementById('directionSurname'),
        street: document.getElementById('directionStreet'),
        postalCode: document.getElementById('directionPostalCode'),
        country: document.getElementById('directionCountry'),
        phone: document.getElementById('directionPhone'),
        email: document.getElementById('directionEmail')
    };
})();

function handleNewPaymentMethod() {
    const formValues = {
        type: newPaymentMethodForm.type.value,
        value: newPaymentMethodForm.value.value
    };
    addPaymentMethod(formValues).then(res => {
        if (res.status === 'success' && res.data) {
            console.log(res.data);
            paymentMethodContainer.innerHTML = '';
            res.data.forEach(paymentMethod => {
                if (paymentMethod.payment_type === 1) {
                    paymentMethodContainer.innerHTML += [
                        `<label for="paymentMethod${paymentMethod.id}">Paypal: ${paymentMethod.paypal_user}</label>`,
                        `<input type="radio" name="paymentMethod" id="paymentMethod${paymentMethod.id}" value="${paymentMethod.id}"/>`
                    ].join('');
                } else {
                    paymentMethodContainer.innerHTML += [
                        `<label for="paymentMethod${paymentMethod.id}">Credit card: ${paymentMethod.credit_card}</label>`,
                        `<input type="radio" name="paymentMethod" id="paymentMethod${paymentMethod.id}" value="${paymentMethod.id}"/>`
                    ].join('');
                }
            });
        } else {
            alert(res.message, 'danger');
        }
    })
}

function handleNewDirection() {
    const formValues = {
        name: newDirectionForm.name.value,
        surname: newDirectionForm.surname.value,
        street: newDirectionForm.street.value,
        postalCode: newDirectionForm.postalCode.value,
        country: newDirectionForm.country.value,
        phone: newDirectionForm.phone.value,
        email: newDirectionForm.email.value
    };
    addDirection(formValues).then(res => {
        if (res.status === 'success' && res.data) {
            console.log(res.data);
            directionContainer.innerHTML = '';
            res.data.forEach(direction => {
                directionContainer.innerHTML += [
                    `<label for="sendingDestination${direction.id}">Street: ${direction.street}</label>`,
                    `<input type="radio" name="sendingDestination" id="sendingDestination${direction.id}" value="${direction.id}"/>`
                ].join('');
            });
        } else {
            alert(res.message, 'danger');
        }
    })
}

function handleProcessPurchase() {
    const paymentMethodId = document.querySelector('input[name="paymentMethod"]:checked').value;
    const directionId = document.querySelector('input[name="sendingDestination"]:checked').value;
    if (!paymentMethodId || !directionId) return;
    processPurchase(directionId, paymentMethodId).then(res => {
        if (res.status === 'success' && res.data) {
            location.href = `receipt?purchase_id=${res.data.id}`;
        } else {
            alert(res.message, 'danger');
        }
    });
}
