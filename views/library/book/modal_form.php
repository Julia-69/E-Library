<?php
    require_once BASE_DIR . '/app/Models/Library/Genre.php';
    require_once BASE_DIR . '/app/Models/Library/Author.php';

    if (empty($isBookPage) && isset($book)) {
        unset($book);
    }
?>

<!-- Modal -->
<div class="modal fade" id="libraryBookModal" tabindex="-1" role="dialog" aria-labelledby="libraryBookModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="libraryBookModalLabel">Параметри книги</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger hidden" role="alert"></div>

        <!-- Form -->
        <form id="bookForm" action="#" method="POST">
            <input type="hidden" class="form-control" name="book_id" value="<?=isset($book['id']) ? htmlspecialchars($book['id']) : '' ?>" />

            <div class="form-group">
                <label for="bookName">Назва (*)</label>
                <input type="text" class="form-control input-lg" id="bookName" placeholder="Введіть назву" name="book[name]" value="<?=isset($book['name']) ? htmlspecialchars($book['name']) : '' ?>" />
            </div>
            <div class="form-group">
                <label for="bookISBN">ISBN</label>
                <input type="text" class="form-control" id="bookISBN" placeholder="Ввудіть код ISBN" name="book[isbn]" value="<?=isset($book['isbn']) ? htmlspecialchars($book['isbn']) : '' ?>" />
            </div>
            <div class="form-group">
                <label for="bookPrice">Ціна</label>
                <input type="number" class="form-control" id="bookPrice" placeholder="Введіть вартість" name="book[price]" value="<?=isset($book['price']) ? htmlspecialchars($book['price']) : '' ?>" />
            </div>
            <div class="form-group">
                <label for="bookPages">Сторінки</label>
                <input type="number" class="form-control" id="bookPages" placeholder="Введіть к-ть сторінок" name="book[pages]" value="<?=isset($book['pages']) ? htmlspecialchars($book['pages']) : '' ?>" />
            </div>
            <div class="form-group">
                <label for="bookGenre">Жанр (*)</label>
                <select id="bookGenre" class="form-control" name="book[genre_id]">
                    <option value="">---</option>
                    <?php foreach ((new Genre)->all() as $genre): ?>
                        <option value="<?=$genre['id'] ?>" <?=isset($book['genre_id']) && $book['genre_id'] == $genre['id'] ? 'selected="selected"' : '' ?>><?=$genre['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bookAuthor">Автор (*)</label>
                <select id="bookAuthor" class="form-control" name="book[author_id]">
                    <option value="">---</option>
                    <?php foreach ((new Author)->all() as $author): ?>
                        <option value="<?=$author['id'] ?>" <?=isset($book['author_id']) && $book['author_id'] == $author['id'] ? 'selected="selected"' : '' ?>><?=$author['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveBook" type="button" class="btn btn-danger">Зберегти</button>
      </div>
    </div>
  </div>
</div>