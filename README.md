# Proyecto BDD404 con SQL Server y PHP 8.3

Este proyecto es una implementación de una aplicación web utilizando **SQL Server** como base de datos y **PHP 8.3** como backend para manejar las solicitudes.

## Requisitos

Antes de ejecutar el proyecto, asegúrate de que tienes los siguientes requisitos instalados:

- **PHP 8.3** (o una versión compatible de PHP)
- **SQL Server** (se recomienda la versión 2017 o superior)
- Extensiones de PHP necesarias para conectar con **SQL Server**:
  - **`sqlsrv`**: Extensión para conectar con SQL Server.
  - **`pdo_sqlsrv`**: Extensión PDO para conectar con SQL Server utilizando la interfaz PDO.

## Instalación

### 1. Descargar PHP 8.3

1. Dirígete a la página oficial de PHP para descargar PHP 8.3: [https://www.php.net/downloads.php](https://www.php.net/downloads.php).
2. Descarga la versión correspondiente a tu sistema operativo (por ejemplo, Windows, Linux).
3. Extrae el archivo descargado en una ubicación de tu preferencia.

### 2. Instalar las extensiones de SQL Server

#### 2.1. Descargar las extensiones de SQLSRV

1. Visita el siguiente enlace de Microsoft para obtener las extensiones de SQL Server para PHP: [https://github.com/microsoft/msphpsql](https://github.com/microsoft/msphpsql).
2. Ve a la sección de "Releases" en el repositorio y selecciona la versión más reciente compatible con PHP 8.3.
3. Descarga el archivo ZIP que corresponde a tu versión de PHP y sistema operativo (por ejemplo, `php_sqlsrv_8.3_ts_x64.dll` si usas Windows x64 y PHP Thread Safe).

#### 2.2. Instalar las extensiones en PHP

1. Copia los archivos `.dll` descargados a la carpeta `ext` dentro de tu instalación de PHP (por ejemplo, `C:\php\ext` si PHP está instalado en `C:\php`).
   
   Los archivos `.dll` comunes que necesitarás son:
   - `php_sqlsrv.dll`
   - `php_pdo_sqlsrv.dll`

2. Edita el archivo `php.ini` que se encuentra en la raíz de tu instalación de PHP.

3. Agrega las siguientes líneas para habilitar las extensiones en tu `php.ini`:
   ```ini
   extension=sqlsrv.dll
   extension=pdo_sqlsrv.dll
   ```

4. Guarda los cambios y reinicia el servidor web (como Apache o Nginx) o el servidor PHP (si usas el servidor integrado de PHP).

### 3. Configurar la conexión con SQL Server

1. **Conexión en el código PHP**:
   Utiliza las funciones de la extensión `sqlsrv` para conectar tu aplicación con SQL Server. Un ejemplo de código para realizar la conexión sería el siguiente:

   ```php
   <?php
   $serverName = "localhost"; // Cambia esto por tu servidor de base de datos
   $connectionOptions = array(
       "Database" => "bdd_proyecto", // Nombre de tu base de datos
       "Uid" => "usuario", // Tu nombre de usuario en SQL Server
       "PWD" => "contraseña" // Tu contraseña en SQL Server
   );

   // Conectar al servidor de base de datos
   $conn = sqlsrv_connect( $serverName, $connectionOptions );

   if( !$conn ) {
       die( print_r(sqlsrv_errors(), true));
   } else {
       echo "Conexión exitosa a la base de datos.";
   }
   ?>
   ```

2. **Verificar la conexión**:
   Asegúrate de que la conexión funciona correctamente ejecutando este script PHP.

### 4. Requisitos adicionales

Para un entorno de desarrollo local en **Windows**, se recomienda instalar **XAMPP** o **WAMP**, que incluyen PHP, Apache y MySQL. Sin embargo, como estamos usando SQL Server, asegúrate de que el módulo PHP con soporte de SQL Server esté instalado y configurado correctamente.

Para **Linux** o **Mac**, puedes usar **Docker** para levantar un contenedor con PHP y SQL Server.

## Uso

Una vez que hayas configurado todo correctamente, puedes ejecutar el proyecto de la siguiente manera:

1. Accede al directorio donde se encuentra tu aplicación PHP.
2. Si usas PHP integrado, puedes ejecutar el servidor con el siguiente comando:
   ```bash
   php -S localhost:8000
   ```

3. Abre tu navegador y accede a `http://localhost:8000`.

4. Si el proyecto requiere la ejecución de consultas SQL, asegúrate de tener las tablas y los datos necesarios en SQL Server. Puedes utilizar el archivo de migración o ejecutar las consultas manualmente.

---

## Configuración de Apache (XAMPP, WAMP, Laragon)

Si estás utilizando un servidor local como **XAMPP**, **WAMP**, o **Laragon** para ejecutar tu aplicación PHP, necesitas asegurarte de que la carpeta de tu proyecto esté configurada como la raíz del servidor (el "root") para que puedas acceder a él a través de `http://localhost`.

### 1. **XAMPP (Windows)**

Si estás usando **XAMPP**, sigue estos pasos:

1. **Coloca tu proyecto en el directorio `htdocs`**:
   - Ve a la carpeta donde instalaste **XAMPP**. Normalmente, esto será `C:\xampp`.
   - Dentro de la carpeta `xampp`, busca la subcarpeta `htdocs`. Este es el directorio raíz de tu servidor Apache.
   - Crea una nueva carpeta dentro de `htdocs` y coloca todos los archivos de tu proyecto en esa carpeta. Por ejemplo, si tu proyecto se llama `bdd404`, coloca todos los archivos dentro de `C:\xampp\htdocs\bdd404`.

2. **Accede al proyecto desde el navegador**:
   - Una vez que hayas colocado los archivos en `htdocs`, abre tu navegador y navega a `http://localhost/bdd404`.
   - Tu proyecto debería estar accesible desde esta URL.

3. **Configurar Apache (si es necesario)**:
   Si deseas cambiar el nombre de la carpeta de tu proyecto o usar un dominio local como `http://miapp.local`, puedes modificar la configuración de Apache en el archivo `httpd-vhosts.conf`:
   - Abre `C:\xampp\apache\conf\extra\httpd-vhosts.conf` con un editor de texto.
   - Añade una nueva entrada para tu proyecto:
     ```apache
     <VirtualHost *:80>
         DocumentRoot "C:/xampp/htdocs/bdd404"
         ServerName miapp.local
     </VirtualHost>
     ```

4. **Reinicia Apache**:
   - Ve al panel de control de XAMPP y reinicia Apache para aplicar los cambios.

### 2. **WAMP (Windows)**

Si estás usando **WAMP**, sigue estos pasos:

1. **Coloca tu proyecto en el directorio `www`**:
   - Dirígete a la carpeta donde instalaste **WAMP**. Normalmente, esto será `C:\wamp64`.
   - Dentro de la carpeta **WAMP**, busca la subcarpeta `www`. Este es el directorio raíz de tu servidor Apache.
   - Coloca todos los archivos de tu proyecto dentro de `www`. Por ejemplo, si tu proyecto se llama `bdd404`, coloca todos los archivos dentro de `C:\wamp64\www\bdd404`.

2. **Accede al proyecto desde el navegador**:
   - Una vez que hayas colocado los archivos en `www`, abre tu navegador y navega a `http://localhost/bdd404`.

3. **Configurar Apache (si es necesario)**:
   - Si quieres usar un nombre personalizado para tu aplicación, puedes configurar Apache agregando una entrada en el archivo `httpd-vhosts.conf`. Dirígete a `C:\wamp64\bin\apache\apache2.4.46\conf\extra\httpd-vhosts.conf` y edítalo:
     ```apache
     <VirtualHost *:80>
         DocumentRoot "C:/wamp64/www/bdd404"
         ServerName miapp.local
     </VirtualHost>
     ```

4. **Reinicia Apache**:
   - Abre el panel de control de WAMP y reinicia los servicios para aplicar los cambios.

### 3. **Laragon (Windows)**

Si estás usando **Laragon**, sigue estos pasos:

1. **Coloca tu proyecto en el directorio `www`**:
   - Dirígete a la carpeta donde instalaste **Laragon**. Normalmente, esto será `C:\laragon`.
   - Dentro de la carpeta **Laragon**, busca la subcarpeta `www`. Este es el directorio raíz de tu servidor Apache.
   - Coloca los archivos de tu proyecto en `C:\laragon\www\bdd404`.

2. **Accede al proyecto desde el navegador**:
   - Una vez que hayas colocado los archivos en `www`, abre tu navegador y navega a `http://bdd404.test`.

3. **Reinicia Laragon**:
   - Si realizas cambios en la configuración, reinicia Laragon para aplicar los cambios.

---

## Resumen de pasos para Apache (XAMPP, WAMP, Laragon)

1. Coloca la carpeta de tu proyecto dentro del directorio raíz de tu servidor (en `htdocs`, `www`, o similar).
2. Asegúrate de que Apache esté corriendo.
3. Accede al proyecto a través de `http://localhost/mi-carpeta-proyecto`.

---

Con estos pasos, deberías poder configurar tu proyecto correctamente y acceder a él de manera fácil a través de un servidor local como **XAMPP**, **WAMP**, o **Laragon**. Si tienes alguna pregunta o problema durante la configuración, no dudes en abrir un **issue**.

## Problemas comunes

- **Error: `Unable to load dynamic library 'sqlsrv'`**:
  Asegúrate de que el archivo `.dll` esté en el directorio correcto (`ext`) y que la ruta esté bien configurada en el archivo `php.ini`.

- **Error de conexión a la base de datos**:
  Verifica las credenciales de la base de datos, asegúrate de que SQL Server esté corriendo, y que la conexión esté configurada correctamente en el archivo `php.ini`.

- **Problemas de versión de PHP y SQLSRV**:
  Si las versiones de PHP o SQLSRV no son compatibles, verifica que estés utilizando las versiones correctas de las extensiones de SQL Server para la versión específica de PHP que estás utilizando.

---

## Contribuciones

Si deseas contribuir a este proyecto, por favor, sigue los siguientes pasos:

1. Haz un fork de este repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza los cambios y haz un commit (`git commit -am 'Agregada nueva funcionalidad'`).
4. Haz un push a la rama (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

---

¡Eso es todo! Con estos pasos deberías tener tu entorno PHP 8.3 y SQL Server funcionando sin problemas. Si tienes alguna pregunta o necesitas más ayuda, no dudes en abrir un issue en este repositorio.



