# Modelo relacional preliminar - EDUTOOLS

## 1. Descripción general

EDUTOOLS es una plataforma digital para un centro educativo privado. Su objetivo es permitir el control académico y administrativo mediante módulos de usuarios, alumnos, padres o tutores, docentes, cursos, grados, secciones, inscripciones, notas, asistencia, calendario académico, dashboard institucional y portal para padres.

Este modelo relacional será implementado en Laravel 11 usando migraciones, seeders, factories y MySQL.

---

## 2. Tablas principales del sistema

### 2.1 users

Tabla utilizada para autenticación, roles y control de acceso al sistema.

Campos principales:

- id
- name
- email
- password
- role
- is_active
- email_verified_at
- remember_token
- timestamps

Roles previstos:

- admin
- docente
- padre
- secretaria

---

### 2.2 students

Tabla para registrar alumnos.

Campos principales:

- id
- first_name
- last_name
- birth_date
- gender
- student_code
- phone
- address
- is_active
- timestamps

Relaciones:

- Un alumno puede tener uno o varios tutores.
- Un alumno puede tener varias inscripciones.
- Un alumno puede tener varios registros de notas.
- Un alumno puede tener varios registros de asistencia.

---

### 2.3 guardians

Tabla para registrar padres de familia o tutores.

Campos principales:

- id
- user_id
- first_name
- last_name
- dpi
- phone
- address
- relationship
- is_active
- timestamps

Relaciones:

- Un tutor puede estar vinculado a un usuario del sistema.
- Un tutor puede estar relacionado con uno o varios alumnos.

---

### 2.4 guardian_student

Tabla intermedia para relacionar alumnos con padres o tutores.

Campos principales:

- id
- guardian_id
- student_id
- is_primary
- timestamps

Relaciones:

- Pertenece a guardians.
- Pertenece a students.

---

### 2.5 teachers

Tabla para registrar docentes.

Campos principales:

- id
- user_id
- first_name
- last_name
- dpi
- phone
- specialty
- hire_date
- is_active
- timestamps

Relaciones:

- Un docente puede estar vinculado a un usuario del sistema.
- Un docente puede impartir varios cursos.

---

### 2.6 grades

Tabla para registrar grados académicos.

Campos principales:

- id
- name
- level
- description
- is_active
- timestamps

Ejemplos:

- Primero Básico
- Segundo Básico
- Tercero Básico
- Cuarto Bachillerato
- Quinto Bachillerato

Relaciones:

- Un grado puede tener varias secciones.
- Un grado puede tener varios cursos.

---

### 2.7 sections

Tabla para registrar secciones.

Campos principales:

- id
- grade_id
- name
- capacity
- is_active
- timestamps

Ejemplos:

- A
- B
- C

Relaciones:

- Una sección pertenece a un grado.
- Una sección puede tener varias inscripciones.

---

### 2.8 courses

Tabla para registrar cursos.

Campos principales:

- id
- grade_id
- teacher_id
- name
- code
- description
- is_active
- timestamps

Ejemplos:

- Matemática
- Comunicación y Lenguaje
- Ciencias Naturales
- Estudios Sociales
- Computación

Relaciones:

- Un curso pertenece a un grado.
- Un curso puede estar asignado a un docente.
- Un curso puede tener registros de notas.

---

### 2.9 enrollments

Tabla para registrar inscripciones de alumnos.

Campos principales:

- id
- student_id
- grade_id
- section_id
- academic_year
- enrollment_date
- status
- timestamps

Estados posibles:

- activo
- retirado
- promovido
- suspendido

Relaciones:

- Una inscripción pertenece a un alumno.
- Una inscripción pertenece a un grado.
- Una inscripción pertenece a una sección.

---

### 2.10 grade_records

Tabla para registrar notas de alumnos.

Campos principales:

- id
- student_id
- course_id
- teacher_id
- academic_year
- term
- score
- comments
- timestamps

Relaciones:

- Una nota pertenece a un alumno.
- Una nota pertenece a un curso.
- Una nota puede estar asociada a un docente.

---

### 2.11 attendance_records

Tabla para registrar asistencia.

Campos principales:

- id
- student_id
- course_id
- teacher_id
- attendance_date
- status
- comments
- timestamps

Estados posibles:

- presente
- ausente
- tarde
- justificado

Relaciones:

- Un registro de asistencia pertenece a un alumno.
- Un registro de asistencia pertenece a un curso.
- Un registro de asistencia puede estar asociado a un docente.

---

### 2.12 academic_calendar_events

Tabla para registrar eventos del calendario académico.

Campos principales:

- id
- title
- description
- event_date
- start_time
- end_time
- event_type
- is_active
- timestamps

Tipos de evento:

- examen
- reunión
- feriado
- actividad
- entrega

---

## 3. Tablas extra recomendadas para fases posteriores

### 3.1 assignments

Tabla para tareas en línea.

Campos principales:

- id
- course_id
- teacher_id
- title
- description
- due_date
- is_active
- timestamps

---

### 3.2 certificates

Tabla para constancias PDF.

Campos principales:

- id
- student_id
- certificate_type
- issued_at
- file_path
- timestamps

---

### 3.3 qr_attendance_tokens

Tabla para asistencia con código QR.

Campos principales:

- id
- course_id
- teacher_id
- token
- valid_until
- used_at
- timestamps

---

## 4. Relaciones principales

- users puede relacionarse con guardians.
- users puede relacionarse con teachers.
- students se relaciona con guardians mediante guardian_student.
- students se relaciona con enrollments.
- grades tiene muchas sections.
- grades tiene muchos courses.
- sections pertenece a grades.
- courses pertenece a grades.
- courses puede pertenecer a teachers.
- enrollments pertenece a students, grades y sections.
- grade_records pertenece a students, courses y teachers.
- attendance_records pertenece a students, courses y teachers.
- academic_calendar_events funciona como módulo institucional.

---

## 5. Módulos mínimos cubiertos

Este modelo cubre los módulos mínimos requeridos:

- Usuarios
- Inscripciones
- Alumnos
- Padres/tutores
- Docentes
- Cursos
- Grados y secciones
- Ingreso de notas
- Asistencia
- Calendario académico
- Dashboard institucional
- Portal para padres de familia

---

## 6. Observación técnica

La implementación se hará con migraciones Laravel, llaves primarias, llaves foráneas, integridad referencial, seeders y datos ficticios realistas usando Faker.