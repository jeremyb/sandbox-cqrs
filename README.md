## Sandbox CQRS

This is an example application aimed to try CQRS architecture based on
a Command and Query buses.

### Installation

```bash
docker-compose build
docker-compose up -d
docker-compose run --rm php bin/console
docker-compose run --rm php bin/console doctrine:migrations:migrate
```

### Usage

```bash
docker-compose run --rm php bin/console bookmark:create https://raindrop.io/
docker-compose run --rm php bin/console bookmark:list
```
