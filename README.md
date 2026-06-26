# proyecto-4to

Aplicación web en PHP para gestión básica de una escuela de conducción.

## Requisitos

- PHP 8.0 o superior
- MySQL o MariaDB
- Servidor web local como XAMPP, WAMP, Laragon o similar

## Configuración

1. Crea la base de datos ejecutando [database.sql](database.sql).
2. Copia [.env.example](.env.example) a `.env` si quieres usar variables de entorno.
3. Ajusta los datos de conexión en `.env` o deja los valores por defecto de [connection.php](connection.php).
4. Abre `index.php` desde tu servidor local.

## Estructura

- [index.php](index.php): pantalla de inicio de sesión.
- [dashboard.php](dashboard.php): panel principal.
- [connection.php](connection.php): conexión a MySQL.
- [register_client.php](register_client.php), [update_client.php](update_client.php), [delete_client.php](delete_client.php): operaciones de clientes.
- [register_course.php](register_course.php) y [agenda.php](agenda.php): registro de cursos y agenda.
- [register_attendance.php](register_attendance.php): registro de asistencia.


