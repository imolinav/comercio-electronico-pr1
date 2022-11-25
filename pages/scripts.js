import { getShoppingCart } from "../services/shopping-cart.service.js";

export function updateStyles(stylesRoute) {
    let linkElement = document.createElement('link');
    linkElement.rel = 'stylesheet';
    let hrefLink = `pages/${stylesRoute}/${stylesRoute}.styles.css`;
    linkElement.href = hrefLink;
    document.head.appendChild(linkElement);
}

export function alert(message, type, timeout = 5000) {
    const pageAlert = document.getElementById('pageAlert');
    const wrapper = document.createElement('div')
    wrapper.innerHTML = [
      `<div class="alert alert-${type} alert-dismissible" role="alert">`,
      `   <div>${message}</div>`,
      '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
      '</div>'
    ].join('')
  
    pageAlert.append(wrapper);
    setTimeout(() => {
        pageAlert.removeChild(wrapper);
    }, timeout);
}

(function() {
    const user = localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : { id: Date.now() };
    localStorage.setItem('user', JSON.stringify(user));
    getShoppingCart(user.id);
})();