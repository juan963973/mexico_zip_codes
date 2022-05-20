# Mexico zip codes
## _Pasos de como abordé el problema_


- Primeramente leí el documento y seguí los pasos para descargar la fuente, descargué en el formato CSV.
- Después usé un administrador de base de datos llamado Sequel para importar los datos del CSV.
- Importé los datos a MySQL con el mismo formato que vino del archivo.
- Luego pensé en normalizar mi base de datos ponerle indices y optimizar los campos etc. 
- Luego se me ocurrió cambiar el motor de InnoDb a MyISAM para ver el resultado. Y era bastante bueno en mi local, las peticiones llegaron menos de 300ms.
- Ya estuve felíz porque dije, no hace falta normalizar, simplemente con esto ya lo he resuelto.
- Luego subí al servidor y ahí tuve una sorpresa!! las peticiones pasaban los 300ms.
- Luego volví a pensar en cambiar todo InnoDb y normalizar.
- Ahí se me vino la idea de usar MongoDB, pero como tengo un servidor en cPanel y no una VPS, pensé en el dolor de cabeza en la configuración entonces pensé más opciones.
- Entonces ahí pensé en lo que fué mi solución!!. Exporté mi base de datos en formato json, subí al servidor y usé el archivo como base de datos y implementé con filter de PHP y la velocidad fué buena. con pocas lineas de código pude bajar la velocidad considerablemente.
- Mandé al challenge, y me salieron errores de codificación de caracteres, de que faltaban datos, de poner en el mismo formato porque puse todo varchar al principio. Ahí me di cuenta que tuve errores en la importación del CSV y lo volví a correr con mas cautela. "La importación de los datos, fué lo que más me llevó tiempo porque había campos que no se exportaban bien, o tenían comillas y eso causaban problemas tuve que corregir todo esos a mano".

## Instación

Clone el proyecto en su equipo.

```sh
git clone https://github.com/juan963973/mexico_zip_codes.git
```

No usé el archivo de .env porque no usé base de datos. Para que su laravel no se queje puede copiar el archivo .env.example y configurar el APP_KEY. Luego corra el proyecto.

```sh
php artisan serve
```
Y puede ver el resultado en: http://127.0.0.1:8000/api/zip-codes/01210

## Producción

El proyecto se encuentra alojado en https://delifree.vipar.com.py/api/zip-codes/02120

El archivo json puede encontrar en: https://vipar.com.py/mexico_zip_codes.json

## License

MIT
**Free Software!**