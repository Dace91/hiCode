<?php

use Card\Library\Card;
use Card\Library\Product;
use Card\Library\Storable;

class CardMockTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->apple = new Product('apple', 950);
        $this->raspberry = new Product('raspberry', 45);
        $this->storage = $this->getMock('Library\Storable');
        $this->card = new Card($this->storage);
    }

    public function testMockBuyProduct()
    {

        // je teste le fait que la méthode setValue est appelée qu'une seule fois dans le panier Card
        $this->storage->expects($this->once())->method('setValue');

        // testons maintenant que la deuxième méthode a être appelé est bien total, offset 1
        $this->storage->expects($this->at(1))->method('total');

        $this->storage->expects($this->never())->method('delete');

        $this->card->buy($this->apple, 2);

        $this->card->total();
    }

    public function testMockStub()
    {
        $quantity = 100;
        $price = 1500.60;

        $totalTest = $quantity * $price;

        $this->apple->setPrice($price);

        $this->storage->expects($this->any())->method('total')->will($this->returnValue($totalTest));

        //$this->card->buy($this->apple, 100);

        $this->assertEquals($totalTest, $this->card->total());
    }

    public function testMockStub2()
    {
        $quantity = 100;
        $price = 1500.60;

        $totalTest = $quantity * $price;

        $this->apple->setPrice($price);

        $this->storage->expects($this->once())->method('setValue')->with($this->apple->getName(), $totalTest);

        $this->card->buy($this->apple, 100);

        // valeur attendu de retour
        $this->storage->expects($this->once())->method('total')->will($this->returnValue($totalTest));

        $this->assertEquals($totalTest, $this->card->total());
    }

    /** @dataProvider listData */
    public function testTotal($price, $quantity, $total)
    {
        $this->apple->setPrice($price);

        $this->storage->expects($this->once())->method('setValue')->with($this->apple->getName(), $total);

        $this->card->buy($this->apple, $quantity);

        $this->storage->expects($this->once())->method('total')->will($this->returnValue($total));

        $this->assertEquals($total, $this->card->total());
    }

    public function listData()
    {
        return [[10, 2, 20], [12, 7, 84], [21, 3, 63]];
    }

    public function testOrdreAt()
    {

        $totalOne = 100;
        $totalTwo = 200;

        $this->storage->expects($this->at(0))->method('total')->will($this->returnValue($totalOne));
        
        $this->storage->expects($this->at(1))->method('reset');
        
        $this->assertEquals($totalOne, $this->card->total());
        
        $this->storage->reset();
        
    }

}
