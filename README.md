# PHPunit tests for the Advent of Code puzzles

Repo created to store PHPUnit test files for some of the AoC 2024 puzzles

## Build and running scripts and tests

### Build

```docker
docker compose -f 'docker-compose.yml' build
```

### Running Tests

```docker
docker run --name hrvl-phpunit --rm -it hrvl/pdi-phpunit php vendor/bin/phpunit --testdox
```

### Running the app:

Pass as parameters the day you want to run the scripts and the path of the input file. Examples:

```docker
docker run --name hrvl-php --rm -it hrvl/pdi-php php src/App.php DayOne assets/DayOne/input.txt
```

```docker
docker run --name hrvl-php --rm -it hrvl/pdi-php php src/App.php DayTwo assets/DayTwoInputData.txt
```
