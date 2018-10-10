<?php

class Database
{
    public function __construct($pdo)
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

    public function select($query)
    {
        $satement = $this->pdo->prepare($query);
        $satement->execute();

        return $satement->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($data)
    {
        $query = sprintf('insert into users (%s) values (%s)', implode(', ', array_keys($this->filterInput($data))), implode(', ', $this->makePlaceholder($data)));
        $statement = $this->pdo->prepare($query);
        $data = $this->filterInput($data);
        $statement->execute($data);
        return redirect();
    }

    public function update($data)
    {
        $query = sprintf('update users set %s where id = %s', implode(', ', $this->updateInput($this->filterInput($data))), $data['id']);
        $statement = $this->pdo->prepare($query);
        $data = $this->filterInput($data);
        $statement->execute($data);
        return redirect();
    }

    public function delete($data)
    {
        $query = sprintf('delete from users where id = %s', $data['id']);
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return redirect();
    }
}
