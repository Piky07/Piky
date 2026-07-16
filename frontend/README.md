# Frontend - Sistema de Gestión de Órdenes de Reparación

Aplicación React para gestión de órdenes de reparación en talleres.

## 🚀 Instalación Local (sin Docker)

### Requisitos
- Node.js 16+
- npm o yarn

### Pasos

1. **Instalar dependencias**
```bash
cd frontend
npm install
```

2. **Configurar .env**
```bash
cp .env.example .env
# Editar con URLs correctas
```

3. **Iniciar servidor de desarrollo**
```bash
npm start
```

Abrirá automáticamente `http://localhost:3000`

## 📦 Dependencias Principales

- **React 18** - Librería de UI
- **TypeScript** - Tipado estático
- **Tailwind CSS** - Estilos
- **Axios** - Cliente HTTP
- **React Router** - Enrutamiento
- **React Query** - Gestión de datos
- **Lucide Icons** - Iconos
- **React Signature Canvas** - Firma digital
- **React Hot Toast** - Notificaciones

## 🗂️ Estructura de Carpetas

```
frontend/src/
├── components/
│   ├── Layout/
│   │   ├── Sidebar.tsx
│   │   ├── Header.tsx
│   │   └── Layout.tsx
│   ├── Ordenes/
│   │   ├── OrdenForm.tsx
│   │   ├── OrdenCard.tsx
│   │   ├── OrdenList.tsx
│   │   └── OrdenDetail.tsx
│   ├── Actividades/
│   │   ├── ActividadForm.tsx
│   │   └── ActividadList.tsx
│   ├── Galeria/
│   │   ├── GaleriaFotos.tsx
│   │   └── UploadFoto.tsx
│   └── Firma/
│       └── FirmaDigital.tsx
├── pages/
│   ├── Dashboard.tsx
│   ├── OrdenesPage.tsx
│   ├── OrdenDetailPage.tsx
│   ├── CrearOrdenPage.tsx
│   └── NotFound.tsx
├── services/
│   ├── api.ts
│   ├── ordenService.ts
│   ├── actividadService.ts
│   └── fotoService.ts
├── hooks/
│   ├── useOrdenes.ts
│   ├── useActividades.ts
│   └── useFotos.ts
├── types/
│   └── index.ts
├── utils/
│   ├── formatters.ts
│   └── validators.ts
├── App.tsx
└── index.css
```

## 🎨 Componentes Principales

### Sidebar
- Navegación principal
- Menú colapsible
- Links a módulos

### Dashboard
- Resumen de órdenes
- Estadísticas
- Órdenes recientes

### Órdenes
- Listar todas las órdenes
- Crear nueva orden
- Ver detalles
- Editar orden
- Eliminar orden

### Actividades
- Agregar actividades a orden
- Listar actividades
- Editar actividad

### Galería de Fotos
- Subir máximo 4 fotos
- Vista previa
- Eliminar foto

### Firma Digital
- Canvas para firmar
- Guardar firma
- Limpiar canvas

## 🔌 Servicios API

Los servicios en `src/services/` manejan la comunicación con el backend:

```typescript
// ordenService.ts
export const ordenService = {
  getAll: () => GET /api/ordenes
  getById: (id) => GET /api/ordenes/{id}
  create: (data) => POST /api/ordenes
  update: (id, data) => PUT /api/ordenes/{id}
  delete: (id) => DELETE /api/ordenes/{id}
}

// actividadService.ts
export const actividadService = {
  add: (ordenId, data) => POST /api/ordenes/{id}/actividades
  update: (ordenId, actividadId, data) => PUT
  delete: (ordenId, actividadId) => DELETE
}

// fotoService.ts
export const fotoService = {
  upload: (ordenId, actividadId, file) => POST multipart/form-data
  delete: (fotoId) => DELETE /api/fotos/{id}
}
```

## 🎯 Flujo de Uso

1. **Dashboard** - Ver resumen
2. **Crear Orden** - Nueva orden de reparación
3. **Agregar Actividades** - Detallar trabajos realizados
4. **Subir Fotos** - Máximo 4 fotos por actividad
5. **Firmar Orden** - Firma digital del técnico
6. **Guardar** - Orden completada

## 🎨 Temas y Estilos

- Tailwind CSS para estilos
- Colores personalizados en `tailwind.config.js`
- Componentes reutilizables
- Responsive design

## 🧪 Desarrollo

### Scripts disponibles

```bash
npm start          # Inicia dev server
npm run build      # Build para producción
npm test           # Ejecuta tests
npm run lint       # Ejecuta linter
npm run eject      # Eject de CRA (no reversible)
```

## 📝 Variables de Entorno

```
REACT_APP_API_URL = URL base de la API
```

## 🚨 Troubleshooting

### Error: "Cannot GET /"
Asegúrate que el backend está corriendo en `http://localhost:8000`

### Error: "CORS error"
Verifica la configuración CORS en el backend

### Error: "Cannot find module"
```bash
npm install
```

### Node modules corruptos
```bash
rm -rf node_modules package-lock.json
npm install
```

## 📚 Recursos Útiles

- [React Docs](https://react.dev)
- [TypeScript Docs](https://www.typescriptlang.org)
- [Tailwind CSS](https://tailwindcss.com)
- [Axios Docs](https://axios-http.com)

## 🤝 Contribuir

1. Crear rama: `git checkout -b feature/nueva-funcionalidad`
2. Commit: `git commit -m "Agregar funcionalidad"`
3. Push: `git push origin feature/nueva-funcionalidad`
4. PR al `develop`
