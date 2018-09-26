<?php
/**
 * Example with terminal: php createGeneration.php 32x16 50000 250
 * 32x16 = width x height | requirement
 * 50000 = new generation sleep microtime
 * 250 = maximum create generation
 */
require_once __DIR__ . '/vendor/autoload.php';
use App\GameOfLife;
use Colors\Color;

$c = new Color();
if(PHP_SAPI !== 'cli')
{
    echo $c('Please run with terminal. Example: php createGeneration.php 32x32')->white()->bold()->highlight('red') . PHP_EOL;
}


$widthHeight = isset($argv[1]) && strstr($argv[1],'x') ? explode('x',$argv[1]) : die($c('Please send a WidthxHeight. Example: php createGeneration.php 32x32')->white()->bold()->highlight('red') . PHP_EOL);
$speed = isset($argv[2]) && is_numeric($argv[2]) ? (int)$argv[2] : 50000;
$maxGeneration = isset($argv[3]) && is_numeric($argv[3]) ? (int)$argv[3] : 0;

$gameOfLife = new GameOfLife();
$gameOfLife->setWidth(32);
$gameOfLife->setHeight(32);
$gameOfLife->setSpeed($speed);
$gameOfLife->setMaxGeneration($maxGeneration);
$gameOfLife->handle();