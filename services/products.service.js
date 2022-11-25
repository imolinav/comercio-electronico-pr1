import { get } from './http.service.js';

export function searchHeaderProducts(queryString) {
    if (queryString.length < 3) return;
    return get('search', [{ key: 'header', value: true }, { key: 'text', value: queryString }], true)
}