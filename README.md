# 🛡️ GAUBIZI — Red de Seguridad en el Ocio Nocturno

> **Tu voz contra las agresiones. Comunidad y seguridad.**
>
> Aplicación web ciudadana para mejorar la seguridad en el ocio nocturno de Euskal Herria. Permite reportar incidentes, consultar la seguridad de los locales y acceder a protocolos de actuación mediante un asistente con IA.

---

## 📋 Tabla de contenidos

- [Descripción](#-descripción)
- [Tecnologías](#-tecnologías)
- [Estructura del proyecto](#-estructura-del-proyecto)
- [Instalación local (XAMPP)](#-instalación-local-xampp)
- [Despliegue en Linux](#-despliegue-en-linux)
- [Credenciales de prueba](#-credenciales-de-prueba)
- [Módulos implementados](#-módulos-implementados)
- [Autor](#-autor)

---

## 📖 Descripción

Gaubizi es una plataforma de concienciación y reportes ciudadanos, **no un canal de denuncia judicial oficial**. Su finalidad es estadística y preventiva: centralizar información sobre incidentes en espacios de ocio nocturno para alertar a la comunidad y fomentar entornos más seguros.

Cubre las **7 provincias de Euskal Herria**: Araba, Bizkaia, Gipuzkoa, Nafarroa, Lapurdi, Zuberoa y Nafarroa Beherea.

---

## 🛠️ Tecnologías

| Capa | Tecnología |
|------|-----------|
| Backend | PHP 8.x nativo (OOP, patrón MVC propio) |
| Base de datos | MySQL / MariaDB (PDO con sentencias preparadas) |
| Frontend | HTML5, CSS3 compilado desde SCSS, JavaScript puro |
| Mapa | Leaflet.js + OpenStreetMap |
| IA (chatbot) | API OpenRouter — modelo NVIDIA Nemotron (gratuito) |
| Servidor | Apache (XAMPP local / Ubuntu Server en producción) |
| Exposición pública | ngrok |

---

## 📁 Estructura del proyecto

```
GaubiziMP/
├── app/
│   ├── Config/
│   │   ├── database.php        # Credenciales BD (no incluido en git)
│   │   └── api_keys.php        # API key OpenRouter (no incluir en git)
│   ├── Controllers/
│   │   ├── AuthController.php       # Login y registro
│   │   ├── HomeController.php       # Página de inicio
│   │   ├── LocalController.php      # Directorio y ficha de locales
│   │   ├── DenunciaController.php   # Reportes de incidentes
│   │   ├── AdminController.php      # Panel de moderación
│   │   ├── MapaController.php       # Mapa interactivo
│   │   ├── PerfilController.php     # Perfil y favoritos
│   │   └── BotController.php        # GauAuxiliar (chatbot IA)
│   ├── Models/
│   │   ├── Usuario.php
│   │   ├── Local.php
│   │   ├── Denuncia.php
│   │   └── Favorito.php
│   └── Views/
│       ├── layout/header.php
│       ├── home/
│       ├── locales/
│       ├── auth/
│       ├── denuncias/
│       ├── admin/
│       ├── mapa/
│       ├── perfil/
│       └── bot/
├── db/
│   ├── gaubizi_schema.sql      # Esquema de la BD
│   └── gaubizi_seed.sql        # Datos iniciales
└── public/
    ├── index.php               # Front Controller
    └── assets/
        ├── css/main.css
        └── scss/
```

---

## 💻 Instalación local (XAMPP)

### Requisitos
- XAMPP con PHP 8.x y MariaDB
- Extensiones PHP: `pdo`, `pdo_mysql`, `curl`

### Pasos

**1. Clonar el repositorio en htdocs:**
```bash
cd /Applications/XAMPP/xamppfiles/htdocs
git clone <url-del-repositorio> GaubiziMP
```

**2. Crear la base de datos:**

Abre phpMyAdmin o ejecuta en terminal:
```bash
mysql -u root < GaubiziMP/db/gaubizi_schema.sql
mysql -u root < GaubiziMP/db/gaubizi_seed.sql
```

**3. Crear el archivo de configuración de BD:**

Crea `app/Config/database.php` (no incluido en git):
```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'gaubizi_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

class Database {
    private $conn = null;

    public function getConnection() {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
                $this->conn = new PDO($dsn, DB_USER, DB_PASS);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                die("Error de conexión a la base de datos.");
            }
        }
        return $this->conn;
    }
}
?>
```

**4. Crear el archivo de API key:**

Crea `app/Config/api_keys.php` (no incluido en git):
```php
<?php
define('OPENROUTER_API_KEY', 'tu-api-key-de-openrouter');
?>
```

> Obtén una API key gratuita en [openrouter.ai](https://openrouter.ai)

**5. Acceder a la aplicación:**
```
http://localhost/GaubiziMP/public/
```

---

## 🐧 Despliegue en Linux

### Requisitos
- Ubuntu Server 22.04 / 24.04
- Apache2, MySQL, PHP 8.x, php-mysql, php-curl

### Instalación rápida

```bash
# Instalar LAMP
sudo apt update && sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql php-curl -y

# Configurar MySQL
sudo mysql -u root
```
```sql
CREATE DATABASE gaubizi_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'gaubizi'@'localhost' IDENTIFIED BY 'tu-contraseña';
GRANT ALL PRIVILEGES ON gaubizi_db.* TO 'gaubizi'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```
```bash
# Copiar proyecto
sudo cp -r GaubiziMP /var/www/html/GaubiziMP
sudo chown -R www-data:www-data /var/www/html/GaubiziMP
sudo chmod -R 755 /var/www/html/GaubiziMP

# Importar BD
mysql -u gaubizi -p gaubizi_db < db/gaubizi_schema.sql
mysql -u gaubizi -p gaubizi_db < db/gaubizi_seed.sql
```

### Exposición pública con ngrok

```bash
# Instalar ngrok
curl -sSL https://ngrok-agent.s3.amazonaws.com/ngrok.asc | sudo tee /etc/apt/trusted.gpg.d/ngrok.asc >/dev/null
echo "deb https://ngrok-agent.s3.amazonaws.com buster main" | sudo tee /etc/apt/sources.list.d/ngrok.list
sudo apt update && sudo apt install ngrok -y

# Configurar y lanzar
ngrok config add-authtoken TU_TOKEN
ngrok http 80
```

---

## 🔑 Credenciales de prueba

| Rol | Email | Contraseña |
|-----|-------|-----------|
| Administrador | admin@gaubizi.eus | password |
| Usuario | iker@gaubizi.eus | password |

> El usuario admin tiene acceso al panel de moderación en `/admin`.

---

## 🧩 Módulos implementados

### RF-01 · Autenticación y roles
- Registro con hash Bcrypt
- Login con verificación segura
- 4 roles: `guest`, `user`, `mod`, `admin`
- Protección de rutas por rol

### RF-02 · Reportes de incidentes
- Envío anónimo o identificado
- 4 tipos de incidente
- Estado: pendiente / validado / rechazado

### RF-03 · Directorio de locales
- 11 locales en las 7 provincias
- Filtrado por provincia
- Búsqueda por nombre o municipio
- Contador de alertas validadas por local

### RF-04 · Mapa interactivo
- Leaflet.js sobre OpenStreetMap
- Marcadores morados para todos los locales
- Marcadores dorados para favoritos del usuario
- Popup con información y enlace al local

### RF-05 · Panel de moderación
- Acceso exclusivo para `admin` y `mod`
- Filtrado por estado
- Cambio de estado con POST

### RF-06 · GauAuxiliar (chatbot IA)
- Integrado con API OpenRouter
- Modelo NVIDIA Nemotron (gratuito)
- Protocolos de seguridad y números de emergencia
- Comunicación asíncrona con Fetch API

### Favoritos
- Guardar/quitar sin recargar página (AJAX)
- Visibles en perfil y en el mapa

---

## 👤 Autor

**Erlantz Kareaga Bilbao**  
2º DAW · Arangoya Ikastetxea · Curso 2025-2026

---

