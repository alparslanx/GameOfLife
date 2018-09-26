<?php
/**
 * Created by PhpStorm.
 * User: auyar
 * Date: 26.09.2018
 * Time: 17:54
 */

namespace App;

/**
 * Class GameOfLifeOutputFormat
 * @package App
 */
class GameOfLifeOutputFormat
{
    /**
     * die or live character.
     * @var array
     */
    const CHARACTERS = ['.','*'];

    /**
     * @param $method
     * @param $data
     * @return mixed
     */
    public static function get($method,$data)
    {
        if(!method_exists(self::class,'to'.ucwords($method))){
            throw new \RuntimeException($data." not found method.");
        }

        return self::{'to'.$method}($data);
    }


    /**
     * data to array
     * @param $data
     * @return array
     */
    private static function toArray($data): array
    {
        return $data;
    }

    /**
     * @param $data
     */
    private static function toTerminal($data)
    {
        system("clear");
        echo GameOfLife::$generation.". Generation\n";
        foreach($data as $generation){
            foreach($generation as $p){
                echo self::CHARACTERS[$p];
            }
            echo "\n";
        }
        usleep(GameOfLife::$speed);
    }
}