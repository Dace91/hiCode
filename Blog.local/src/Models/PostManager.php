<?php

namespace Models;

use Services\AbstractModel;


class PostManager extends AbstractModel
{

    protected $table = 'posts';

    /**
     * 
     * save object User
     * 
     * @param Object 
     * @return boolean
     * @throws PDOException
     */
    public function save(Post $post)
    {

        $query = sprintf("
                INSERT INTO `{$this->table}` (title, user_id, content, date_created, status  )
                VALUES ('%s', %d, '%s')
                ", $post->title, $post->user_id, $post->content, $post->date_created, $post->status
        );

        return $this->pdo->query($query);
    }

    /**
     * <pre> return posts user</pre>
     * 
     * @param string $status
     * @return array
     */
    public function postsUser($status = 'publish')
    {
        $results = [];

        $query = sprintf("
                 SELECT p.id, p.title, u.username, p.user_id, p.excerpt
                 FROM `%s` as p 
                 INNER JOIN `users` as u 
                 ON p.user_id = u.id
                 WHERE status='%s';
            ", $this->table, $status
        );

        $stmt = $this->pdo->query($query);

        while ($data = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $results[] = $data;
        }
        return $results;
    }

    public function query($status)
    {
        $results = [];
        $query = sprintf("SELECT * FROM `posts` WHERE status='%s'", $status);
        
        $stmt = $this->pdo->query($query);
        while ($data = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $results[] = $data;
        }
        return $results;
    }

}
