<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php if ($errors): ?>
            <div class="alert alert-danger" role="alert">
            <?php foreach($errors as $error): ?>
                <?php echo $error ?><br />
            <?php endforeach ?>
            </div>
        <?php endif ?>
        <form class="form-horizontal" method="post" action="<?php echo $app->router->path('login') ?>">
            <div class="form-group <?php echo isset($errors['login']) ? 'has-error' : '' ?>">
                <label class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" name="login" class="form-control" placeholder="Логин" value="<?php echo @$values['login'] ?>">
                </div>
            </div>
            <div class="form-group <?php echo isset($errors['pass']) ? 'has-error' : '' ?>">
                <label class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" name="pass" class="form-control" placeholder="Пароль" value="<?php echo @$values['pass'] ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Войти</button>
                </div>
            </div>
        </form>
    </div>
</div>