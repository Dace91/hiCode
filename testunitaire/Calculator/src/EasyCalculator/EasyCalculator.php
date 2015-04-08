<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 23/01/15
 * Time: 15:49
 */

namespace EasyCalculator;


class EasyCalculator
{
    /**
     * @var string
     */
    protected $result = 'neutral';

    /**
     * @var null
     */
    protected $symbol;

    /**
     * @return int
     */
    public function getResult()
    {
        $r = ($this->result === 'neutral') ? 0 : $this->result;
        return $r;
    }

    /**
     * @param ...$numbers
     */
    public function add(...$numbers)
    {
        $this->calculate($numbers, '+');
    }

    public function subtract(...$numbers)
    {
        $this->calculate($numbers, '-');
    }

    /**
     * @param $numbers
     * @param $symbol
     */
    protected function calculate($numbers, $symbol)
    {
        foreach ($numbers as $number) {
            $this->calcul($number, $symbol);
        }
    }

    /**
     * @param array string
     */
    protected function calcul($number, $symbol)
    {

        if (!is_numeric($number)) {
            throw new \InvalidArgumentException(sprintf('this (%s) is not a number ', $number));
        }

        switch ($symbol) {

            case '+':
                $this->result = ($this->result === 'neutral') ? $number : $this->result + $number;
                break;

            case '-':
                $this->result = ($this->result === 'neutral') ? $number : $this->result - $number;
                break;

            case '*':
                $current = ($this->result === 'neutral') ? 1 : $this->result;
                $this->result = $number * $neutral;
                break;
        }
    }

    /**
     *
     */
    public function reset()
    {
        $this->result = 'neutral';
    }
}