<?php

namespace Library;

class Card
{

    protected $storage;

    // on fait une composition pour le storage
    public function __construct(Storable $storage)
    {
        $this->storage = $storage;
    }

    /**
     * buy
     * 
     * @param object $product
     * @param int $quantity
     */
    public function buy(Productable $product, $quantity)
    {
        $quantity = abs((int) $quantity);
        $this->storage->setValue($product->getName(), $product->getPrice() * $quantity);
    }

    /**
     * restore
     * 
     * @param Product $product
     * @param int $quantity
     * 
     * <pre>put one more or less to storage</pre>
     *
     */
    public function restore(Productable $product, $quantity)
    {

        $value = $this->storage->getValue($product->getName());

        if ($value > 0) {
            $q = - ((int) $quantity) * $product->getPrice();

            if (abs($q) > $value) {
                $this->storage->setValue($product->getName(), -$value);
                return;
            }

            $this->storage->setValue($product->getName(), $q);
        }
    }

    /**
     * delete
     * 
     * @param Product $product
     * @param int $quantity
     * @return \Card
     */
    public function delete(Productable $product)
    {
        $this->storage->delete($product->getName());
        return $this;
    }

    /**
     * bill
     * 
     * @return int 
     * 
     * <pre>a bill of card</pre>
     */
    public function total()
    {
        return $this->storage->total();
    }

    /**
     * 
     * 
     * @return NULL 
     * 
     * <pre>reset storage</pre>
     */
    public function reset()
    {
        return $this->storage->reset();
    }

}
