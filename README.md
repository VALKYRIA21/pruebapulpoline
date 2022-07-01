<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Prueba técnica para el empresa Pulpo Line

_Proyecto pruebapulpoline , hecho en Laravel_

## Requerimientos 
```
1.Crear un pequeño módulo para convertir un montode una monedaa otra moneda, página de referencia 
(https://www.xe.com/currencyconverter/)
2.Debe tener tres entradas y un botón de convertir, una entrada númerica donde se ingresa el monto,
una para seleccionar la moneda de origen y una última para seleccionar la moneda final
3.Se debe usar la api del servicio gratuito (https://www.currencyconverterapi.com/docs)
4.Importante y punto final:
Importante: el usuario invitado (en sesión) debe tener la posibilidad de usar el servicio de conversión máximo 5 veces,
si sobre pasa este límite lo debe redirigir a una pantalla donde le indique que supere el límite de conversiones en un día.
```

## Antes de iniciar, te recomiendo🤖

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

### Pre-requisitos 📋

_Que cosas necesitas para instalar el software y como instalarlas?_

```
Es recomendable ejecutar el comando composer dump-autoload en la terminal git de tu proyecto
Adicional te anexo en el proyecto la base de datos lista para ser importada en http://localhost/phpmyadmin/
(Si no desea realizar la importación puede crear una base de datos nuevas con el nombre pruebapulpoline), 
luego de eso ejecutar el comando php artisan migrate y se subirán las tablas creadas inicialmente en el proyecto

Paquetes usados
composer require nesbot/carbon
composer require laravel/helpers
composer require guzzlehttp/guzzle
```
## Construido con 🛠️

_Menciona las herramientas que utilizaste para crear tu proyecto_

* [Laravel](https://laravel.com/) - El framework php usado
* [Bootsrap](https://getbootstrap.com/) - El framework css usado
* [CurrencyConverterApi](https://www.currencyconverterapi.com/) - Api usada para trabajar el requisito pedido por la empresa

## Autor ✒️
* **Fernando Andrés Berrio Torres** - *Trabajo Inicial* - 
