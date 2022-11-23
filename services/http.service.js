import { showLoader, hideLoader } from '../services/loader.service.js';

export function get(url, data, loader, headers = []) {
    let httpRequest = obtainXMLHttpRequest();
    let dataParams = data.map(elem => elem.key + '=' + elem.value);

    return new Promise((resolve, reject) => {
        httpRequest.open('GET', `pages/${url}/${url}.php?${dataParams.join('&')}`, true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        headers.forEach(header => httpRequest.setRequestHeader(header.type, header.value));
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState === 2 && loader) {
                showLoader();
            }
            if (httpRequest.readyState === 4) {
                if (loader) {
                    hideLoader();
                }
                resolve(JSON.parse(httpRequest.response));
            }
        };
        httpRequest.send();
    });
}

export function post(url, data, loader, dataName, headers = []) {
    let httpRequest = obtainXMLHttpRequest();

    return new Promise((resolve, reject) => {
        httpRequest.open('POST', `pages/${url}/${url}.php`, true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        headers.forEach(header => httpRequest.setRequestHeader(header.type, header.value));
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState === 2 && loader) {
                showLoader();
            }
            if (httpRequest.readyState === 4) {
                if (loader) {
                    hideLoader();
                }
                resolve(JSON.parse(httpRequest.response));
            }
        };
        httpRequest.send(`${dataName}=${JSON.stringify(data)}`);
    });
}

export function put(url, data, loader, dataName, headers = []) {
    let httpRequest = obtainXMLHttpRequest();

    return new Promise((resolve, reject) => {
        httpRequest.open('PUT', `pages/${url}/${url}.php`, true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        headers.forEach(header => httpRequest.setRequestHeader(header.type, header.value));
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState === 2 && loader) {
                showLoader();
            }
            if (httpRequest.readyState === 4) {
                if (loader) {
                    hideLoader();
                }
                resolve(JSON.parse(httpRequest));
            }
        };
        httpRequest.send(`${dataName}=${JSON.stringify(data)}`);
    });
}

function obtainXMLHttpRequest() {
    let httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject('MSXML2.XMLHTTP');
        } catch(e) {
            try {
                httpRequest = new ActiveXObject('Microsoft.XMLHTTP');
            } catch(e) {}
        }
    }
    if (!httpRequest) {
        return false;
    } else {
        return httpRequest;
    }
}
