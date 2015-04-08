<?php namespace Library;

class Product implements Productable
{

    /**
     * name of product
     * 
     * @var string
     */
    protected $name;
    
    /**
     * price product
     * 
     * @var float
     */
    protected $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->setPrice($price);
    }

    /**
     *  return price
     * 
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = (float) $price;
        return $this;
    }

}
