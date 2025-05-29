
---

### 🛠️ FACPRO - Backend (`README.md` para el repositorio PHP + MySQL)

```markdown
# 💼 FACPRO - Backend

Este es el backend del sistema FACPRO, una aplicación de facturación, inventario y contabilidad desarrollada para pequeñas y medianas empresas. Construido con PHP y MySQL, expone endpoints que permiten la gestión de productos, usuarios, proveedores, ventas y más.

---

## 🚀 Tecnologías Utilizadas

- 🐘 **PHP (v7+)** – Lógica del servidor y API REST.
- 🗃️ **MySQL** – Base de datos relacional.
- 🌐 **JSON** – Comunicación entre backend y frontend.
- 🔒 **CORS / Headers personalizados** – Permitir acceso desde Angular.

---

## 🎯 Funcionalidades

- CRUD completo de:
  - 🧾 Productos
  - 🧍 Proveedores / Clientes
  - 💼 Usuarios
  - 🛒 Compras / Ventas
- 📥 Almacenamiento de registros contables.
- 📊 Reportes y consultas filtradas.
- 🔄 Integración con el frontend Angular (CORS habilitado).

---

## 📁 Estructura del Proyecto

```plaintext
facpro-backend/
├── config/
│   └── database.php       # Conexión a MySQL
├── controllers/
│   └── *.php              # Lógica de cada entidad (productos, clientes...)
├── models/
│   └── *.php              # Consultas y operaciones DB
├── api/
│   └── routes.php         # Rutas principales
├── utils/
│   └── response.php       # Formato de respuesta JSON
├── .htaccess              # Configuración para Apache
├── index.php              # Punto de entrada
