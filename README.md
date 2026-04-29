# TareApp 

**TareApp** es una aplicación de gestión de tareas limpia, moderna y altamente funcional construida con el framework Laravel. Ofrece una interfaz de usuario fluida con diseño "Soft UI" para organizar prioridades y alcanzar metas diarias.

**Juan Camilo Meneses Galeano**

## Tecnologías Utilizadas
*   **PHP:** ^8.2
*   **Laravel:** 13.7.0 (Framework Backend)
*   **Tailwind CSS:** (Framework Frontend para estilos)
*   **SQLite:** (Base de datos por defecto de laravel)


## Pasos para correr el proyecto localmente

Sigue estas instrucciones para ejecutar TareApp en la máquina local:

### 1. Clonar el repositorio
Ejecutar el siguiente comando en la terminal para clonar el repositorio:
```bash
git clone https://github.com/juancho-018/gestion-tareas-personales.git
cd gestion-tareas-personales
```
*(Si ya esta descargada la carpeta solo entrar en ella desde la terminal).

### 2. Instalar dependencias de PHP y Node.js
Instalar las librerías necesarias del backend (Composer) y frontend (NPM):
```bash
composer install
npm install
```

### 3. Configurar el entorno virtual (.env)
Duplicar el archivo de configuración de ejemplo y reemplazarlo con .env:
```bash
cp .env.example .env
```
Generar la clave de seguridad de la aplicación Laravel (este comando llenará automáticamente la variable `APP_KEY=` dentro del archivo `.env` con un valor en base64):
```bash
php artisan key:generate
```

### 4. Configurar y correr las migraciones
TareApp usa SQLite por defecto. Crear el archivo de base de datos y ejecutar las migraciones para crear la estructura de las tablas:
```bash
touch database/database.sqlite
php artisan migrate
```

### 5. Compilar los assets del Frontend (Tailwind CSS)
Para que los estilos de Tailwind se generen y funcionen correctamente (especialmente las clases dinámicas), se debe ejecutar Vite:
```bash
npm run build
# O si desea dejarlo corriendo para desarrollo se ejecuta: npm run dev
```

### 6. Servir la aplicación
Finalmente, levantar el servidor de desarrollo de PHP:
```bash
php artisan serve
```
¡Listo! Ahora se puede acceder a la aplicación abriendo el navegador en el puerto 8000: [http://localhost:8000](http://localhost:8000)

---

## Link al Deploy
https://gestion-tareas-personales-production.up.railway.app/