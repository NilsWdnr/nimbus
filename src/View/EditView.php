<?php

if (count($args) > 0) {
    $title = $args['title'] ? $args['title'] : "";
    $content = $args['content'] ? $args['content'] : "";
}

?>

<div id="edit-post">
    <div class="container">
        <form action="/post/save/<?= $args['id'] ?>" method="POST">
            <div>
                <label for="title">Title</label>
                <input class="d-block" type="text" name="title" id="title" value="<?= $title ?>">
            </div>
            <div class="mt-4">
                <label for="content">Content</label>
                <textarea class="d-block" name="content" id="content"><?= $content ?></textarea>
            </div>
            <input type="submit" value="save" class="btn btn-light mt-4">
        </form>
    </div>
</div>