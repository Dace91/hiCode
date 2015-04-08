<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 21/01/15
 * Time: 15:01
 */

namespace Hangman;


class Game {

    const MAX_ATTEMPTS = 10;

    private $word;
    private $attempts=0;

    public function __construct(Word $word){

        $this->word = $word;

    }

    public function getRemainingAttempts()
    {
        return self::MAX_ATTEMPTS - $this->attempts;
    }

    public function tryLetter($letter)
    {
        $result = $this->word->tryLetter($letter);

        if(!$result){
            $this->attempts++;
        }

        return $result;
    }

    public function isLetterFound($letter)
    {
        return in_array($letter, $this->word->getlettersFound());
    }


    public function tryWord($word)
    {

        if($word === $this->word->getWord())
        {
            return true;
        }

        $this->attempts++;

        return false;

    }

    /**
     * @return Word
     */
    public function getWord()
    {
        return $this->word;
    }




}