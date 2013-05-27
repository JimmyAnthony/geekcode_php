geekcode_php
============

Framework de trabaja en conjunto con librerías de Zend framework(ver. 1.12.3)

Configuración
-------------

Bueno primeramente antes de todo, tenemos que verificar que tenemos configuradas ciertas cosas  
para que el proyecto se ejecute con normalidad.

### Apache

Vamos a modificar pequeñas cosas en el archivo httpd.conf(solo pequeñas cosas, nada del otro mundo)  
En este punto vamos a explicar la modificación del archivo mencionado anteriormente en diversas  
plataformas (Linux y/o Windows).

#### Linux(Distro: Ubuntu)

> 1. Abrir una terminal y ejecutar el siguiente comando:  
``` bash
a2enmod rewrite && sudo invoke-rc.d apache2 restart
``` 

