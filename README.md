# App project

## Start development environment

Start containers

```bash
docker-compose up

or

docker-compose up  -d
```

## Stop development environment

Stop containers:
```bash
docker-compose stop
```

## Execute commands inside containers

to open a console prompt.
```bash
docker exec -it php  /bin/bash
```
## Execute The MySQL Command-Line Tool
```bash
docker exec -it db  /bin/bash
mysql -p       
```
** note initial mysql password: secret **

## Run the test suite
```bash
docker exec -it php  /bin/bash
composer test
```

## Install development environment
>Detailed introduction for setting up the development environment in file
[INSTALL.md](INSTALL.md)
