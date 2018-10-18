<?php

require_once BASE_DIR . '/app/Models/Library/Author.php';
require_once BASE_DIR . '/app/Models/Library/Genre.php';
require_once BASE_DIR . '/app/Models/Library/Book.php';

class BookController
{
    protected $filterGenreId = null;

    protected $filterAuthorId = null;

    public function __construct()
    {
        if (! empty($_REQUEST['genre'])
            && is_numeric($_REQUEST['genre'])
        ) {
            $this->filterGenreId = max(0, $_REQUEST['genre']);
        }

        if (! empty($_REQUEST['author'])
            && is_numeric($_REQUEST['author'])
        ) {
            $this->filterAuthorId = max(0, $_REQUEST['author']);
        }
    }

    public function index()
    {
        $authors = (new Author)->all();
        $genres = (new Genre)->all();

        $books = (new Book)
            ->setGenreId($this->filterGenreId)
            ->setAuthorId($this->filterAuthorId)
            ->get();

        require BASE_DIR . '/views/library/book/index.php';
    }

    public function load()
    {
        $books = (new Book)
            ->setGenreId($this->filterGenreId)
            ->setAuthorId($this->filterAuthorId)
            ->get();

        require BASE_DIR . '/views/library/book/index/books.php';
    }

    public function show()
    {
        if (empty($_REQUEST['id']) || ! is_numeric($_REQUEST['id'])) {
            exit('404 Not found');
        }

        $isBookPage = true;
        $book = (new Book)->find($_REQUEST['id']);

        if (! $book || ! $book['id']) {
            exit('404 Not found');
        }

        $genre = (new Genre)->find($book['genre_id']);
        $author = (new Author)->find($book['author_id']);

        require BASE_DIR . '/views/library/book/show.php';
    }

    public function save()
    {
        $data = [
            'success' => true,
            'messages' => [],
        ];

        if (empty($_REQUEST['book']['name'])
            || empty($_REQUEST['book']['genre_id'])
            || empty($_REQUEST['book']['author_id'])
        ) {
            $data['success'] = false;
            $data['messages'][] = 'Не заповнені обов\'язкові поля';
        }

        if (isset($_REQUEST['book']['price'])
            && ! is_numeric($_REQUEST['book']['price'])
        ) {
            $data['success'] = false;
            $data['messages'][] = 'Ціна має бути числом';
        }

        if (isset($_REQUEST['book']['pages'])
            && ! is_numeric($_REQUEST['book']['pages'])
        ) {
            $data['success'] = false;
            $data['messages'][] = 'Cторінки мають бути числом';
        }

        if ($data['success']) {
            $bookModel = new Book;

            if (! empty($_REQUEST['book_id'])) {
                $bookModel->update(
                    $_REQUEST['book_id'],
                    $_REQUEST['book']
                );
            } else {
                $bookModel->create($_REQUEST['book']);
            }
        }

        echo json_encode($data);
    }

    public function remove()
    {
        $data = [
            'success' => false,
        ];

        if (! empty($_REQUEST['id'])) {
            $data['success'] = (new Book)->delete($_REQUEST['id']);
        }

        echo json_encode($data);
    }
}
