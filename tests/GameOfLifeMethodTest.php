<?php
namespace App;
use App\GameOfLife;
use PHPUnit\Framework\TestCase;
class GameOfLifeMethodTest extends TestCase{


    /**
     * Test Response Array Count output.
     */
    public function testHandleArrayCount()
    {
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setMaxGeneration(5);
        $GameOfLife->setResponseType('array');
        $array = $GameOfLife->handle();

        $this->assertEquals(count($array),5);
    }


    /**
     * Test Array output.
     */
    public function testHandleArray()
    {
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setMaxGeneration(5);
        $GameOfLife->setResponseType('terminal');
        $array = $GameOfLife->handle();
        $this->assertInternalType('array',$array);
    }


    /**
     * Test Terminal output.
     */
    public function testHandleTerminal()
    {
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setMaxGeneration(5);
        $GameOfLife->handle();
        $this->expectOutputRegex("[^\.|^\*|^\\n|(.*). Generation]");
    }


    /**
     * Test set.
     */
    public function testSet()
    {
        $GameOfLife = new GameOfLife(500,250);
        $GameOfLife->setSpeed(50);
        $GameOfLife->setMaxGeneration(100);


        $this->assertEquals($GameOfLife->__get('width'), 500, 'setWidth Problem.');
        $this->assertEquals($GameOfLife->__get('height'), 250, 'setHeight Problem.');
        $this->assertEquals(GameOfLife::$speed, 50, 'setSpeed Problem.');
        $this->assertEquals($GameOfLife->__get('maxGeneration'), 100, 'setMaxGeneration Problem.');
    }


    /**
     * Test reset.
     */
    public function testReset()
    {
        $GameOfLife = new GameOfLife(32,32);

        $originalWidth = $GameOfLife->__get('width');
        $originalHeight = $GameOfLife->__get('height');
        $originalSpeed = GameOfLife::$speed;
        $originalMaxGeneration = $GameOfLife->__get('maxGeneration');

        $GameOfLife->setWidth(500);
        $GameOfLife->setHeight(250);
        $GameOfLife->setSpeed(50);
        $GameOfLife->setMaxGeneration(100);

        $GameOfLife->reset();

        $this->assertEquals($originalWidth, $GameOfLife->__get('width'), 'setWidth Reset Problem.');
        $this->assertEquals($originalHeight, $GameOfLife->__get('height'), 'setHeight Reset Problem.');
        $this->assertEquals($originalSpeed, GameOfLife::$speed, 'setSpeed Reset Problem.');
        $this->assertEquals($originalMaxGeneration, $GameOfLife->__get('maxGeneration'), 'setMaxGeneration Reset Problem.');
    }


    /**
     * setWidth: Array Test.
     */
    public function testSetWidthArray()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setWidth([]);
    }

    /**
     * setHeight: Array Test.
     */
    public function testSetHeightArray()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setHeight([]);
    }


    /**
     * setSpeed: Array Test.
     */
    public function testSetSpeedArray()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setSpeed([]);
    }


    /**
     * setMaxGeneration: Array Test.
     */
    public function testSetMaxGenerationArray()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setMaxGeneration([]);
    }




    /**
     * setWidth: Empty Test.
     */
    public function testSetWidthEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setWidth('');
    }

    /**
     * setHeight: Empty Test.
     */
    public function testSetHeightEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setHeight('');
    }


    /**
     * setSpeed: Empty Test.
     */
    public function testSetSpeedEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setSpeed('');
    }


    /**
     * setMaxGeneration: Empty Test.
     */
    public function testSetMaxGenerationEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setMaxGeneration('');
    }

    /**
     * setWidth: String Test.
     */
    public function testSetWidth()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setWidth('test');
    }

    /**
     * setHeight: String Test.
     */
    public function testSetHeight()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setHeight('test');
    }


    /**
     * setSpeed: String Test.
     */
    public function testSetSpeed()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setSpeed('test');
    }


    /**
     * setMaxGeneration: String Test.
     */
    public function testSetMaxGeneration()
    {
        $this->expectException(\InvalidArgumentException::class);
        $GameOfLife = new GameOfLife(32,32);
        $GameOfLife->setMaxGeneration('test');
    }
}