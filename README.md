
# Proyecto gest-ashoex

Este proyecto contiene un backend desarrollado en **Laravel 11** y un frontend en **React con Vite**. La base de datos utilizada es **Postgres** y se gestiona mediante **Docker Compose**.

## Estructura del Proyecto

- **/gest-ashoex-frontend**: Carpeta que contiene el frontend hecho en React con Vite.
- **/gest-ashoex-backend**: Carpeta que contiene el backend hecho en Laravel.
  - **docker-compose.yml**: Archivo que gestiona la base de datos **Postgres 14** con Docker.

---

## Requisitos Previos

Antes de comenzar, asegúrate de tener las siguientes herramientas instaladas:

- [Docker](https://www.docker.com/)
- [Node.js](https://nodejs.org/) (versión 18.x o superior)
- [Composer](https://getcomposer.org/) (para gestionar dependencias de Laravel)

---

## Instalación

### Backend (Laravel 11)

1. **Clonar el repositorio**: Navega a la carpeta del backend.

    ```bash
    cd gest-ashoex-backend
    ```

2. **Instalar dependencias de Laravel**: Ejecuta el siguiente comando para instalar todas las dependencias del backend.

    ```bash
    composer install
    ```

3. **Configurar el archivo de entorno**: Copia el archivo `.env.example` a `.env` y configúralo para tu entorno.

    ```bash
    cp .env.example .env
    ```

4. **Generar la clave de la aplicación**: Crea una clave de seguridad para la aplicación.

    ```bash
    php artisan key:generate
    ```

5. **Configurar conexión a la base de datos**: Edita el archivo `.env` y asegúrate de que los valores de la base de datos sean correctos. Deberían coincidir con el contenedor de Postgres configurado en Docker Compose.

    ```env
    DB_CONNECTION=pgsql
    DB_HOST=postgres
    DB_PORT=5432
    DB_DATABASE=gestdb
    DB_USERNAME=postgres
    DB_PASSWORD=secret
    ```

### Frontend (React con Vite)

1. **Navegar al frontend**: Accede a la carpeta del frontend.

    ```bash
    cd ../gest-ashoex-frontend
    ```

2. **Instalar dependencias del frontend**: Instala las dependencias de React y Vite.

    ```bash
    npm install
    ```

---

## Levantar la Base de Datos con Docker Compose

1. **Levantar los servicios**: Desde la carpeta `gest-ashoex-backend`, ejecuta Docker Compose para levantar la base de datos Postgres.

    ```bash
    docker compose up -d
    ```

2. **Verificar que Postgres esté corriendo**: Asegúrate de que el contenedor de Postgres esté corriendo con el siguiente comando.

    ```bash
    docker ps
    ```

3. **Aplicar las migraciones de Laravel**: Ejecuta las migraciones para preparar la base de datos.

    ```bash
    php artisan migrate
    ```

---

## Iniciar el Proyecto en Desarrollo

### Backend (Laravel)

1. **Levantar el servidor de Laravel**: Desde la carpeta `gest-ashoex-backend`, levanta el servidor de desarrollo.

    ```bash
    php artisan serve
    ```

2. **Acceder al backend**: El backend estará disponible en `http://localhost:8000`.

### Frontend(React con Vite)

1. **Levantar el servidor de Vite**: Desde la carpeta `gest-ashoex-frontend`, inicia el servidor de desarrollo.

    ```bash
    npm run dev
    ```

2. **Acceder al frontend**: El frontend estará disponible en `http://localhost:5173`.

---

## Comandos Útiles

- **Detener los servicios de Docker**: Para detener y remover los contenedores.

    ```bash
    docker compose down
    ```

- **Ejecutar migraciones**: Para aplicar nuevas migraciones en la base de datos.

    ```bash
    php artisan migrate
    ```

- **Instalar nuevas dependencias en el frontend**: Usa este comando para añadir paquetes en React.

    ```bash
    npm install <nombre-paquete>
    ```
