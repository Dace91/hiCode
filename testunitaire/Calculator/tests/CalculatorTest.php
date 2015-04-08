<?php

use Calculator\Calculator;
use Calculator\Addition;
use Calculator\Multiplication;
use Calculator\Subtraction;
use Calculator\Division;
use Calculator\Power;


class CalculatorTest extends PHPUnit_Framework_TestCase
{

    protected $calculator;

    public function setUp()
    {
        $this->calculator = new Calculator;
    }

    /**
     * @test test the neutral element for Addition
     */
    public function testNeutralElementAddition()
    {
        $this->calculator->setOperation(new Addition);
        $this->assertEquals(0, $this->calculator->getResult());

    }

    /**
     * @test test the neutral element for Multiplication
     */
    public function testNeutralElementMultiplication()
    {
        $this->calculator->setOperation(new Multiplication());
        $this->assertEquals(1, $this->calculator->getResult());
    }

    /**
     * @test add number
     */
    public function testAddNumbers()
    {
        $this->calculator->setOperands(5, 6, 7, 8);
        $this->calculator->setOperation(new Addition);

        $this->calculator->calculate();

        $this->assertEquals(26, $this->calculator->getResult());
    }

    /**
     * @test add one value
     *
     * @dataProvider listNumericOneValue
     */
    public function testAddOneValue($elem)
    {
        $this->calculator->setOperands($elem);
        $this->calculator->setOperation(new Addition);

        $this->calculator->calculate();

        $this->assertEquals($elem, $this->calculator->getResult());
    }


    /**
     * list numeric one value
     */
    public function listNumericOneValue()
    {
        return [[15], [100] , [200], [0]];
    }

    /**
     * @test add one value
     *
     * @dataProvider listNumericOneValue
     */
    public function testAddOneValue2($elem)
    {
        $this->calculator->setOperands($elem);
        $this->calculator->setOperation(new Multiplication);

        $this->calculator->calculate();

        $this->assertEquals($elem, $this->calculator->getResult());
    }

    /**
     *
     * @test a number must be a numeric value
     *
     * @expectedException InvalidArgumentException
     */
    public function testRequireNumberValue()
    {
        $this->calculator->setOperands('five');
        $this->calculator->setOperation(new Addition);

        $this->calculator->calculate();
    }

    /**
     *
     * @test a number must be a numeric value in list value
     *
     * @expectedException InvalidArgumentException
     */
    public function testRequireNumberIntoTheListValues()
    {
        $this->calculator->setOperands(1,2,3,'five');
        $this->calculator->setOperation(new Addition);

        $this->calculator->calculate();
    }

    /**
     * @test multiplication
     */
    public function testMultiplication()
    {
        $this->calculator->setOperands(5, 6, 7, 8);
        $this->calculator->setOperation(new Multiplication);

        $this->calculator->calculate();

        $this->assertEquals(1680, $this->calculator->getResult());
    }

    /**
     * @test subtract
     */
    public function testSubtract()
    {
        $this->calculator->setOperands(5, 6, 7, 8);
        $this->calculator->setOperation(new Subtraction);

        $this->calculator->calculate();

        $this->assertEquals(-16, $this->calculator->getResult());
    }

    /**
     * @test division
     */
    public function testDivision()
    {
        $this->calculator->setOperands(15, 3);
        $this->calculator->setOperation(new Division);

        $this->calculator->calculate();

        $this->assertEquals(5, $this->calculator->getResult());
    }

    /**
     * @test division
     *
     * @dataProvider listNumeric
     */
    public function testDivisionMultiple($a, $b, $c, $d, $expected)
    {

        $this->calculator->setOperands($a, $b, $c, $d);
        $this->calculator->setOperation(new Division);

        $this->calculator->calculate();

        $this->assertEquals($expected, $this->calculator->getResult());
    }

    /**
     * list numeric
     */
    public function listNumeric()
    {
        return [[15, 3, 5, 1, 1], [100, 2, 10, 5, 1] , [200, 10, 2, 2, 5]];
    }

    /**
     * @test impossible division by zero
     *
     *  @expectedException InvalidArgumentException
     */
    public function testDivisionByZero()
    {
        $this->calculator->setOperands(10,0);
        $this->calculator->setOperation(new Division);

        $this->calculator->calculate();

    }


    /**
     * @test impossible division by zero second test with message
     *
     */
    public function testDivisionByZeroWithMessage()
    {
        $this->setExpectedException('InvalidArgumentException', 'division by zero impossible!');
        $this->calculator->setOperands(10,0);
        $this->calculator->setOperation(new Division);

        $this->calculator->calculate();

    }

    /**
     * @test impossible division by zero just one value
     *
     */
    public function testDivisionByZeroWithMessageOneValue()
    {
        $this->calculator->setOperands(0);
        $this->calculator->setOperation(new Division);

        $this->calculator->calculate();

        $this->assertEquals(0, $this->calculator->getResult());

    }

    /**
     * @test power 
     *
     */
    public function testPowerNumber()
    {
        $this->calculator->setOperands(2,3,2,2);
        $this->calculator->setOperation(new Power);

        $this->calculator->calculate();

        $this->assertEquals(4096, $this->calculator->getResult());

    }

}