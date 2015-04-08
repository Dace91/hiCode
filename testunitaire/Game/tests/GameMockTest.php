<?php

use Hangman\Game;
use Hangman\Word;

class GameMockTest extends  \PHPUnit_Framework_TestCase{


    protected $game;
    protected $mock;

    protected function setUp()
    {
        $this->mock= $this->getMock('Hangman\Word', ['tryLetter'], ['phpunit']);
        $this->game = new Game($this->mock);
    }


    public function testMockObjectWordWithBadArgument()
    {

        $this->mock->method('tryLetter')
            ->will($this->throwException(new \InvalidArgumentException('the letter "hello" is not valid character ')));

        $this->setExpectedException('\InvalidArgumentException', 'the letter "hello" is not valid character ');
        $this->game->tryLetter('hello');
    }


    /**
     * @expectedException InvalidArgumentException
     *
     */
    public function testInvalidExceptionArg()
    {
        $this->mock->method('tryLetter')
            ->will($this->throwException(new \InvalidArgumentException));
        $this->game->tryLetter(1);
    }


    /**
     * @expectedException InvalidArgumentException
     *
     */
    public function testWordsAllReadyTried()
    {
        $this->mock->method('tryLetter')
            ->will($this->throwException(new \InvalidArgumentException('The letter "a" has already been tried.')));

        $this->game->tryLetter('a');
    }

    /**
     * @test decrement attempts
     */

    public function testDecrementAttempts()
    {

        $this->mock->expects($this->exactly(4))->method('tryLetter');

        $this->game->tryLetter('j');
        $this->game->tryLetter('g');
        $this->game->tryLetter('a');
        $this->game->tryLetter('x');

        $this->assertEquals(6, $this->game->getRemainingAttempts());

    }


}