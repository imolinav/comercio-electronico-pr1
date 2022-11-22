export function updateStyles(stylesRoute) {
    let linkElement = document.createElement('link');
    linkElement.rel = 'stylesheet';
    let hrefLink = `pages/${stylesRoute}/${stylesRoute}.styles.css`;
    linkElement.href = hrefLink;
    document.head.appendChild(linkElement);
}