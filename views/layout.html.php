<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Блог</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $app->router->path('home') ?>">Блог</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($app->user->isAuthorized()): ?>
                        <li>
                            <a href="<?php echo $app->router->path('post.new') ?>">Добавить пост</a>
                        </li>
                    <?php endif ?>
                    <li>
                        <?php if ($app->user->isAuthorized()): ?>
                            <form action="<?php echo $app->router->path('logout') ?>" id="logout_form" method="post">
                            </form>
                            <a href="#" onclick="document.getElementById('logout_form').submit(); return false;">Выход</a>
                        <?php else: ?>
                            <a href="<?php echo $app->router->path('login') ?>">Вход</a>
                        <?php endif ?>
                    </li>
                </ul>
                <?php if ($app->user->isAuthorized()): ?>
                    <p class="navbar-text navbar-right"><?php echo $app->user->getLogin() ?></p>
                <?php endif ?>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>

    <div class="container">
        <?php echo $tpl_content ?>

        <hr>

        <footer>
            <p>&copy; Company 2015</p>
        </footer>
    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
</body>