# PetShop Laravel

Tienda ecommerce de mascotas construida con Laravel + Blade. Incluye catálogo, categorías, detalle de producto, carrito en sesión y checkout básico que registra pedidos en la base de datos.

## Requisitos
- PHP 8.2+
- Composer
- Laravel 12
- MySQL / MariaDB o SQLite

## Instalación

1. Crea un proyecto Laravel:
   ```bash
   composer create-project laravel/laravel petshop
   ```
2. Descomprime este paquete dentro de `petshop/`, permitiendo sobrescribir `routes/web.php`.
3. Configura `.env` y la base de datos. Para MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=petshop
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Ejecuta:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   php artisan serve
   ```
5. Abre http://127.0.0.1:8000

## Funcionalidad
- Página principal con productos destacados.
- Catálogo con filtro por categoría y búsqueda.
- Ficha de producto.
- Carrito guardado en sesión (agregar, actualizar y eliminar).
- Checkout sencillo y persistencia de pedidos.
- Diseño responsive.

## Notas importantes
Este proyecto es una base funcional para desarrollo local. El checkout **no procesa pagos** ni calcula envíos/impuestos. Antes de producción agrega una pasarela de pago, validaciones y políticas de inventario, autenticación/administración, protección antifraude, pruebas, HTTPS y configuración de correo.
