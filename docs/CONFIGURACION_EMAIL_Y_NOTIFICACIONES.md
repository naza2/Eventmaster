# 📧 CONFIGURACIÓN DE EMAILS Y NOTIFICACIONES

## ✅ LO QUE YA ESTÁ HECHO:

1. ✅ Sistema completo de invitaciones funcionando
2. ✅ Emails con botones de Aceptar/Rechazar
3. ✅ Notificaciones en base de datos
4. ✅ Campana de notificaciones en navbar con contador
5. ✅ Auto-agregar al equipo al aceptar invitación

---

## ⚙️ LO QUE NECESITAS CONFIGURAR:

### 1. Activar extensiones de PHP (OBLIGATORIO)

**Si usas XAMPP:**

1. Abre el archivo `php.ini`:
   - Ve a: `C:\xampp\php\php.ini`
   - Ábrelo con Notepad++

2. Busca estas líneas y **quita el punto y coma (;)** al inicio:
   ```ini
   ;extension=pdo_mysql
   ;extension=mysqli
   ;extension=mbstring
   ```

   Deben quedar así:
   ```ini
   extension=pdo_mysql
   extension=mysqli
   extension=mbstring
   ```

3. Guarda el archivo

4. **Reinicia Apache** desde el panel de XAMPP

---

### 2. Configurar Gmail SMTP (OBLIGATORIO para enviar emails)

#### Paso 1: Obtener contraseña de aplicación de Gmail

1. Ve a tu **Cuenta de Google**: https://myaccount.google.com/

2. En el menú izquierdo, selecciona **Seguridad**

3. Busca la sección **Verificación en 2 pasos**:
   - Si NO está activa → **Actívala primero** (es obligatorio)
   - Si YA está activa → continúa al siguiente paso

4. Busca **Contraseñas de aplicaciones**:
   - Haz clic en "Contraseñas de aplicaciones"
   - Nombre de la app: **EventMaster**
   - Haz clic en **Generar**

5. **GUARDA la contraseña** que aparece (16 caracteres)
   - Ejemplo: `abcd efgh ijkl mnop`
   - **NO compartas** esta contraseña con nadie

#### Paso 2: Configurar el archivo .env

1. Abre el archivo `.env` en la raíz del proyecto

2. Busca la sección `MAIL_MAILER` y **reemplaza** con esto:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD="abcd efgh ijkl mnop"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="tu-email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

3. **Reemplaza**:
   - `tu-email@gmail.com` → Tu email de Gmail real
   - `abcd efgh ijkl mnop` → La contraseña de 16 caracteres que generaste

4. **Guarda** el archivo `.env`

---

### 3. Ejecutar migraciones (OBLIGATORIO)

Después de arreglar las extensiones de PHP:

```bash
php artisan migrate
```

Esto creará la tabla `notifications` en la base de datos.

---

### 4. Configurar Queue (RECOMENDADO para mejor rendimiento)

Los emails se envían en segundo plano usando colas. Necesitas ejecutar el worker de Laravel:

**Opción A - Para desarrollo (simple):**
```bash
php artisan queue:work
```

**Opción B - Para producción (recomendado):**
Configurar Supervisor o usar:
```bash
php artisan queue:listen --timeout=60
```

**IMPORTANTE**: Deja este comando ejecutándose en una terminal separada mientras trabajas en el proyecto.

---

## 🧪 CÓMO PROBAR QUE TODO FUNCIONA:

### Prueba 1: Enviar una invitación

1. Crea un equipo o usa uno existente
2. Ve a la sección de Miembros del equipo
3. Haz clic en "Invitar Miembro"
4. Selecciona un usuario y envía la invitación
5. **Verifica** que:
   - Se envía el email al Gmail del usuario
   - Aparece la campana de notificación con contador (1)
   - El email tiene botones de "Aceptar" y "Rechazar"

### Prueba 2: Aceptar invitación

1. El usuario invitado abre su Gmail
2. Hace clic en el botón "Aceptar Invitación" del email
3. **Verifica** que:
   - Se redirige a la plataforma
   - Se agrega automáticamente al equipo
   - El líder recibe una notificación (campana)
   - El líder recibe un email de confirmación

### Prueba 3: Ver notificaciones

1. Haz clic en la campana de notificaciones (navbar)
2. **Verifica** que:
   - Aparecen las invitaciones pendientes
   - Muestra el contador correcto
   - Se pueden ver las notificaciones de aceptaciones

---

## 🐛 SOLUCIÓN DE PROBLEMAS:

### Problema: "could not find driver"
**Solución**: No activaste las extensiones de PHP → Ve a la sección 1

### Problema: "mb_split() undefined"
**Solución**: No activaste `extension=mbstring` → Ve a la sección 1

### Problema: Emails no se envían
**Solución**:
1. Verifica que `.env` tenga la configuración correcta
2. Verifica que la contraseña de aplicación sea correcta
3. Verifica que `MAIL_MAILER=smtp` (NO `log`)
4. Ejecuta el worker de colas: `php artisan queue:work`

### Problema: Aparece error 500 al enviar invitación
**Solución**:
1. Ejecuta las migraciones: `php artisan migrate`
2. Verifica los logs: `storage/logs/laravel.log`

---

## 📝 FLUJO COMPLETO:

```
1. Líder invita a usuario
   ↓
2. Sistema crea invitación en BD
   ↓
3. Sistema envía notificación:
   - Email a Gmail del usuario
   - Notificación en BD
   ↓
4. Usuario ve:
   - Email en su Gmail (con botones)
   - Campana con contador (1)
   - Invitación en /invitaciones
   ↓
5. Usuario hace clic en "Aceptar" (desde email o plataforma)
   ↓
6. Sistema:
   - Agrega al usuario al equipo
   - Marca invitación como aceptada
   - Notifica al líder (email + notificación)
   ↓
7. Líder ve:
   - Email de aceptación
   - Notificación en campana
   - Nuevo miembro en el equipo
```

---

## 🎯 RESUMEN DE ARCHIVOS MODIFICADOS:

1. `app/Http/Controllers/InvitacionController.php` → Usa notificaciones
2. `app/Notifications/NuevaInvitacionNotification.php` → Notificación de invitación
3. `app/Notifications/InvitacionAceptadaNotification.php` → Notificación de aceptación
4. `resources/views/layouts/master.blade.php` → Campana de notificaciones
5. `database/migrations/2025_12_10_000000_create_notifications_table.php` → Tabla de notificaciones
6. `resources/views/equipos/show.blade.php` → Dashboard limpio sin conflictos

---

## ❓ PREGUNTAS FRECUENTES:

**P: ¿El usuario puede aceptar desde el email directamente?**
R: Sí, los botones del email funcionan con un solo clic.

**P: ¿Se envía email y notificación en la plataforma?**
R: Sí, ambos. Email para que lo vean aunque no estén conectados, y notificación en la campana cuando entren.

**P: ¿Qué pasa si el equipo ya está lleno cuando aceptan?**
R: El sistema rechaza automáticamente y le avisa al usuario.

**P: ¿Se puede usar otro email que no sea Gmail?**
R: Sí, pero Gmail es el más fácil. Para otros (Outlook, Yahoo, etc.) las configuraciones cambian.

---

## 🚀 SIGUIENTE PASO:

1. Activa las extensiones de PHP
2. Configura Gmail SMTP
3. Ejecuta las migraciones
4. Ejecuta `php artisan queue:work`
5. ¡Prueba enviar una invitación!
