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
$section = isset($args['section']) ? $args['section'] : "";
$time_model = isset($args['time_model']) ? $args['time_model'] : "";
$description = isset($args['description']) ? $args['description'] : "";

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
                    <div class="mt-4 d-flex">
                        <div class="me-3">
                            <label for="section">Section</label>
                            <select class="d-block" name="section" id="section">
                                <option value="Game Art" <?= ($section === "Game Art") ? 'selected' : '' ?>>Game Art</option>
                                <option value="Game Development" <?= ($section === "Game Development") ? 'selected' : '' ?>>Game Development</option>
                                <option value="Audio Engineer" <?= ($section === "Audio Engineer") ? 'selected' : '' ?>>Audio Engineer</option>
                            </select>
                        </div>
                        <div>
                            <label for="time_model">Time Model</label>
                            <select class="d-block" name="time_model" id="time_model">
                                <option value="Full Time" <?= ($time_model === "Full Time") ? 'selected' : '' ?>>Full Time</option>
                                <option value="Part Time" <?= ($time_model === "Part Time") ? 'selected' : '' ?>>Part Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">

                    </div>
                </form>
        </div>
    </div>
</div>