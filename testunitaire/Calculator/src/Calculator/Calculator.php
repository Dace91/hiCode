<?php

namespace Calculator;


class Calculator
{

    protected $operands = [];
    protected $operation;
    protected $result = 'neutral';

    /**
     * set operands multiple
     *
     * @param ...$operands
     */
    public function setOperands(...$operands)
    {
        $this->operands = $operands;
    }

    /**
     *  set a new operation
     *
     * @param iOperator $operation
     */
    public function setOperation(iOperator $operation)
    {
        $this->operation = $operation;
    }

    /**
     * return result arithmetic operation
     *
     * @return int
     */
    public function getResult()
    {
        return $this->operation->getNumber($this->result);
    }

    /**
     *
     * @return Null
     */
    public function calculate()
    {

        if (count($this->operands) == 1) {

            if (!is_numeric($this->operands[0])) {
                throw new \InvalidArgumentException(sprintf('this (%s) is not a number ', $this->operands[0]));
            }
            $this->result = $this->operands[0];
            return;
        }

        foreach ($this->operands as $num) {

            if (!is_numeric($num)) {
                throw new \InvalidArgumentException(sprintf('this (%s) is not a number ', $num));
            }

            $this->result = $this->operation->run($num, $this->result);
        }

    }
}