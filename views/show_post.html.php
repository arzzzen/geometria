<h1><?php echo htmlspecialchars($post->title) ?></h1>
<p class="text-primary"><?php echo htmlspecialchars($post->getCreationDate()) ?></p>
<p><?php echo nl2br( htmlspecialchars($post->content) ) ?></p>
<hr>
<h4>Комментарии:</h4>
<?php foreach($post->comments as $comment): ?>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-2">
            <strong><?php echo $comment->user ? htmlspecialchars($comment->user->login) : 'Гость' ?></strong>
            <p class="text-primary"><?php echo htmlspecialchars($comment->getCreationDate()) ?></p>
        </div>
        <div class="col-md-10">
            <?php echo htmlspecialchars($comment->content) ?>
        </div>
    </div>
<?php endforeach ?>
<div class="row" style="margin-top: 20px">
    <div class="col-md-6 col-md-offset-6">
        <form class="form-horizontal" method="post" action="<?php echo $app->router->path('comment.create') ?>">
            <input type="hidden" value="<?php echo $post->id ?>" name="post_id" />
            <div class="form-group">
                <textarea class="form-control" name="content" rows="3" placeholder="Комментарий"></textarea>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-default">Отправить</button>
            </div>
        </form>
    </div>
</div>
