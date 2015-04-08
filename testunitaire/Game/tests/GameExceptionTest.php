<?php

use Hangman\Game;
use Hangman\Word;

class GameExceptionTest extends  \PHPUnit_Framework_TestCase{


    protected $game;

    protected function setUp()
    {
        $this->game = new Game(new Word('phpunit'));
    }

    /**
     * @expectedException InvalidArgumentException
     *
     * @dataProvider listBadInvalidArg
     */
    public function testInvalidExceptionArg($letter)
    {
        $this->game->tryLetter($letter);
    }

    public function listBadInvalidArg()
    {
        return [
            [0],
            ['aaa'],
            ['hello']
        ];
    }

    /**
     * @test persistence of object $game into test
     */

    public function testPersistenceObjectGame()
    {
        $this->game->tryLetter('j');
        $this->assertEquals(9, $this->game->getRemainingAttempts());
        return $this->game;
    }

    /**
     * @test persistence depend a object $game test
     *
     * @depends testPersistenceObjectGame
     *
     * @expectedException \InvalidArgumentException
     */

    public function testInvalidExceptionSameValue($game)
    {
        //var_dump($game->getWord()->getLettersTried());
        $game->tryLetter('j');

    }


    public function testExceptionWithOutNotation(){

        $this->setExpectedException('\InvalidArgumentException', 'the letter "hello" is not valid character ');
        $this->game->tryLetter('hello');

        $this->setExpectedException('\InvalidArgumentException', 'the letter "0" is not valid character ');
        $this->game->tryLetter(0);

        $this->setExpectedException('\InvalidArgumentException', 'The letter "x" has already been tried.');
        $this->game->tryLetter('x');
        $this->game->tryLetter('x');

    }


}