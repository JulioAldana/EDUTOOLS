# Guía de ejecución — EDUTOOLS

## Proyecto

EDUTOOLS esta plataforma fue creada por el grupo del 5to Ciclo de Progra III 2026

## Ruta local del proyecto

```powershell
C:\ProyectosLaravel\edutools-f
Tecnologías usadas
Laravel 11
PHP 8.2.12
MySQL Server 8.0
Laravel Breeze con Blade
Bootstrap
Bootstrap Icons
ApexCharts
JavaScript normal
Vite
Git
Visual Studio Code
Base de datos

Base oficial:

DB_DATABASE=edutools_f
DB_USERNAME=edutools_f_user
DB_PASSWORD=EdutoolsF_2026

Motor usado:

MySQL Server 8.0
Servicio: MySQL80
Puerto: 3306
Comandos principales

Entrar al proyecto:

cd C:\ProyectosLaravel\edutools-f

Levantar servidor Laravel:

php artisan serve

Compilar frontend:

npm run build

Limpiar caché si algo no actualiza:

php artisan optimize:clear

Optimizar para pruebas finales:

php artisan optimize

Ejecutar migraciones:

php artisan migrate

Ejecutar seeders:

php artisan db:seed
Usuarios de demostración
Administrador
Correo: admin@edutools.test
Contraseña: EdutoolsF_2026
Ruta: /dashboard
Portal familiar
Correo: portal.familiar@edutools.test
Contraseña: EdutoolsF_2026
Ruta: /portal/dashboard
Módulos implementados
Autenticación
Roles
Usuarios activos/inactivos
Dashboard administrativo
Estudiantes
Padres/Tutores
Docentes
Cursos
Grados
Secciones
Inscripciones
Notas
Asistencia
Calendario académico
Portal para padres de familia
Reglas importantes
No usar migrate:fresh sin autorización.
No usar XAMPP como base principal. Si viene de XAMPP pero no como local. 
La base oficial es MySQL Server 8.0.
El proyecto usa Blade, Bootstrap, Bootstrap Icons, ApexCharts y JavaScript normal.