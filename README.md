# CRUD de Alojamientos: Gestión de Usuarios y Administrador
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white) ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white) ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
<hr/>

1. Landing Page de Alojamientos: ✓ <br/>
Página principal atractiva que muestra todos los alojamientos precargados desde la base de datos <br/>
Diseño moderno y responsivo con Bootstrap 5 <br/>
Información completa de cada alojamiento (nombre, descripción, precio, ubicación, imagen) <br/>

2. Crear Cuenta e Iniciar Sesión: ✓ <br/>
Sistema completo de autenticación con registro y login <br/>
Validación robusta tanto en cliente como servidor <br/>
Encriptación segura de contraseñas con password_hash() <br/>
Manejo de sesiones PHP <br/>

3. Vista de Cuenta de Usuario: ✓ <br/>
Dashboard personalizado después del login <br/>
Los usuarios pueden seleccionar alojamientos libremente <br/>
Vista separada de alojamientos seleccionados vs disponibles <br/>
Interfaz intuitiva con contadores y badges <br/>

4. Función de Eliminar Alojamientos: ✓ <br/>
Los usuarios pueden eliminar alojamientos de su cuenta personal <br/>
Confirmación antes de eliminar <br/>
Sistema de mensajes de éxito/error <br/>
No afecta la base de datos principal de alojamientos <br/>

5. Usuario Administrador: ✓ <br/>
Panel especial para administradores <br/>
Solo pueden agregar nuevos alojamientos (no eliminar) <br/>
Formulario completo con validación <br/>
Vista de todos los alojamientos registrados <br/>
Usuario admin precargado: admin@admin.com / password <br/>

<hr/>

### 🏗️ Arquitectura MVC Implementada <br/>
La aplicación sigue estrictamente el patrón MVC: <br/>
Models: Usuario, Alojamiento, UsuarioAlojamiento <br/>
Views: Layouts comunes, vistas por módulo (home, auth, user, admin) <br/>
Controllers: HomeController, AuthController, UserController, AdminController <br/>
Config: Database (singleton) Configuración centralizada de base de datos <br/>
 <br/>
### 🎨 Características de Diseño <br/>
Diseño moderno y responsivo con Bootstrap 5 <br/>
Gradientes y animaciones para una experiencia visual atractiva <br/>
Iconografía consistente con Font Awesome <br/>
Paleta de colores profesional con CSS custom properties <br/>
Micro-interacciones y efectos hover <br/>
Validación visual en tiempo real <br/>
Mensajes de estado elegantes <br/>
 <br/>
### 📱 Características Adicionales <br/>
Animaciones suaves con Intersection Observer <br/>
Tooltips informativos con Bootstrap <br/>
Indicador de fuerza de contraseña en registro <br/>
Contadores dinámicos y badges informativos <br/>
Floating Action Buttons para mejor UX <br/>
 <br/>
### 🗄️ Base de Datos <br/>
La estructura MySQL incluye: <br/>
Tabla usuarios (con tipos admin/usuario) <br/>
Tabla alojamientos (datos principales) <br/>
Tabla usuario_alojamientos (relación muchos a muchos) <br/>
Datos de prueba precargados <br/>
Índices y restricciones de integridad <br/>
