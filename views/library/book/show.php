<?php include BASE_DIR . '/views/layouts/header.php' ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">
                <div class="book-details"><!--book-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-book">
                                <img src="/public/images/books/placeholder.jpg" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="book-information"><!--/book-information-->
                                <h2><?php echo $book['name']; ?></h2>
                                <p><b>Жанр:</b> <?php echo $genre['name']; ?></p>
                                <p><b>Автор:</b> <?php echo $author['name']; ?></p>
                                <p><b>Код книги:</b> <?php echo $book['isbn']; ?></p>
                                <p><b>Сторінки:</b> <?php echo $book['pages']; ?></p>
                                <p><b>Ціна:</b> ₴<?php echo $book['price']; ?></p>
                                <div>
                                    <a href="#" data-id="<?php echo $book['id']; ?>"
                                       class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>В корзину
                                    </a>
                                </div>
                            </div><!--/book-information-->
                        </div>
                    </div>
                </div><!--/book-details-->
            </div>

        </div>
    </div>
</section>

<?php include BASE_DIR . '/views/layouts/footer.php' ?>
