***1. ¿Que es una MVC?***

El MVC (model,view,controller). Es un patrón de arquitectura de software que separa las responsabilidades de una aplicación en tres capas: el Modelo, que gestiona los datos y la lógica; la Vista, que es la interfaz de usuario; y el Controlador, que actúa como mediador. Cuando el usuario realiza una acción en la vista, el controlador la procesa, interactúa con el modelo si es necesario y devuelve la respuesta actualizada a la vista.

***2. Diferencia entre los metodos HTTP GET Y POST ¿cuando usarias cada uno?***

La diferencia entre los metodos HTTP GET y POST es que GET se utiliza para solicitar datos de un recurso y POST se utiliza para enviar datos como por ejemplo para crear o actualizar un recurso. Yo usaria GET para obtener datos de un recurso y POST para crear o actualizar un recurso. Usaria GET para obtener datos de un recurso como por ejemplo para listar tareas, mostrar detalles de una tarea y POST para crear o actualizar un recurso como por ejemplo para crear una nueva tarea o actualizar una tarea existente.

***3. Que es Eloquent en laravel y que problema resuelve?***

Eloquent es un ORM (Object-Relational Mapping) que viene incluido en Laravel como una herramienta para la interaccion con la base de datos y sea mucho mas directa, lo que significa que cada tabla de la base de datos tiene su modelo en una clase, y una instancia de esa clase representa cada fila de esa tabla. Esto resuelve el problema de tener que escribir consultas SQL para cada operacion que se quiere realizar en la base de datos lo que lo hace mas propenso a errores de sintaxis y/o dificil de leer, eloquent hace que podamos utilizar metodos de php limpios.

***4. ¿Qué hace el comando php artisan migrate y para qué sirven las migraciones?***

El comando artisan ejecuta las migraciones que recibe de la carpeta database/migrations, consulta esas migraciones y mira cuales no se han ejecutado y las ejecuta. Por otro lado, las migraciones sirven para crear las tablas de la base de datos y las relaciones entre ellas sin tener que crear un archivo sql por cada tabla, de manera que podemos crear, modificar o eliminar tablas de la base de datos de una manera limpia y controlada y permite que todo el equipo de trabajo tenga la misma estructura de base de datos.

***5. Diferencia entre == y === en PHP. Da un ejemplo donde el resultado cambie.***

El operador == es un operador de igualdad débil que evalúa si dos operandos tienen el mismo valor. A diferencia de la igualdad estricta, este operador permite la coerción de tipos, lo que significa que el lenguaje intentará convertir los operandos a un tipo común antes de realizar la comparación.


```php
$texto = "1";
$numero = 1;

    if ($numero == $texto) {
    echo "Con == serian iguales\n"; 
}
```
El operador === realiza una comparación de identidad o igualdad estricta, validando que tanto el valor como el tipo de dato sean exactamente iguales

```php
$texto = "1"; // Tipo: String
$numero = 1;  // Tipo: Integer

if ($numero === $texto) {
    echo "Con == son iguales";
} else {
    echo "Con === NO son iguales";
}

deberia imprimir: Con === NO son iguales por lo que se ejecutaria el else.

```

***6. ¿Qué es Composer y cuál es la diferencia entre composer install y composer update? ***

Composer es el gestor de dependencias estándar para PHP. Su función principal es administrar las librerías externas que tu proyecto necesita para funcionar, asegurándose de que todas las versiones sean compatibles entre sí.

composer install se utiliza al descargar un proyecto por primera vez. Este comando lee el archivo composer.lock e instala las versiones exactas que están registradas allí. Su función es garantizar que todo el equipo de desarrollo y el servidor trabajen exactamente con las mismas versiones, por otro lado, composer update (composer.lock) se encarga de actualizar las dependencias a la version mas reciente que se tenga disponible en el archivo composer.json asegurandose que todos trabajen bajo las mismas versiones de las dependencias y no hayan conflictos.

***7. En Git, ¿cuál es la diferencia entre git pull y git fetch? ***

git fetch descarga los cambios del servidor remoto pero no los aplica al código. Es seguro porque solo actualiza el historial para que podamos ver que hay de nuevo. El git pull lo que hace es descargar y mezclar los cambios automáticamente en la rama rama en la que estamos posicionados. Es la combinación entre git fetch + git merge.
