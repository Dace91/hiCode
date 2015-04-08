<?php

use Library\Card;
use Library\Product;
use Tests\Fixtures\MockStorage;

class CardTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->apple = new Product('apple', 950);
        $this->raspberry = new Product('raspberry', 45);
        $this->storage = new MockStorage;
        //$this->storage = $this->getMock('Storable');
        $this->card = new Card($this->storage);
    }

    public function testMockTotal()
    {
        $this->card->buy($this->apple, 2);
        $this->assertEquals(1900, $this->card->total());
    }

    public function testReset()
    {
        $this->card->buy($this->apple, 2);
        $this->card->buy($this->apple, 3);

        $this->card->reset();
        $this->assertEquals(0, $this->card->total());
    }

    public function testDeleteOneProduct()
    {
        $this->card->buy($this->apple, 2);
        $this->card->buy($this->raspberry, 3);
        $this->assertEquals((950 * 2 + 3 * 45), $this->card->total());

        $this->card->delete($this->apple);
        $this->assertEquals((3 * 45), $this->card->total());
    }

    public function testRestoreQuantityProduct()
    {
        $this->assertEquals(0, $this->card->total());

        $this->card->buy($this->apple, 23);
        $this->assertEquals((950 * 23), $this->card->total());

        $this->card->buy($this->raspberry, 37);
        $this->assertEquals((950 * 23 + 37 * 45), $this->card->total());

        $this->card->restore($this->apple, 12);

        $this->assertEquals((37 * 45 + 950 * 11), $this->card->total());
    }

    public function testNegativePrice()
    {
        $this->card->buy($this->apple, -2);
        $this->assertEquals(abs(-2 * $this->apple->getPrice()), $this->card->total());
    }

    public function testBadTotal()
    {
        $this->card->buy($this->apple, 12);
        $this->card->restore($this->apple, 20);
        $this->assertEquals(0, $this->card->total());

        $this->card->buy($this->raspberry, 37);
        $this->card->restore($this->raspberry, 112);
        
        $this->card->buy($this->apple, 12);
        $this->assertEquals(12*$this->apple->getPrice(), $this->card->total());
    }
    
    public function testArrayKeyStorage()
    {
        $this->card->buy($this->apple, 2);
        $this->assertEquals(2*$this->apple->getPrice(), $this->storage->getValue('apple'));
    }

}
