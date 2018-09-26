<?php
namespace App;
/**
 * Class GameOfLife
 * @package App
 */
class GameOfLife
{
    /**
     * width size.
     * @var int
     */
    private $width = 32;
    /**
     * height size.
     * @var int
     */
    private $height = 32;

    /**
     * this generation.
     * @var int
     */
    private $generation = 1;

    /**
     * after generation.
     * @var array
     */
    private $map = [];

    /**
     * before generation.
     * @var array
     */
    private $oldMap = [];

    /**
     * neighbor map
     * @var array
     */
    private $neighborMap = [
        [-1,-1],
        [0,-1],
        [+1,-1],
        [-1,0],
        [+1,0],
        [-1,+1],
        [0,+1],
        [+1,+1]
    ];

    /**
     * Maximum generation. 0=unlimited.
     * @var int
     */
    private $maxGeneration = 0;

    /**
     * generation create speed microsecond.
     * @var int
     */
    private $speed = 50000;

    /**
     * die or live character.
     * @var array
     */
    public $character = ['.','*'];

    /**
     * Process if run? 1=yes,0=no.
     * @var int
     */
    private $run = 1;


    /**
     * loop create generation.
     * @echo boolean
     */
    public function handle()
    {
        while($this->run){
            if($this->generation !== 0 && $this->maxGeneration != 0 && $this->generation > $this->maxGeneration){
                $this->run = 0;
                continue;
            }
            system("clear");
            echo $this->generation.". Generation\n";
            foreach($this->createGeneration() as $generation){
                foreach($generation as $p){
                    echo $this->character[$p];
                }
                echo "\n";
            }
            usleep($this->speed);
        }
    }


    /**
     * create generation.
     * @return array
     */
    public function createGeneration() : array
    {
        $this->generation++;
        $this->firstMap = $this->oldMap;
        $this->oldMap = $this->map;
        for($a=1; $a<=$this->width; $a++){
            for($b=1; $b<=$this->height; $b++){
                if(!isset($this->map[$a][$b])){
                    // live or die.
                    $this->map[$a][$b] = ($a == $this->width || $a == 1) || ($b == 1 || $b == $this->height) ? 0 : rand(0,1);
                }else{
                    $liveCount = $this->neighbor($a,$b);

                    //Any live cell with fewer than two live neighbours dies, as if caused by underpopulation.
                    if($liveCount < 2){
                        $this->map[$a][$b] = 0;
                    }


                    //Any live cell with more than three live neighbours dies, as if by overcrowding.
                    if($liveCount > 3){
                        $this->map[$a][$b] = 0;
                    }


                    //Any live cell with two or three live neighbours lives on to the head generation.
                    if(($liveCount == 2 || $liveCount == 3) && $this->map[$a][$b] == 1){
                        $this->map[$a][$b] = 1;
                    }


                    //Any dead cell with exactly three live neighbours becomes a live cell.
                    if($liveCount == 3 && $this->map[$a][$b] == 0){
                        $this->map[$a][$b] = 1;
                    }


                    if(($a == $this->width || $a == 1) || ($b == 1 || $b == $this->height)){
                        $this->map[$a][$b] = 0;
                    }
                }
            }
        }

        return $this->map;
    }

    /**
     * find neighbors.
     * @param $y
     * @param $x
     * @return int
     */
    private function neighbor($y,$x) : int
    {
        $liveCount = 0;
        foreach($this->neighborMap as $variation){
            if($this->oldMap[$y+($variation[0])][$x+($variation[1])]){
                $liveCount++;
            }
        }
        return $liveCount;
    }

    /**
     * set Width integer.
     * @param $width number
     * @throws \InvalidArgumentException
     */
    public function setWidth($width)
    {
        if(!is_numeric($width) || $width < 4){
            throw new \InvalidArgumentException("Width cannot be anything other than number and cannot be less than 4");
        }
        $this->width = (int)$width;
    }

    /**
     * set Height integer.
     * @param $height number
     * @throws \InvalidArgumentException
     */
    public function setHeight($height)
    {
        if(!is_numeric($height) || $height < 8){
            throw new \InvalidArgumentException("Height cannot be anything other than number and cannot be less than 8");
        }
        $this->height = (int)$height;
    }

    /**
     * set Speed microsecond.
     * @param $speed number
     * @throws \InvalidArgumentException
     */
    public function setSpeed($speed)
    {
        if(!is_numeric($speed)){
            throw new \InvalidArgumentException("must be speed integer.");
        }
        $this->speed = (int)$speed;
    }

    /**
     * set Max Generation
     * @param $maxGeneration number
     * @throws \InvalidArgumentException
     */
    public function setMaxGeneration($maxGeneration)
    {
        if(!is_numeric($maxGeneration)){
            throw new \InvalidArgumentException("must be integer or infinite 0.");
        }
        $this->maxGeneration = (int)$maxGeneration;
    }


    /**
     * get parameter.
     * @param $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        if(!isset($this->{$name}) || !in_array($name,['width','height','speed','maxGeneration'])){
            throw new \InvalidArgumentException($name." no parameter.");
        }

        return $this->{$name};
    }

    /**
     * Reset class.
     */
    public function reset(){
        $this->width = 32;
        $this->height = 32;
        $this->speed = 50000;
        $this->maxGeneration = 0;
        $this->map = [];
        $this->oldMap = [];
        $this->generation = 0;
        $this->run = 1;
    }
}