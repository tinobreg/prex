## Pasos setup entorno

### Clonar este repo
```
git clone git@github.com:tinobreg/prex.git
```

### Agregar los DNS
Modificar el arhivo /etc/hosts (o el equivalente) agregando estos entries:
```
127.0.0.1   api.prex.local
```

## Levantar docker

### Buildear los contenedores
> PARA LINUX
```
docker-compose build --build-arg USER_ID=$(id -u) --build-arg GROUP_ID=$(id -g)
```
> PARA WINDOWS
```
docker-compose build --build-arg USER_ID=2000 --build-arg GROUP_ID=2000
```


#### Levantar los contenedores
```
docker-compose up
```

### Configurar el entorno
```
docker exec -ti prex_phpfpm_1 /bin/bash
cd /app/prex/
composer update
cp .env.example .env // la primera vez
php artisan key:generate // la primera vez
php artisan migrate
```



------------------------------------------------------

## Documentación del proyecto

### DER
https://dbdiagram.io/d/Prex-662f00385b24a634d005a006

### Diagrama de casos de uso

<img src="https://i.postimg.cc/Z59zYhyj/Captura-de-Pantalla-2024-05-14-a-la-s-01-18-41.png"/>

### Diagrama de Secuencia

> POST /auth/login
> 
> Params: email:string, password:string
> 
> 1. El usuario envia una solitud de autentificación
> 2. API valida credenciales
> 3. API devuelve el token del usuario

> GET /gifs/search
> 
> Params: q:string, limit:int, offset:int
> 
> 1. El usuario envia una solitud de busqueda de GIFs
> 2. API valida el token del usuario
> 3. API consulta a GIPHY con los parámetros de búsqueda. 
> 4. GIPHY devuelve los resultados. 
> 5. API devuelve los resultados al usuario.

> GET /gifs/{id}
> 1. El usuario envia una solitud de vista del GIF para el id brindado
> 2. API valida el token del usuario
> 3. API consulta a GIPHY con el id del GIF.
> 4. GIPHY devuelve el resultado.
> 5. API devuelve el resultado al usuario.

> POST /gifs/add-favourite
> 
> Params: gif_id:string, alias:string
> 
> 1. El usuario envia una solitud de agregar el GIF a favoritos
> 2. API valida el token del usuario
> 3. API le solicita al GifFavouriteRepository que agregue el GIF en el modelo GifFavourites.
> 4. API devuelve el resultado al usuario.