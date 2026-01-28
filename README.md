**UTREBYTES – Gestión de Servicios y Solicitudes**

Este proyecto consiste en una aplicación web para la gestión de servicios tecnológicos y solicitudes de clientes, desarrollada con HTML, CSS, JavaScript y PHP, utilizando una API REST y una base de datos MySQL.

La aplicación permite a los usuarios consultar los servicios disponibles, enviar solicitudes y a los administradores gestionar el estado de dichas solicitudes de forma sencilla e intuitiva.

**Funcionalidades principales**
**Catálogo de Servicios**

La aplicación cuenta con una página principal donde se muestra un catálogo de servicios disponibles. Cada servicio se presenta en formato card, mostrando:

Nombre del servicio

Descripción breve

Categoría

Icono representativo

El diseño es responsive y cada servicio incluye un botón “Solicitar Servicio” que redirige al formulario de solicitud.

**Formulario de Solicitud**

El formulario permite al usuario enviar una solicitud de servicio rellenando los siguientes campos:

Selección del servicio mediante un desplegable

Empresa o cliente

Email de contacto

Teléfono, con validación de exactamente 9 dígitos

Descripción de la necesidad

Prioridad (Baja, Media o Alta)

El formulario incluye validación básica de campos obligatorios, muestra un mensaje de confirmación tras el envío correcto y dispone de un enlace para acceder a la vista de administración.

**Lista de Solicitudes**

La aplicación permite visualizar todas las solicitudes registradas, mostrando:

ID de la solicitud

Servicio solicitado

Empresa o cliente

Prioridad

Estado de la solicitud

Desde esta vista se puede acceder a la sección de administración.

**Vista Admin – Gestión de Solicitudes**

La vista de administración permite:

Ver el listado completo de solicitudes

Cambiar el estado de cada solicitud mediante un selector

Estados disponibles: Pendiente, En proceso y Completada

Actualizar el estado mediante la API

Mostrar feedback visual cuando el estado se actualiza correctamente

El diseño de esta vista es limpio y orientado a un uso administrativo.

**Estructura del proyecto**

El proyecto se organiza de la siguiente manera:

api/: contiene la configuración y los endpoints de la API

config.php

servicios.php

solicitudes.php

css/: hojas de estilo separadas por página

index.css

solicitud.css

admin.css

js/: scripts JavaScript de cada vista

app.js

solicitud.js

admin.js

database/

schema.sql (estructura de la base de datos y datos de prueba)

index.html

solicitud.html

admin.html

**Tecnologías utilizadas**
Frontend

HTML5

CSS3 (diseño responsive)

JavaScript (ES6)

Tipografía: Lexend

Backend

PHP

API REST

MySQL

PDO

**Instalación y ejecución del proyecto**

Clonar el repositorio desde GitHub en tu equipo local.

Utilizar un servidor local como XAMPP, WAMP o Laragon y copiar el proyecto dentro de la carpeta correspondiente (por ejemplo, htdocs en XAMPP).

Importar la base de datos:

Abrir phpMyAdmin

Crear una base de datos (por ejemplo, utrebytes)

Importar el archivo database/schema.sql

Configurar la conexión a la base de datos:

Editar el archivo api/config.php

Ajustar los datos de conexión (host, nombre de la base de datos, usuario y contraseña)

Ejecutar la aplicación:

Iniciar Apache y MySQL desde el panel de control

Acceder desde el navegador a la página principal del proyecto (index.html)

**Validaciones implementadas**

Campos obligatorios en el formulario

Validación de email

Validación de teléfono (exactamente 9 dígitos)

Control de estados de solicitudes desde el backend

**Autora**

Isabel Curado España
Técnica en Desarrollo de Aplicaciones Web