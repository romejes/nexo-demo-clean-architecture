# Laravel Starter Template

Este es un repositorio que contiene una estructura base para un proyecto de Laravel, apoyado con contenedores.

## Índice
- [Requisitos](#requisitos)
- [Contenedores](#contenedores)
- [Instalación](#instalación)
- [Estructura](#estructura)
    -   [Variables](#variables)
- [Notas finales](#notas-finales)

## Requisitos
Solo necesita tener instalado en su equipo tanto Docker como Docker Compose.

## Contenedores
Este proyecto contiene los siguientes servicios alojados en contenedores:

- Nginx (Servidor web)
- PHP 7.2 
- MySQL 5.7 (Base de datos)

## Instalación
- Clone este repositorio o descárguelo como ZIP.

- Copie el archivo `.env.example` y renombrarlo como `.env` y rellenar sus valores los cuales se describen [aquí](#variables).

- Abra el archivo `./docker/nginx/conf.d/app.conf` y    modifique la linea 2

    ```
    upstream fastcgi_app {
        server [app-name]-php:9000;
    }
    ```

    donde `[app-name]` es el nombre de la aplicación especificada en la variable `APP_NAME`. Esto permitirá acceder al proyecto desde el navegador mediante la dirección `localhost:[puerto_http]`

-   Por ultimo establezca las configuraciones necesarias dentro del proyecto de Laravel.


##  Ejecución
Al instalar por primera vez los contenedores se ejecutarán mediante Docker. Puede realizar otras acciones mas adelante como por ejemplo:

```
# Ejecutar los contenedores en segundo plano
docker-compose up -d

# Detener la ejecución de los contenedores
docker-compose down
```

## Estructura
Este repositorio consta inicialmente de una sola carpeta llamada `docker` la cual contiene toda la configuración de los contenedores y esta a su vez utiliza el archivo `.env` para leer las variables y crear los contenedores necesarios.

Los archivos que forman parte de la aplicación están en la carpeta `src`.

### Variables
El significado de cada variable es el siguiente:

-    **APP_NAME**: Nombre de la aplicación. Este valor sera utilizado para los nombres de los contenedores.
    
-   **APP_PATH**: Ruta donde estará el proyecto de Laravel, por defecto se llama `src`.

-   **APP_USER**: Nombre de usuario que se utilizará en el contenedor que alojará el proyecto (PHP). Puede ser cualquier nombre.

-   **INSTALL_MYSQL**: Indica si se instalará la extension PDO para conexión con bases de datos MySQL. Su valores permitidos son `true`o `false`.

-   **INSTALL_GD**: Indica si se instalará la extension GD para procesamiento de imágenes. Su valores permitidos son `true`o `false`.

-   **INSTALL_XDEBUG**: Indica si se instalará la extension XDebug para depurar la aplicación en ambiente de desarrollo. Su valores permitidos son `true`o `false`. Tenga en cuenta que debe configurar el uso de xDebug según cual sea su editor de código a usar.

-   **PORT_HTTP**: Puerto de conexión HTTP.

-   **PORT_HTTPS**: Puerto de conexión HTTPS

-   **MYSQL_DATABASE**: Nombre de la base de datos de MySQL a conectar.

-   **MYSQL_ROOT_USER**: Nombre del usuario root de de MySQL.

-   **MYSQL_ROOT_PASSWORD**: Contraseña de usuario root de MySQL.

-   **MYSQL_USER**: Nombre de usuario no root de MySQL.

-   **MYSQL_PASSWORD**: Contraseña de usuario no root de MySQL.

-   **MYSQL_PORT**: Puerto de conexión de MySQL.

## Notas finales
Cabe indicar que la version de Laravel a utilizar es la version 7.x, y sus contenedores están adecuados para esta versión. Sin embargo se espera ampliar sus capacidades en versiones posteriores, asi como soportar otras versiones de Laravel y de los servicios que pueda utilizar.