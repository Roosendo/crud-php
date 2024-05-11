# CRUD en PHP

Este proyecto requiere Composer para la gestión de dependencias y utiliza TCPDF para la generación de PDFs.

## Instalación

1. Asegúrate de tener Composer instalado en tu sistema. Puedes descargarlo desde [getcomposer.org](https://getcomposer.org/).

2. Clona este repositorio en tu máquina local o descárgalo como un archivo ZIP.

3. En la raíz del proyecto, ejecuta el siguiente comando para instalar las dependencias:

   ```bash
   composer install
   ```
## Uso

1. Una vez que hayas instalado las dependencias con Composer, puedes utilizar TCPDF en tu proyecto PHP. Asegúrate de incluir el archivo de autoloading de Composer en tus scripts PHP

   ```php
   require 'vendor/autoload.php';
   ```
2. Luego puedes utilizar las clases y métodos de TCPDF según sea necesario en tu código para generar PDFs.
