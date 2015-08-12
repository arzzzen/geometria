<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php if (@$errors): ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach($errors as $error): ?>
                    <?php echo $error ?><br />
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <form class="form-horizontal" method="post" action="<?php echo $app->router->path('post.create') ?>">
            <div class="form-group <?php echo isset($errors['title']) ? 'has-error' : '' ?>">
                <label class="col-sm-2 control-label">Заголовок</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" placeholder="Заголовок" value="<?php echo @$values['title'] ?>">
                </div>
            </div>
            <div class="form-group <?php echo isset($errors['content']) ? 'has-error' : '' ?>">
                <label class="col-sm-2 control-label">Текст</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="content" rows="3" placeholder="Текст"><?php echo @$values['content'] ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Добавить</button>
                </div>
            </div>
        </form>
    </div>
</div>