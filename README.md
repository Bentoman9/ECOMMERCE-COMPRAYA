# 🛒 COMPRAYA — Plataforma Web E-Commerce y Gestión Logística
![PHP](https://img.shields.io/badge/PHP-v8.2%2B-777BB4?style=flat&logo=php)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-v4.x-EF4223?style=flat&logo=codeigniter)
![MySQL](https://img.shields.io/badge/MySQL-v8.0-4479A1?style=flat&logo=mysql)

![Bootstrap](https://img.shields.io/badge/Bootstrap-v5.3-7952B3?style=flat&logo=bootstrap)
COMPRAYA es una solución web integral de comercio electrónico que combina una tienda en línea para el cliente final con un sistema centralizado para la administración de inventario y el seguimiento logístico de envíos en tiempo real.
---
## 🚀 Características Principales
* **Control de Acceso Basado en Roles (RBAC):** Autenticación y autorización mediante filtros de sesión nativos de CodeIgniter 4 para 4 perfiles diferenciados:
  * **Administrador:** Gestión total de usuarios, asignación de roles e indicadores económicos.
  * **Gestor de Inventario:** Control operativo del catálogo (CRUD de productos/categorías) y reportes de ventas.
  * **Gestor de Logística / Repartidor:** Módulo adaptable a dispositivos móviles para actualizar estados de envío (*En preparación*, *En camino*, *Entregado*).
  * **Cliente:** Navegación por catálogo, gestión de carrito interactivo y confirmación de pedidos.
* **Control de Inventario Automatizado:** Deducción en tiempo real del stock físico en la base de datos tras la confirmación de cada orden de compra.
* **Persistencia en Cliente:** Carrito de compras desacoplado gestionado vía `localStorage` y procesamiento de órdenes asíncrono con peticiones AJAX/Fetch.
* **Seguridad:** Encriptación de contraseñas mediante el algoritmo `PASSWORD_BCRYPT` y mitigación de inyecciones SQL mediante el Query Builder de CodeIgniter 4.
---
## 🛠️ Stack Tecnológico

| Capa | Tecnología |
| :--- | :--- |
| **Backend** | PHP 8.2+ |
| **Framework Web** | CodeIgniter 4 (Patrón MVC) |
| **Base de Datos** | MySQL 8.0 (vía XAMPP / Apache) |
| **Frontend** | HTML5, CSS3, JavaScript (ES6+), Bootstrap 5 |

---
## 🗄️ Arquitectura de la Base de Datos
El diseño de la base de datos relacional consta de **5 tablas principales** articuladas mediante restricciones estrictas de integridad referencial (`FOREIGN KEY`):
* `usuarios`: Gestión de credenciales y roles (`ENUM`).
* `categorias`: Agrupación maestra de productos.
* `productos`: Control de stock, precios y archivos multimedia.
* `pedidos`: Cabecera de la orden y estado del ciclo de vida logístico.
* `detalle_pedidos`: Tabla asociativa ($N:M$) que desglose los artículos e historial de precios.
---
## ⚙️ Instalación y Configuración Local
1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/Bentoman9/ECOMMERCE-COMPRAYA.git](https://github.com/Bentoman9/ECOMMERCE-COMPRAYA.git)
   cd ECOMMERCE-COMPRAYA
