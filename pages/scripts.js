export function updateStyles(stylesRoute, rootLevel) {
    let linkElement = document.createElement('link');
    linkElement.rel = 'stylesheet';
    let hrefLink = `${rootLevel}/${stylesRoute}/${stylesRoute}.styles.css`;
    linkElement.href = hrefLink;
    document.head.appendChild(linkElement);
}