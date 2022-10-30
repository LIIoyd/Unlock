## Unlock 

# Start Docker

1. start and get logs

```
docker-compose up
```

2. open an new terminal and get into PHP container

```
docker-compose exec --workdir /app php /bin/bash
```

3. within the PHP container, install compose dependencies

```
composer update
```


# Initialiser la basse de donnée

1. execute the migration
```
./vendor/bin/doctrine-migrations migrate
```

# Lien vers l'application

- http://localhost:8080