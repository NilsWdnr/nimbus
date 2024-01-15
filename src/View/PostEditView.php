<?php

$action = "";

if (!isset($args['method'])) {
    throw new Exception('The "method" argument was not passed to the edit post view');
}


switch ($args['method']) {
    case 'edit':
        $action = "/posts/save/" . $args['id'];
        break;
    case 'create':
        $action = "/posts/save_new/";
        break;
    default:
        $action = "/posts/save_new/";
}


$title = isset($args['title']) ? $args['title'] : "";
$content = isset($args['content']) ? $args['content'] : "";


?>

<div id="edit-post" class="content-wrapper edit">
    <div class="content">
        <div class="container mt-5">
            <form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="title">Title</label>
                    <input class="d-block" type="text" name="title" id="title" value="<?= $title ?>">
                </div>
                <div class="mt-4">
                    <label for="title_image">Image</label>
                    <input class="d-block" type="file" name="title_image" id="title_image">
                    <?php
                    if ($args['method'] === "edit" && isset($args['title_image']) && $args['title_image'] !== "") {
                    ?>
                        <div class="mt-2">
                            Current Image: <?= $args['title_image'] ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="mt-4">
                    <label for="content">Content</label>
                    <textarea class="d-block" name="content" id="content"><?= $content ?></textarea>
                </div>
                <input type="submit" value="save" class="btn btn-light mt-4">
            </form>
        </div>
    </div>
</div>