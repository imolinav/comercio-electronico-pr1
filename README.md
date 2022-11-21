# COMERCIO ELECTRÓNICO - PRÁCTICA 1

## Información del proyecto

El proyecto está desarrollado con PHP para la parte de back, y HTML + CSS +JS para el front. La estructura de ficheros del proyecto sigue un patrón parecido al de Angular, en que tenemos, por cada página un mínimo de 3 ficheros, además de un cuarto si el componente en particular tiene llamadas a XMLHttpRequest:

- `componente.view.phtml`: contiene la vista del componente.
- `componente.styles.css`: en el que se incluyen los estilos que hacen efecto sobre la vista y se incorpora de forma automática en la cabecera del HTML.
- `componente.scripts.js`: en el que se incluye toda la lógica de la aplicación que se ejecuta sobre el navegador (control de formularios, interacciones de usuario, etc...).
- `componente.service.php`: gestiona las llamadas XMLHttpRequest como si se tratara de una API.


## BBDD

Base de datos MySQL con el siguiente diagrama...

## Backend

Hay dos ficheros diferentes que vale la pena mencionar:

### `controller.php`

Se encarga de gestionar las funcionalidades trasversales de la aplicación, tales como: 

- Conexión a la base de datos
- Actualización de idiomas (cuyas traducciones se encuentran en los ficheros `internationalization/idioma.php`) en la variable `$_COOKIE`.

### Ficheros `componente.service.ts`

Como hemos comentado anteriormente son los ficheros sobre los que se hacen las llamadas XMLHttpRequest. Sirven para recibir llamadas POST, realizar llamadas a la base de datos y devolver los resultados al componente.

## Frontend

Desarrollado en HTML, CSS y JavaScript, con apoyo del gestor de librerías NPM, y con una estructura basada en Angular de MVP. 

El fichero `page.php` localizado en la raiz del proyecto incorpora su vista (`pages/page/page.view.php`). Una vez incluida esta, se importa en la misma su fichero JavaScript (`pages/page/page.scripts.js`) y por medio de la función `updateStyles` del fichero `pages/scripts.js` se actualiza en la etiqueta HEAD de la aplicación el link a los estilos contenidos en `pages/page/page.styles.css`.

El fichero `pages/scripts.js` contiene las funcionalidades:

- `updateStyles`: lee la ruta del componente y añade en la etiqueta HEAD de la aplicación la etiqueta LINK que apunta a los estilos del componente.

## TODO

- [x] Crear base de datos
- [x] Generar modelos de datos (revisar)
- [ ] Vistas
- [ ] Router
- [x] Translation service