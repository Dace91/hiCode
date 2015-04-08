<?php namespace Card\Library;

use Services\Connect;

class DBStorage implements Storable
{

    /**
     * storage DB
     * 
     * @var pdo
     */
    protected $pdo = null;

    /**
     * name table to storage
     * 
     * @var string
     */
    protected $table; // product

    public function __construct($table = 'products')
    {

        $this->table = $table;
        $this->pdo = Connect::getDB();
    }

    /**
     * setter to update table
     * 
     * @param string $name
     * @param float $value
     * @return boolean
     */
    public function setValue($name, $value)
    {
        $sql = sprintf(
                "UPDATE %s SET total=total+'%d' WHERE name='%s';"
                , $this->table
                , $value
                , $name
        );
        return $this->pdo->query($sql);
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    public function getValue($name)
    {
        $sql = sprintf(
                "SELECT total FROM %s WHERE name='%s';"
                , $this->table
                , $name
        );
        $stmt = $this->pdo->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * to delete product 
     * 
     * @param string $name
     * @return boolean
     */
    public function delete($name)
    {
        $sql = sprintf(
                "UPDATE %s SET total=0 WHERE name='%s';"
                , $this->table
                , $name
        );
        return $this->pdo->query($sql);
    }

    /**
     * total
     * 
     * @return boolean
     */
    public function total()
    {
        $sql = sprintf(
                "SELECT SUM(total) FROM %s;"
                , $this->table
        );
        return $this->pdo->query($sql);
    }

    /**
     * reset all product
     * 
     * @return boolean
     */
    public function reset(){
        $sql = sprintf(
                "UPDATE %s SET total=0;"
                , $this->table
        );
        return $this->pdo->query($sql);
    }
}
