# Backend - Sistema de Gestión de Órdenes de Reparación

API REST construida con Laravel 11 para gestión de órdenes de reparación.

## 🚀 Instalación Local (sin Docker)

### Requisitos
- PHP 8.2+
- Composer
- MySQL 8.0+

### Pasos

1. **Instalar dependencias**
```bash
cd backend
composer install
```

2. **Configurar .env**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Configurar base de datos**
```bash
# Editar .env con datos de tu MySQL local
DB_HOST=localhost
DB_DATABASE=taller_db
DB_USERNAME=root
DB_PASSWORD=
```

4. **Ejecutar migraciones**
```bash
php artisan migrate:fresh --seed
```

5. **Iniciar servidor**
```bash
php artisan serve
```

El servidor estará en `http://localhost:8000`

## 📊 Base de Datos

### Tablas Principales

- **ordenes_reparacion** - Órdenes maestras
- **actividades** - Actividades por orden
- **fotos_actividades** - Fotos asociadas a actividades
- **firmas** - Firmas digitales de órdenes
- **equipos** - Equipos/vehículos
- **tecnicos** - Técnicos del taller
- **usuarios** - Usuarios del sistema

## 🔌 Endpoints de API

### Órdenes de Reparación

#### Listar todas las órdenes
```
GET /api/ordenes
Parámetros query:
  - estado: filtrar por estado
  - paginate: número de resultados por página (default: 15)
```

#### Crear nueva orden
```
POST /api/ordenes
Body (JSON):
{
  "codigo_equipo": "EXC-001",
  "descripcion_general": "Revisión de motor",
  "horometro": 1500,
  "km": null,
  "ubicacion_proyecto": "Obra Central",
  "descripcion_falla": "Ruido anormal en motor",
  "tecnico_id": 1
}
```

#### Obtener detalles de orden
```
GET /api/ordenes/{id}
```

#### Actualizar orden
```
PUT /api/ordenes/{id}
Body (JSON): campos a actualizar
```

#### Eliminar orden
```
DELETE /api/ordenes/{id}
```

#### Agregar actividad a orden
```
POST /api/ordenes/{id}/actividades
Body (JSON):
{
  "descripcion": "Cambio de aceite y filtro",
  "duracion_horas": 2
}
```

#### Agregar firma a orden
```
POST /api/ordenes/{id}/firmar
Body (JSON):
{
  "firma_base64": "data:image/png;base64,..."
}
```

#### Subir foto de actividad
```
POST /api/ordenes/{orden_id}/actividades/{actividad_id}/fotos
Body (multipart/form-data):
  - foto: archivo de imagen (max 5MB)
```

## 🗂️ Estructura de Carpetas

```
backend/
├── app/
│   ├── Models/
│   │   ├── OrdenReparacion.php
│   │   ├── Actividad.php
│   │   ├── FotoActividad.php
│   │   ├── Firma.php
│   │   ├── Equipo.php
│   │   ├── Tecnico.php
│   │   └── User.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── OrdeneReparacionController.php
│   │   │   ├── ActividadController.php
│   │   │   └── AuthController.php
│   │   └── Requests/
│   │       ├── StoreOrdenRequest.php
│   │       └── UpdateOrdenRequest.php
│   └── Services/
│       ├── OrdenService.php
│       └── FotoService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── api.php
└── storage/
    └── app/
        └── uploads/
            └── fotos/
```

## 🔐 Autenticación

Las rutas protegidas requieren:
```
Authorization: Bearer {token}
```

## 🎯 Características Implementadas

- ✅ CRUD de órdenes de reparación
- ✅ Numeración automática consecutiva
- ✅ Gestión de actividades
- ✅ Carga de fotos (máx 4 por actividad)
- ✅ Firma digital
- ✅ Validaciones robustas
- ✅ Manejo de errores
- ✅ Paginación

## 📝 Seeding de Datos

Para cargar datos de prueba:
```bash
php artisan migrate:fresh --seed
```

Esto cargará:
- 5 técnicos
- 10 equipos
- 5 órdenes de ejemplo

## 🚨 Troubleshooting

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000]: General error"
Asegúrate que MySQL está corriendo y la base de datos existe.

### Error al migrar
```bash
php artisan migrate:refresh
php artisan migrate --seed
```

## 📚 Documentación de Modelos

Ver comentarios en cada archivo de modelo para entender relaciones y métodos disponibles.
