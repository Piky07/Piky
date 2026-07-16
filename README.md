# Sistema de Gestión de Órdenes de Reparación - Taller de Maquinaria

Sistema profesional para gestión de órdenes de reparación en talleres de maquinaria amarilla y equipos rodantes.

## 🚀 Características

✅ **CRUD completo** de Órdenes de Reparación
✅ **Numeración automática** consecutiva de órdenes
✅ **Galería de fotos** (4 máximo por actividad)
✅ **Firma digital** con canvas
✅ **Historial de actividades** detallado
✅ **Dashboard** con estadísticas
✅ **API REST** escalable
✅ **Autenticación** con JWT
✅ **Docker** para desarrollo local
✅ **MySQL** como base de datos

## 📋 Campos de Orden de Reparación

- Número de orden (generado automáticamente)
- Fecha y hora de ingreso
- Código de equipo
- Descripción general
- Horometro / KM
- Ubicación del proyecto
- Descripción de falla general
- Estado (Pendiente, En Reparación, Completada, Entregada)
- Técnico asignado
- Actividades (múltiples)
  - Fotografías (máx 4 por actividad)
  - Descripción de actividad
  - Firma digital

## 🛠️ Stack Tecnológico

### Backend
- **Laravel 11** - Framework PHP moderno
- **MySQL 8.0** - Base de datos relacional
- **PHP 8.2+** - Lenguaje de programación

### Frontend
- **React 18** - Librería de UI
- **TypeScript** - Tipado estático
- **Tailwind CSS** - Estilos
- **Axios** - Cliente HTTP

### DevOps
- **Docker** - Containerización
- **Docker Compose** - Orquestación local

## 📦 Requisitos Previos

- Docker y Docker Compose instalados
- Git
- Navegador moderno

## 🚀 Instalación Rápida

### 1. Clonar repositorio
```bash
git clone https://github.com/Piky07/Piky.git
cd Piky
```

### 2. Crear archivo .env
```bash
cp backend/.env.example backend/.env
```

### 3. Iniciar con Docker Compose
```bash
docker-compose up -d
```

### 4. Generar clave de aplicación
```bash
docker-compose exec backend php artisan key:generate
```

### 5. Ejecutar migraciones
```bash
docker-compose exec backend php artisan migrate --seed
```

## 🌐 Acceso a la Aplicación

- **Frontend**: http://localhost:3000
- **Backend API**: http://localhost:8000
- **PhpMyAdmin**: http://localhost:8080 (opcional)

## 📚 Estructura del Proyecto

```
Piky/
├── backend/
│   ├── app/
│   │   ├── Models/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   └── Requests/
│   │   └── Services/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   ├── routes/
│   │   └── api.php
│   ├── storage/
│   ├── Dockerfile
│   └── .env.example
│
├── frontend/
│   ├── src/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── services/
│   │   ├── hooks/
│   │   └── App.tsx
│   ├── Dockerfile
│   └── .env.example
│
└── docker-compose.yml
```

## 🔌 API Endpoints

### Órdenes de Reparación
- `GET /api/ordenes` - Listar todas
- `POST /api/ordenes` - Crear nueva
- `GET /api/ordenes/{id}` - Obtener detalles
- `PUT /api/ordenes/{id}` - Actualizar
- `DELETE /api/ordenes/{id}` - Eliminar
- `POST /api/ordenes/{id}/actividades` - Agregar actividad
- `POST /api/ordenes/{id}/firmar` - Agregar firma

## 📖 Documentación

Ver carpetas específicas:
- `backend/README.md` - Documentación del backend
- `frontend/README.md` - Documentación del frontend

## 🤝 Contribuir

1. Crear una rama: `git checkout -b feature/nueva-funcionalidad`
2. Commit cambios: `git commit -am 'Agregar funcionalidad'`
3. Push: `git push origin feature/nueva-funcionalidad`
4. Pull Request

## 📝 Licencia

Proyecto privado para uso interno.

## ✉️ Contacto

Para soporte, contactar al equipo de desarrollo.
