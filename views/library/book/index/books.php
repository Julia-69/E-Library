<?php foreach ($books as $book): ?>
    <div class="col-sm-4">
        <div class="book-image-wrapper">
            <div class="single-books">
                <div class="bookinfo text-center">
                    <img src="/public/images/books/placeholder.jpg" alt="" />
                    <h2><?php echo $book['name'];?></h2>
                    <p>
                        <a href="?route=book.show&id=<?php echo $book['id'];?>">
                            ₴<?php echo $book['price'];?>
                        </a>
                    </p>

                    <a href="?route=book.show&id=<?php echo $book['id'];?>"
                       class="btn btn-default add-to-cart">
                        <i class="fa fa-shopping-cart"></i>Деталі
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
