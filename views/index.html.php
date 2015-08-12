<div class="items">
    <?php foreach($posts as $post): ?>
        <a href="<?php echo $app->router->path('post.show', array($post->id)) ?>" class="list-group-item">
            <h4><?php echo htmlspecialchars($post->title) ?></h4>
            <p class="text-primary"><?php echo htmlspecialchars($post->getCreationDate()) ?></p>
            <p class="list-group-item-text"><?php echo htmlspecialchars($post->getExcerpt()) ?></p>
        </a>
    <?php endforeach ?>
</div>
