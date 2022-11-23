import { login } from '../../services/user-management.service.js';
import { updateStyles } from '../scripts.js';

let loginForm = {};
let emailError = document.getElementById('emailError');
let emailFormatError = document.getElementById('emailFormatError');
let passwordError = document.getElementById('passwordError');
document.getElementById('loginButton').addEventListener('click', handleLogin);

(function() {
    updateStyles('login');

    loginForm = {
      email: document.getElementById('email'),
      password: document.getElementById('password')
    };
})();

function handleLogin() {
  const formValues = {
    email: loginForm.email.value,
    password: loginForm.password.value
  }

  if (formIsValid(formValues)) {
    login(formValues);
  }
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
  emailError.classList.add('d-none');
  passwordError.classList.add('d-none');
  if (formValues.email === '') {
    emailError.classList.remove('d-none');
  }
  if (formValues.password === '') {
    passwordError.classList.remove('d-none');
  }
  return (
    formValues.email !== '' && 
    formValues.password !== '' && 
    checkEmailFormat(formValues.email)
  );
}
