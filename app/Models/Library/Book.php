<?php

require_once BASE_DIR . '/app/Models/AbstractModel.php';

class Book extends AbstractModel
{
    protected $table = 'book';

    protected $genreId = null;

    protected $authorId = null;

    public function setGenreId($genreId)
    {
        $this->genreId = (int)$genreId;

        return $this;
    }

    public function getGenreId()
    {
        return $this->genreId;
    }

    public function setAuthorId($authorId)
    {
        $this->authorId = (int)$authorId;

        return $this;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function get()
    {
        $where = [];
        $data = [];

        if ($genreId = $this->getGenreId()) {
            $where[] = 'bg.genre_id = :genre_id';
            $data['genre_id'] = $genreId;
        }

        if ($authorId = $this->getAuthorId()) {
            $where[] = 'ba.author_id = :author_id';
            $data['author_id'] = $authorId;
        }

        $query = "SELECT b.*, bg.genre_id, ba.author_id
            FROM `{$this->getTable()}` AS b
            LEFT JOIN `book_genre` AS bg ON bg.book_id = b.id
            LEFT JOIN `book_author` AS ba ON ba.book_id = b.id";

        if ($where) {
            $query .= ' WHERE ' . join(' AND ', $where);
        }

        $books = $this->getPdo()->prepare($query);
        $books->execute($data);

        return $books->fetchAll();
    }

    public function find($id)
    {
        $query = "SELECT b.*, bg.genre_id, ba.author_id
            FROM `{$this->getTable()}` AS b
            LEFT JOIN `book_genre` AS bg ON bg.book_id = b.id
            LEFT JOIN `book_author` AS ba ON ba.book_id = b.id
            WHERE b.`id` = ? LIMIT 1";

        $item = $this->getPdo()->prepare($query);

        $item->execute([$id]);

        return $item->fetch();
    }

    public function create($data)
    {
        if (isset($data['genre_id'])) {
            $genreId = $data['genre_id'];
            unset($data['genre_id']);
        }

        if (isset($data['author_id'])) {
            $authorId = $data['author_id'];
            unset($data['author_id']);
        }

        if ($bookId = parent::create($data)) {
            $pdo = $this->getPdo()
                ->prepare("INSERT INTO `book_genre` SET genre_id = ?, book_id = ?");

            $pdo->execute([$genreId, $bookId]);

            $pdo = $this->getPdo()
                ->prepare("INSERT INTO `book_author` SET author_id = ?, book_id = ?");

            $pdo->execute([$authorId, $bookId]);
        }

        return $bookId;
    }

    public function update($id, $data)
    {
        if (isset($data['genre_id'])) {
            $genreId = $data['genre_id'];
            unset($data['genre_id']);
        }

        if (isset($data['author_id'])) {
            $authorId = $data['author_id'];
            unset($data['author_id']);
        }

        $result = parent::update($id, $data);

        $pdo = $this->getPdo()
            ->prepare("UPDATE `book_genre` SET genre_id = ? WHERE book_id = ?");

        $pdo->execute([$genreId, $id]);

        $pdo = $this->getPdo()
            ->prepare("UPDATE `book_author` SET author_id = ? WHERE book_id = ?");

        $pdo->execute([$authorId, $id]);

        return $result;
    }
}
