<?php

$action = "";

if(!isset($args['method'])){
    throw new Exception('The "method" argument was not passed to the edit post view');
}


switch($args['method']){
    case 'edit':
        $action = "/post/save/" . $args['id'];
        break;
    case 'create':
        $action = "/post/save_new/";
        break;
    default:
        $action = "/post/save_new/";
}


    $title = isset($args['title']) ? $args['title'] : "";
    $content = isset($args['content']) ? $args['content'] : "";


?>

<div id="edit-post">
    <div class="container">
        <form action="<?= $action ?>" method="POST">
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