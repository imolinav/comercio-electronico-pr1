let loaderStatus = false;
let backdrop;

export function showLoader() {
    if (!loaderStatus) {
        document.body.appendChild(backdrop);
        loaderStatus = true;
    }
}

export function hideLoader() {
    if (loaderStatus) {
        document.body.removeChild(backdrop);
        loaderStatus = false;
    }
}

(function() {
    backdrop = initializeBackdropElement();
})();

function initializeBackdropElement() {
    let backdrop = document.createElement('div');
    backdrop.setAttribute('class', 'loader-backdrop');
    let loaderContainer = document.createElement('div');
    loaderContainer.setAttribute('class', 'loader-container');
    let loader = document.createElement('img');
    loader.setAttribute('class', 'loader-image');
    loader.setAttribute('src', 'assets/loader/sircles-pic.svg');
    loaderContainer.appendChild(loader);
    backdrop.appendChild(loaderContainer);
    return backdrop;
}
