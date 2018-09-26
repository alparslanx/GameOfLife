# Game Of Life

Calculate the head generation of Conway's game of life, given any starting position.
You start with a two dimensional grid of cells, where each cell is either alive or dead.
The grid is finite, and no life can exist off the edges.
When calculating the head generation of the grid, following these four rules:

1. Any live cell with fewer than two live neighbours dies, as if caused by underpopulation.

2. Any live cell with more than three live neighbours dies, as if by overcrowding.

3. Any live cell with two or three live neighbours lives on to the head generation.

4. Any dead cell with exactly three live neighbours becomes a live cell.
	
## Getting Started

Installation is simple! php7 and composer suffice.

### Requirements

```
PHP 7^
COMPOSER
```

### Installing

Download the project and go to the project directory.

```
install composer
```

run command.

## Running the project

The project works only with the terminal, you will encounter errors in other methods.

Go to the project folder and execute the following command.
```
php createGeneration.php 32x32 50000 50
```

Parameters:
```
php createGeneration.php WidthxHeight micro_second maximum_create_generation
```

You will receive such an answer:
```
50. Generation
................................
..................*.............
............*....*...*..........
..........****...*...**.........
.........*....*..*.*............
........*...**...*.**...........
........*.......................
........*...**..................
.........**.....................
............*.**................
............*...*........*......
.............***........***.....
..............**.......*****....
......................*.....*...
.....................**..*..**..
........*...........***.*.*.***.
..**.....*...........**..*..**..
..**.*..*........*....*.....*...
..**.*..*........*.....*****....
......*..........*......***.....
.............*..........**......
.............*........***.......
.............*........*.*.......
......................***.......
................................
................................
.........**.....................
.........**.......***...........
```


## Running the tests

We have 15 tests (21 assertions) that inspect the factory method and control the output.

```
phpunit
```

If you get an answer like the following, everything is alright!

```
OK (15 tests, 21 assertions)
```