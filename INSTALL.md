# Prepare development environment

## Cloning Repository:


## Docker Installation

>Install Docker engine
[docs.docker.com/engine/installation](https://docs.docker.com/engine/installation/)

>Install Docker compose
[docs.docker.com/compose/install](https://docs.docker.com/compose/install/)


## Start docker images

```bash
docker-compose up -d
```

This will start all the containers, then leave them running in the background.

## Download all dependencies

```bash
docker exec -it php  /bin/bash
composer install
```
## Create database and test data
```bash
docker exec -it php  /bin/bash
composer migrate
composer seed
```
## Run the test suite
```bash
docker exec -it php  /bin/bash
composer test
```

## Access application Url

The following URL should be accessible from the browser

```
http://localhost:8080
```
