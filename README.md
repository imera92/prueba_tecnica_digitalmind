## Prueba Técnica Digitalmind

### Levantar proyecto a traves de la consola
1. Crear un archivo `.env` en base al archivo `.env.example` de este repositorio
2. Instalar las dependencias utilizando Composer: `composer install`
    ```
    composer install
    ```
3. Generar la llave única de aplicación (unique application key) a través de la herramienta de comando `artisan`:

    ```
    php artisan key:generate
    ```
4.  Con la misma herramienta, ejecutar las migraciones y poblar la base de datos son los seeders existentes:

    ```
    php artisan migrate --seed
    ```
    Para este paso, es necesario que una base de datos llamada `digitalmind` haya sido previamente creada. La configuración de usuario que se haya en el archivo `.env.example` es de ejemplo; puede utilizar su usuario `root` configurado si así lo prefiere.
5. Finalmente, levantamos el servidor local y visitamos la URL `http://localhost:8000/`:

    ```
    php artisan serve
    ```

### Levantar proyecto con Docker Compose
1. Crear un archivo `.env` en base al archivo `.env.example` de este repositorio
2. Nos ubicamos en el directorio raíz del proyecto
3. Construimos una imagen de nuestra aplicación:
    ```
    docker-compose build app
    ```
4. Ubicados en el directorio raíz del proyecto, levantamos los servicios con Docker Compose:
    ```
    docker compose up -d
    ```
    Esto levantará 3 servicios:
    - `nginx` que contiene un servidor NGINX que se encargará de responder a las peticiones
    - `app` que sirve como intérprete PHP al servidor NGINX y nos va a permitir interactuar con los archivos de la aplicación usando PHP
    - `db` que contiene una base de datos MySQL donde se guardarán los datos de la aplicación
5. Levantamos una terminal para interactuar con el contenedor que contiene nuestra aplicación:
    ```
    docker compose exec -it app /bin/bash
    ```
6. Instalar las dependencias utilizando Composer: `composer install`
    ```
    composer install
    ```
7. Generar la llave única de aplicación (unique application key) a través de la herramienta de comando `artisan`:

    ```
    php artisan key:generate
    ```
8.  Con la misma herramienta, ejecutar las migraciones y poblar la base de datos son los seeders existentes:

    ```
    php artisan migrate --seed
    ```
    Las migraciones se ejecutarán sobre el contenedor de la base de datos, el cual ya contiene la base de  datos `digitalmind` desde que lo lenvatamos.
9. Finalmente, visitamos la URL `http://localhost:8000/`

Para detener todo el ambiente y remover todos los contenedores, ejecutamos  el siguiente comando:

    
    docker compose down