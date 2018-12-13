<?php

namespace App\Core\Database;

class Database
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    protected function filterInput($data)
    {
        return array_filter($data, function ($param) {
            if ($param !== 'type' && $param !== 'id') {
                return $param;
            }
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function makePlaceholder($data)
    {
        return array_map(function ($param) {
            return ':' . $param;
        }, array_keys($this->filterInput($data)));
    }

    protected function updateInput($data)
    {
        array_walk($data, function (&$item, $key) {
            $item = $key . ' = :' . $key;
        });

        return $data;
    }

    public function all($table)
    {
        $query = sprintf('select * from (%s)', $table);
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function insert($table, $data)
    {
        $query = sprintf('insert into %s (%s) values (%s)', $table, implode(', ', array_keys($this->filterInput($data))), implode(', ', $this->makePlaceholder($data)));
        $statement = $this->pdo->prepare($query);
        $data = $this->filterInput($data);
        $statement->execute($data);
        return $statement;
    }

    public function update($table, $data)
    {
        $query = sprintf('update %s set %s where id = %s', $table, implode(', ', $this->updateInput($this->filterInput($data))), $data['id']);
        $statement = $this->pdo->prepare($query);
        $data = $this->filterInput($data);
        $statement->execute($data);
        
        return $statement;
    }

    public function delete($table, $data)
    {
        $query = sprintf('delete from %s where id = %s', $table, $data['id']);
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        
        return $statement;
    }

    public function verify($table, $col, $data)
    {
        $query = sprintf('select %s from %s where %s = "%s"', $col, $table, $col, $data);
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }
}
