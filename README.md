# README #

This README would normally document whatever steps are necessary to get your application up and running.

### Run Dockers ###
```
$ cd unisan/docker 
$ docker-compose up -d
```
### Instalar dependencias ###
```
$ docker exec -ti unisan_apache php -d memory_limit=-1 composer.phar install
```
### Editar el archivo www/app/config/parameters.yml ###
database_host: <ip_local>

### Crear estrucutra DB ###
```
$ docker exec -ti unisan_apache php bin/console doctrine:schema:update --force
```
### Datos iniciales por única vez ###
```
$ docker exec -ti unisan_apache php bin/console doctrine:fixtures:load
```
Este ultimo comando agrega un usuario 'Superuser' en al base para ingresar al BackOffice 
* Email: admin@email.com
* Password: 123456 
* Link: [BackOffice](http://dev.unisan.cl/app_dev.php/admin)

### Instalar los assets ###
```
$ docker exec -ti unisan_apache php bin/console assets:install
```

### Comandos utiles de symfony ###

* Limpiar cache: $ bin/console cache:clear
* Crear entidades: $ bin/console doctrine:generate:entity
* Instalar assets: $ bin/console assets:install

### Comandos para ingresar a la terminal de un container ###

* Apache: docker exec -ti unisan_apache bash
* Mysql: docker exec -ti unisan_mysql bash
