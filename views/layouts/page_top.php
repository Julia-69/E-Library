<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#">+38 098 100 17 27</a></li>
                            <li><a href="#">yulia.good69@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class=""></i></a></li>
                            <li><a href="#"><i class=""></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="/"><img src="/public/images/top-logo.png" width="200" height="70" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="library-menu pull-right">
                        <ul class="nav navbar-nav">
                            <?php if (isset($isBookPage)): ?>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#libraryBookModal">
                                    <i class="fa fa-pencil"></i>
                                    Редагувати книгу
                                </button>
                                <button id="removeBook" type="button" class="btn btn-danger" data-id="<?=$book['id']?>">
                                    <i class="fa fa-trash-o"></i>
                                    Видалити книгу
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#libraryBookModal">
                                    <i class="fa fa-plus"></i>
                                    Додати книгу
                                </button>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Змінити навігацію</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/">Головна</a></li>
                            <li class="dropdown"><a href="#">Книги<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="#">Каталог книг</a></li>
                                    <li><a href="#">Корзина</a></li>
                                </ul>
                            </li>
                            <li><a href="?route=general.about">Про бібліотеку</a></li>
                            <li><a href="?route=general.contacts">Контакти</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->

</header><!--/header-->


