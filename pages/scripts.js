export function updateStyles(stylesRoute, rootLevel) {
    let linkElement = document.createElement('link');
    linkElement.rel = 'stylesheet';
    let hrefLink = `${stylesRoute}/${stylesRoute}.styles.scss`;
    for(let i = 0; i < rootLevel; i++) {
        hrefLink = '../' + hrefLink;
    }
    linkElement.href = hrefLink;
    document.head.appendChild(linkElement);
}