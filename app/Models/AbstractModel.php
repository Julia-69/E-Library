<?php

abstract class AbstractModel
{
    protected $table = null;

    private $pdo = null;

    public function getPdo()
    {
        if (null !== $this->pdo) {
            return $this->pdo;
        }

        $config = include BASE_DIR . '/app/config.php';

        try {
            $pdo = new PDO(
                "{$config['db']['type']}:dbname={$config['db']['dbname']};host={$config['db']['host']};charset=utf8",
                $config['db']['username'],
                $config['db']['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        // $pdo->exec('SET NAMES "utf8"');

        return $this->pdo = $pdo;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($name)
    {
        $this->table = $name;

        return $this;
    }

    public function all()
    {
        $items = $this->getPdo()
            ->query("SELECT * FROM {$this->getTable()}")
            ->fetchAll();

        return $items;
    }

    public function find($id)
    {
        $item = $this->getPdo()
            ->prepare("SELECT * FROM {$this->getTable()} WHERE `id` = ? LIMIT 1");

        $item->execute([$id]);

        return $item->fetch();
    }

    public function create($data)
    {
        if (! $set = $this->getDataSet($data)) {
            return false;
        }

        $pdo = $this->getPdo();
        $query = $pdo->prepare("INSERT INTO {$this->getTable()} SET $set");

        $query->execute($data);

        return $pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        if (! $set = $this->getDataSet($data)) {
            return false;
        }

        $pdo = $this->getPdo()
            ->prepare("UPDATE {$this->getTable()} SET {$set} WHERE id = :id");

        $pdo->execute(array_merge($data, ['id' => $id]));

        return $pdo->rowCount();
    }

    public function delete($id)
    {
        $pdo = $this->getPdo()
            ->prepare("DELETE FROM {$this->getTable()} WHERE id = ?");

        $pdo->execute([$id]);

        return $pdo->rowCount();
    }

    public function getDataSet($data)
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "`$key` = :$key";
        }

        $set = join(',', $set);

        return $set;
    }
}
