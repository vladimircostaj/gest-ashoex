
# Proyecto gest-ashoex

Este proyecto contiene un backend desarrollado en **Laravel 11** y un frontend en **React con Vite**. La base de datos utilizada es **Postgres** y se gestiona mediante **Docker Compose**.

## Estructura del Proyecto

- **/gest-ashoex-frontend**: Carpeta que contiene el frontend hecho en React con Vite.
- **/gest-ashoex-backend**: Carpeta que contiene el backend hecho en Laravel.
  - **docker-compose.yml**: Archivo que gestiona la base de datos **Postgres 14** con Docker.

## Requisitos Previos

### 1. Instalar **PHP 8.x**

#### Windows

1. Descarga **PHP 8.3** desde [windows.php.net/download/php-8.3](https://windows.php.net/downloads/releases/php-8.3.12-nts-Win32-vs16-x64.zip).
2. Extrae el archivo ZIP descargado en una carpeta, por ejemplo, `C:\php-8.3`.
3. Agrega PHP a las variables de entorno:
   - Ve a **Configuración** -> **Sistema** -> **Acerca de** -> **Configuración avanzada del sistema**.
   - Haz clic en **Variables de entorno**.
   - En **Variables del sistema**, selecciona **Path** y haz clic en **Editar**.
   - Agrega una nueva entrada con la ruta donde extrajiste PHP  `C:\php-8.3`.
4. Verifica la instalación:
   - Abre **CMD** o **PowerShell** y ejecuta `php -v` para verificar que PHP está instalado correctamente.

#### macOS

1. Instala Homebrew si no lo tienes:

   ```bash
   /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
   ```

2. Usa Homebrew para instalar PHP 8.x:

   ```bash
   brew install php
   ```

3. Verifica la instalación ejecutando:

   ```bash
   php -v
   ```

#### Linux (Ubuntu/Debian)

1. Actualiza los paquetes e instala los componentes necesarios:

   ```bash
   sudo apt update
   sudo apt install software-properties-common
   ```

2. Agrega el repositorio para PHP 8.x:

   ```bash
   sudo add-apt-repository ppa:ondrej/php
   sudo apt update
   ```

3. Instala PHP 8.x y las extensiones requeridas por Laravel:

   ```bash
   sudo apt install php8.2 php8.2-cli php8.2-fpm php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip
   ```

4. Verifica la instalación:

   ```bash
   php -v
   ```

---

### 2. Instalar **Node.js 18.x o superior**

#### Windows/macOS/Linux

- Ve al sitio oficial de [Node.js](https://nodejs.org/) y descarga la versión LTS (recomendada) para tu sistema operativo.

#### Verificación

Para verificar la instalación de **Node.js** y **npm** (gestor de paquetes de Node.js), ejecuta:

```bash
node -v
npm -v
```

---

### 3. Instalar **Composer**

#### Windows/

1. Descarga e instala **Composer** desde [getcomposer.org](https://getcomposer.org/download/).
2. Ejecuta el instalador (`Composer-Setup.exe`) y sigue los pasos para agregar Composer a tu sistema.

#### macOS/Linux

1. Ejecuta los siguientes comandos para instalar Composer globalmente:

   ```bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php composer-setup.php --install-dir=/usr/local/bin --filename=composer
   php -r "unlink('composer-setup.php');"
   ```

#### Verificacion

Para verificar que **Composer** está instalado correctamente, ejecuta:

```bash
composer -v
```

---

### 4. Instalar **Docker**

#### Windows/macOS

1. Descarga e instala **Docker Desktop** desde [docker.com](https://www.docker.com/products/docker-desktop).
2. Sigue las instrucciones del instalador y asegúrate de que Docker se inicia después de la instalación.

#### Linux(Ubuntu/Debian)

1. Actualiza los paquetes e instala las dependencias necesarias:

   ```bash
   sudo apt update
   sudo apt install apt-transport-https ca-certificates curl software-properties-common
   ```

2. Agrega la clave GPG oficial de Docker:

   ```bash
   curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
   ```

3. Agrega el repositorio oficial de Docker:

   ```bash
   echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
   ```

4. Instala Docker:

   ```bash
   sudo apt update
   sudo apt install docker-ce docker-ce-cli containerd.io
   ```

5. Asegúrate de que Docker está corriendo:

   ```bash
   sudo systemctl start docker
   ```

#### Verificación

Para verificar que Docker está instalado correctamente, ejecuta:

```bash
docker --version
```

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

3. **Configurar el archivo de entorno**: Copia el archivo `.env.example` a **`.env`** y configúralo para tu entorno.

    ```bash
    cp .env.example .env
    ```

4. **Generar la clave de la aplicación**: Crea una clave de seguridad para la aplicación.

    ```bash
    php artisan key:generate
    ```

5. **Configurar conexión a la base de datos**: Edita el archivo **`.env`** y asegúrate de que los valores de la base de datos sean correctos. Deberían coincidir con el contenedor de Postgres configurado en Docker Compose.

    ```env
    DB_CONNECTION=pgsql
    DB_HOST=localhost
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

3. **Documentación con Swagger**: La documentación estará disponible en `http://localhost:8000/api/documentation#/`.

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

- **Crear un Modelo con Migración**:  Este comando creará un modelo y su migración asociada:.

    ```bash
    php artisan make:model NameModel -m
    ```

- **Crear un Controlador**:  Para generar un controlador:.

    ```bash
    php artisan make:controller NameController
    ```

- **Ejecutar migraciones**: Para aplicar nuevas migraciones en la base de datos.

    ```bash
    php artisan migrate
    ```

- **Listar las rutas en el backend**: Para las rutas disponibles en el servidor de laravel.

    ```bash
    php artisan route:list
    ```

- **Instalar nuevas dependencias en el frontend**: Para añadir paquetes en React.

    ```bash
    npm install <nombre-paquete>
    ```
## Funcionalidades completas
- Listado de edificios
- Eliminado de edificios
- Registro de facilidades
- Edición de facilidades
- Listado de usos de aula
- Eliminado de usos de aula
- Listado de aula
  
## Funcionalidades pendientes
- Registrar edificio
- Editado de edificio
- Listado de facilidades
- Eliminado de facilidades
- Registro de usos de aula
- Registro de aula
- Elimando de aula
- Editado de aula
## Notas
- Es necesario modificar el backend de las ubicaciones (pisos) para que pueda integrarse a edificios y aulas correctamente.
- Existen bugs pendientes de corrección en backend.
