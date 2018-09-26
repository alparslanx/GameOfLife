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
     * Maximum generation. 0=unlimited.
     * @var int
     */
    private $maxGeneration = 0;

    /**
     * responseType
     * @var string
     */
    private $outputType = 'terminal';

    /**
     * this generation count.
     * @var int
     */
    public static $generation = 0;


    /**
     * generation create speed microsecond.
     * @var int
     */
    public static $speed = 50000;

    /**
     * neighbor map
     * @var array
     */
    const NEIGHBOR_MAP = [
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
     * GameOfLife constructor.
     * @param $width
     * @param $height
     */
    public function __construct($width,$height)
    {
        $this->reset();
        $this->setWidth($width)->setHeight($height);
    }

    /**
     * handle data.
     * @return array
     */
    public function handle(): array
    {
        $map = [];
        while((self::$generation < $this->maxGeneration) || ($this->maxGeneration === 0)){
            if(self::$generation === 0){
                $generations = $this->createGeneration();
            }else{
                $generations = $this->nextGeneration();
            }
            self::$generation++;
            $map[] = GameOfLifeOutputFormat::get($this->outputType,$generations);
        }
        $this->reset();
        return $map;
    }


    /**
     * first create generation.
     * @return array
     */
    private function createGeneration(): array
    {
        for($a=1; $a<=$this->width; $a++) {
            for ($b = 1; $b <= $this->height; $b++) {
                // live or die.
                $this->map[$a][$b] = ($a == $this->width || $a == 1) || ($b == 1 || $b == $this->height) ? 0 : rand(0,1);
            }
        }

        return $this->map;
    }

    /**
     * nextGeneration.
     * @return array
     */
    private function nextGeneration(): array
    {
        $this->oldMap = $this->map;
        for($a=1; $a<=$this->width; $a++){
            for($b=1; $b<=$this->height; $b++){
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

        return $this->map;
    }

    /**
     * find neighbors.
     * @param $y
     * @param $x
     * @return int
     */
    private function neighbor($y,$x): int
    {
        $liveCount = 0;
        foreach(self::NEIGHBOR_MAP as $variation){
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
     * @return $this
     */
    public function setWidth($width): GameOfLife
    {
        if(!is_numeric($width) || $width < 4){
            throw new \InvalidArgumentException("Width cannot be anything other than number and cannot be less than 4");
        }
        $this->width = (int)$width;

        return $this;
    }

    /**
     * set Height integer.
     * @param $height number
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setHeight($height): GameOfLife
    {
        if(!is_numeric($height) || $height < 8){
            throw new \InvalidArgumentException("Height cannot be anything other than number and cannot be less than 8");
        }
        $this->height = (int)$height;

        return $this;
    }

    /**
     * set Speed microsecond.
     * @param $speed number
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setSpeed($speed): GameOfLife
    {
        if(!is_numeric($speed)){
            throw new \InvalidArgumentException("must be speed integer.");
        }
        self::$speed = (int)$speed;

        return $this;
    }

    /**
     * set Max Generation
     * @param $maxGeneration number
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setMaxGeneration($maxGeneration): GameOfLife
    {
        if(!is_numeric($maxGeneration)){
            throw new \InvalidArgumentException("must be integer or infinite 0.");
        }
        $this->maxGeneration = (int)$maxGeneration;

        return $this;
    }

    /**
     * @param $outputType
     * @return GameOfLife
     */
    public function setResponseType($outputType): GameOfLife
    {
        $this->outputType = $outputType;
        return $this;
    }


    /**
     * get parameter.
     * @param $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __get($name): bool
    {
        if(!isset($this->{$name}) || !in_array($name,['width','height','speed','maxGeneration','responseType'])){
            throw new \InvalidArgumentException($name." no parameter.");
        }

        return $this->{$name};
    }

    /**
     * Reset class.
     */
    public function reset()
    {
        $this->width = 32;
        $this->height = 32;
        $this->maxGeneration = 0;
        $this->map = [];
        $this->oldMap = [];
        $this->outputType = 'terminal';
        self::$generation = 0;
        self::$speed = 50000;
    }
}