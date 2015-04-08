<?php

use Hangman\Game;
use Hangman\Word;

class GameTest extends  \PHPUnit_Framework_TestCase{


    protected $game;

    protected function setUp()
    {
        $this->game = new Game(new Word('phpunit'));
    }

   /**
     * @test if letter exist into the word
     *
     * @dataProvider listGoodWords
     */
    public function testIsLetterFound($letter)
    {

        $this->game->tryLetter($letter);

        $this->assertTrue($this->game->isLetterFound($letter));

    }

    public function listGoodWords()
    {
        return [['p'],['h'],['p'],['u'],['n'],['i'],['t']];
    }

    public function listBadWords()
    {
        return [['g'],['x'],['z'],['q'],['l'],['o'],['w']];
    }
    /**
     * @test if letter is not into the word
     *
     * @dataProvider listBadWords
     */
    public function testIsLetterNotFound($letter)
    {

        $this->game->tryLetter($letter);

        $this->assertFalse($this->game->isLetterFound($letter));

    }

    /**
     * @test isWon
     */
    public function testGameIsWon()
    {

        $this->assertTrue($this->game->tryWord('phpunit'));

    }

    /**
     * @test if number attempt is equal 10 when start a new game
     */

    public function testGetRemainingAttemptsAtStart()
    {
        $this->assertEquals(Game::MAX_ATTEMPTS, $this->game->getRemainingAttempts());
    }

    /**
     * @test decrement attempts
     */

    public function testDecrementAttempts()
    {
        $this->game->tryLetter('j');
        $this->game->tryLetter('g');
        $this->game->tryLetter('a');
        $this->game->tryLetter('z');

        $this->assertEquals(6, $this->game->getRemainingAttempts());

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
     */

    public function testDecrementOneToTestDependObject($game)
    {
        $game->tryLetter('x');
        $this->assertEquals(8, $game->getRemainingAttempts());

    }

    /**
     * @test a test skipped the code has not been implemented yet
     */

    public function testSkipped()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

}