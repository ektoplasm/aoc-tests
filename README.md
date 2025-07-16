# PHPunit tests for the Advent of Code puzzles

Repo created to store PHPUnit test files for some of the AoC 2024 puzzles

## Build and running scripts and tests

### Build

```docker
docker compose -f 'docker-compose.yml' build
```

### Run Tests

```docker
docker run --name hrvl-phpunit --rm -it hrvl/pdi-phpunit php vendor/bin/phpunit --testdox
```

### Run scripts:

Pass as parameter the day you want to run the scripts. Example:

```docker
docker run --name hrvl-php --rm -it hrvl/pdi-php php src/App.php DayOne
```
