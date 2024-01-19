<?php

$action = "";

if (!isset($args['method'])) {
    throw new Exception('The "method" argument was not passed to the edit post view');
}

switch ($args['method']) {
    case 'edit':
        $action = "/jobs/save/" . $args['id'];
        break;
    case 'create':
        $action = "/jobs/save_new/";
        break;
    default:
        $action = "/jobs/save_new/";
}

$title = isset($args['title']) ? $args['title'] : "";
$section = 

?>

<div id="edit-job" class="content-wrapper edit">
    <div class="content">
        <div class="container mt-5">
            <form action="<?= $action ?>" method="POST">
                <form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="title">Title</label>
                        <input class="d-block" type="text" name="title" id="title" value="<?= $title ?>">
                    </div>
                </form>
        </div>
    </div>
</div>