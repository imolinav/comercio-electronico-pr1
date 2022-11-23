import { updateStyles } from '../scripts.js';
import { register } from '../../services/user-management.service.js';

let registerForm = {};
let nameError = document.getElementById('nameError');
let surnameError = document.getElementById('surnameError');
let emailError = document.getElementById('emailError');
let birthDateError = document.getElementById('birthDateError');
let passwordError = document.getElementById('passwordError');
let confirmPasswordError = document.getElementById('confirmPasswordError');
let emailFormatError = document.getElementById('emailFormatError');
let passwordMismatchError = document.getElementById('passwordMismatchError');
document.getElementById('registerButton').addEventListener('click', handleRegister);

(function() {
    updateStyles('register');

    registerForm = {
        name: document.getElementById('name'),
        surname: document.getElementById('surname'),
        email: document.getElementById('email'),
        birthDate: document.getElementById('birthDate'),
        password: document.getElementById('password'),
        confirmPassword: document.getElementById('confirmPassword')
    };
    
})();

function handleRegister() {
    const formValues = {
        name: registerForm.name.value,    
        surname: registerForm.surname.value,    
        email: registerForm.email.value,    
        birthDate: registerForm.birthDate.value,    
        password: registerForm.password.value,    
        confirmPassword: registerForm.confirmPassword.value,    
    };

    if (formIsValid(formValues)) {
        register(formValues);
    };
}

function checkPasswords(password, confirmPassword) {
    passwordMismatchError.classList.add('d-none');
    if (password !== confirmPassword) {
        passwordMismatchError.classList.remove('d-none');
        return false;
    }
    return true;
}

function checkEmailFormat(email) {
    emailFormatError.classList.add('d-none');
    if (!/^[a-z0-9]+@[a-z]+.[a-z]+$/.test(email)) {
        emailFormatError.classList.remove('d-none');
        return false;
    }
    return true;
}

function formIsValid(formValues) {
    nameError.classList.add('d-none');
    surnameError.classList.add('d-none');
    emailError.classList.add('d-none');
    birthDateError.classList.add('d-none');
    passwordError.classList.add('d-none');
    confirmPasswordError.classList.add('d-none');
    if (formValues.name === '') {
        nameError.classList.remove('d-none');
    }
    if (formValues.surname === '') {
        surnameError.classList.remove('d-none');
    }
    if (formValues.email === '') {
        emailError.classList.remove('d-none');
    }
    if (formValues.birthDate === '') {
        birthDateError.classList.remove('d-none');
    }
    if (formValues.password === '') {
        passwordError.classList.remove('d-none');
    }
    if (formValues.confirmPassword === '') {
        confirmPasswordError.classList.remove('d-none');
    }
    return (
        formValues.name !== '' && 
        formValues.surname !== '' && 
        formValues.email !== '' && 
        formValues.birthDate !== '' && 
        formValues.password !== '' && 
        checkEmailFormat(formValues.email) && 
        checkPasswords(formValues.password, formValues.confirmPassword)
    );
}