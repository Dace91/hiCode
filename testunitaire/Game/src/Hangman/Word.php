<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 21/01/15
 * Time: 15:03
 */

namespace Hangman;

class Word
{

    private $word;
    private $lettersTried ;
    private $lettersFound ;

    public function __construct($word)
    {

        $this->word = $word;

    }

    public function __toString()
    {
        return $this->word;
    }

    public function tryLetter($letter)
    {
        $letter = strtolower($letter);

        if (0 === preg_match('/^[a-z]$/', $letter)) {
            throw new \InvalidArgumentException(sprintf('the letter "%s" is not valid character ', $letter));
        }

        if (in_array($letter, $this->lettersTried)) {
            throw new \InvalidArgumentException(sprintf('The letter "%s" has already been tried.', $letter));
        }

        if (false !== strpos($this->word, $letter)) {
            $this->lettersFound[] = $letter;
            return true;
        }

        $this->lettersTried[] = $letter;
        return false;

    }

    /**
     * @return array
     */
    public function getLettersFound()
    {
        return $this->lettersFound;
    }

    /**
     * @return mixed
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @return array
     */
    public function getLettersTried()
    {
        return $this->lettersTried;
    }

}