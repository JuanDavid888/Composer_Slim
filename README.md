# `Migración` a PSR-4 con Composer Autoload

## Introducción

Tradicionalmente, se usan `require_once` o `include_once` para cargar archivos en PHP. Sin embargo, esto genera una alta dependencia del orden de carga, problemas de rendimiento y mantenibilidad.

La **alternativa moderna** es usar **autoloading PSR-4** con Composer, que carga automáticamente las clases según sus namespaces y ubicaciones.

------

## Step by Step 🗿

### 1. Crear `composer.json` si no existe ejecutando el comando

```bash
composer init --name=app/api-psr4 --no-interaction
```

Este comando le dice a Composer que:

- Cree un archivo `composer.json`
- Establezca metadatos básicos del proyecto: como el nombre, autor u otros.

Edita tu `composer.json` y agrega la clave `"autoload"` con el estándar PSR-4 :

```json
{
  "name": "app/api-psr4",
  "autoload": {
    "psr-4": {
      "App\\": "src/"
    }
  },
  "require": {}
}
```

La key `"autoload"` le indica a Composer que:

- Usará el estándar **PSR-4** para cargar clases automáticamente

- Asociará el **namespace raíz** `App\` con la **carpeta física** `src/`

  > Ten presente los `\` con respecto de los `/`, además de tener presente el lower case de las carpetas.

El archivo `composer.json` final:

```json
{
  "name": "app/api-psr4",
  "autoload": {
    "psr-4": {
      "App\\": "src/"
    }
  },
  "require": {
    "ext-pdo": "*" //Agregar PDO
  }
}
```

Si instala una dependencia como ej. `phpunit` : 

```json
composer require --dev phpunit/phpunit ^10.5.48
```

El archivo `composer.json` final:

```json
{
  "require-dev": {
    "phpunit/phpunit": "^10.5.48"
  },
  "require": {
    "ext-pdo": "*"
  },
  "autoload": {
    "psr-4": {
      "App\\":"src/"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "Tests\\":"tests/"
    }
  }
}

```

Adémas de crear de instalar la dependencia de `phpunit` en el directorio de `vendor`.
```text
/index.php
/composer.json
/vendor/
/src/
│
├── route.php
├── api.php
```

Si clonaste el proyecto o si el archivo `composer.json` ya existe, se requiere de instalar todas las dependencias:
```bash
composer install
```

Esto descarga todas las dependencias, incluyendo `phpunit/phpunit` dentro de `/vendor`.

------

### 2. Estructurar tu proyecto con namespaces y rutas consistentes

Tu estructura debe verse así:

```pgsql
/index.php
/src/
│
├── route.php                --> App\Route
├── api.php                 --> App\Api
├── core/
│   └── DatabasePDO.php     --> App\core\DatabasePDO
├── models/
│   └── Camper.php          --> App\models\Camper
├── http/
│   ├── controllers/
│   │   ├── CrudController.php       --> App\http\controllers\CrudController
│   │   ├── CamperController.php     --> App\http\controllers\CamperController
│   │   └── ProductoController.php   --> App\http\controllers\ProductoController
│   └── factories/
│       └── ControllerFactory.php    --> App\http\factories\controllerFactory
```

------

### 3. Agregar los namespaces en cada archivo PHP

Ejemplo para `CamperController.php`:

```php
<?php

namespace App\http\controllers;

use App\repositories\CamperRepository;
use App\models\Camper;
```

Ejemplo para `Route.php`:

```php
<?php

namespace App;

use App\http\factories\ControllerFactory;
```

------

### 4. Eliminar todos los `include_once` / `require_once`

Ejemplo antes:

```php
require_once "src/http/controllers/CamperController.php";
```

Después:

```php
use App\http\controllers\CamperController;
```

> El `use` **no carga archivos** como `require_once`, sino que **le dice al autoload dónde buscar la clase por PSR-4**.

------

### 5. Ejecutar el autoload de Composer

Después de agregar los namespaces, ejecuta el comando:

```bash
composer dump-autoload
```

Esto generará el archivo `vendor/autoload.php`.

------

### 6. Reemplazar `require_once` por el autoload de Composer en `index.php`

```php
<?php
require_once 'vendor/autoload.php';

use App\Route;

// Aquí empieza lo chido del API
$route = new Route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
$route->handle();
```

------

## Comparación: `require_once` vs `use` con Autoload

| Concepto              | `require_once`          | `use` + Autoload (PSR-4)                    |
| --------------------- | ----------------------- | ------------------------------------------- |
| Carga explícita       | Sí                      | No (delegado a Composer)                    |
| Importacion del orden | Sí                      | No (automático)                             |
| Mantenibilidad        | Baja (mucha repetición) | Alta (estructura limpia)                    |
| Refactorización       | Tediosa                 | Fácil (IDE puede ayudarte + si es PhpStorm) |
| Nombres de clases     | No controlados          | Estructura jerárquica por namespace         |
| Rendimiento (escala)  | Degrada al crecer       | Optimizado por Composer                     |

------

## Beneficios de usar PSR-4 con Composer

> Buenas practicas como le gustan a Santiago

- Carga automática de clases 🤓
- Código más limpio y organizado
- Escalabilidad y mantenibilidad 🗿
- Integración con herramientas modernas (PHPUnit, Laravel y etc.)
- Facilita el trabajo en equipo y colaboración (Lo que no existe en los exámenes).

------

## Resultado final en `index.php`

> También se puede definir logíca para el `api.php` o implementar el `handle` de `Route`.

```php
<?php

require_once '/vendor/autoload.php';

use App\Route;

$route = new Route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
$route->handle();
```

------

## Actividad

Migrar tu código de la actividad de PHP PDO en donde se usa `require_once` a un sistema **basado en namespaces PSR-4 y autoload** con Composer, además de terminar y ajustar todo a lo que llevamos en clase. 🧑🏼‍🚀