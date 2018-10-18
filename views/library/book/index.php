<?php include BASE_DIR . '/views/layouts/header.php' ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Жанри</h2>
                    <div class="panel-group genres">
                        <?php foreach ($genres as $genre): ?>
                            <div class="panel panel-default <?=$genre['id'] == @$_REQUEST['genre'] ? 'active' : '' ?>" data-id="<?=$genre['id'] ?>">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="?genre=<?php echo $genre['id'];?>&author=<?php echo @$_REQUEST['author'] ?>">
                                            <?php echo $genre['name'];?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <br />
                    <h2>Автори</h2>
                    <div class="panel-group authors">
                        <?php foreach ($authors as $author): ?>
                            <div class="panel panel-default <?=$author['id'] == @$_REQUEST['author'] ? 'active' : '' ?>" data-id="<?=$author['id'] ?>">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="?genre=<?php echo @$_REQUEST['genre'] ?>&author=<?php echo $author['id'] ?>">
                                            <?php echo $author['name'];?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <br />
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Каталог книг</h2>
                    <div id="booksList">
                        <?php include BASE_DIR . '/views/library/book/index/books.php' ?>
                    </div>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

<?php include BASE_DIR . '/views/layouts/footer.php' ?>
