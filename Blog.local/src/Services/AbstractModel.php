<?php
namespace Services;

abstract class AbstractModel
{

    protected $pdo = null;
    protected $table;

    public function __construct()
    {
        $this->pdo = Connect::getDB();
    }

    /**
     * all() retourne l'ensemble des enregistrements de la table users
     * 
     * @return \User
     */
    public function all()
    {
        $results = [];

        $query = sprintf('
                SELECT *
                FROM `%s` ', $this->table
        );

        $stmt = $this->pdo->query($query);

        while ($data = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $results[] = $data;
            
        }
        return $results;
    }

    /**
     * find retourne un enregistrement
     * 
     * @return \User
     */
    public function find($id)
    {
        $results = [];

        $query = sprintf("
                SELECT *
                FROM `{$this->table}` 
                WHERE id=%d", $id
        );
        // gestion des erreurs PDOException
        $stmt = $this->pdo->query($query);
        while ($data = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $results[] = $data;
        }
        return $results;
    }

    abstract public function query($query);
    
}
