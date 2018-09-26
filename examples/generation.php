<?php
/**
 * Example with terminal: php generation.php 32x32 250 50000
 * 32x16 = width x height | requirement
 * 250 = maximum create generation
 * outputType = terminal or array
 * 50000 = new generation sleep microtime
 */
require_once __DIR__ . '/../vendor/autoload.php';
use App\GameOfLife;
use Colors\Color;

$c = new Color();
if(PHP_SAPI !== 'cli')
{
    echo $c('Please run with terminal. Example: php generation.php 32x32 5 terminal|array')->white()->bold()->highlight('red') . PHP_EOL;
}


$widthHeight = isset($argv[1]) && strstr($argv[1],'x') ? explode('x',$argv[1]) : die($c('Please send a WidthxHeight. Example: php generation.php 32x32 5 terminal|array')->white()->bold()->highlight('red') . PHP_EOL);
$maxGeneration = isset($argv[2]) && is_numeric($argv[2]) ? (int)$argv[2] : 0;
$outputType = isset($argv[3]) ? $argv[3] :  die($c('Please send a outputType. Example: php generation.php 32x32 5 terminal|array')->white()->bold()->highlight('red') . PHP_EOL);
$speed = isset($argv[4]) && is_numeric($argv[4]) ? (int)$argv[4] : 50000;



$GameOfLife = new GameOfLife($widthHeight[0],$widthHeight[1]);
$GameOfLife->setMaxGeneration($maxGeneration);
$GameOfLife->setSpeed($speed);
$GameOfLife->setResponseType($outputType);
if($outputType == 'array'){
    print_r($GameOfLife->handle());
}else{
    $GameOfLife->handle();
}