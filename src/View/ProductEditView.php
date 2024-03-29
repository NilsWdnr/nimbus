<?php

$action = "";

if (!isset($args['method'])) {
    throw new Exception('The "method" argument was not passed to the edit post view');
}


switch ($args['method']) {
    case 'edit':
        $action = "/products/save/" . $args['id'];
        break;
    case 'create':
        $action = "/products/save_new/";
        break;
    default:
        $action = "/products/save_new/";
}

$title = isset($args['title']) ? $args['title'] : "";
$description = isset($args['description']) ? $args['description'] : "";
$price = isset($args['price']) ? $args['price'] : "";
$product_type = isset($args['product_type']) ? $args['product_type'] : "";
$brand = isset($args['brand']) ? $args['brand'] : "";

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
                    <label for="product_image">Product Images</label>
                    <input class="d-block" type="file" name="product_image" id="product_image">
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
                    <label for="description">Description</label>
                    <textarea class="d-block" name="description" id="description"><?= $description ?></textarea>
                </div>
                <div class="mt-4">
                    <div class="d-sm-flex">
                        <div>
                            <label for="price">Price (€)</label>
                            <input class="d-block" type="text" name="price" id="price" value="<?= $price ?>">
                        </div>
                        <div class="ms-sm-3 mt-3 mt-sm-0 mb-4 mb-sm-0">
                            <label for="product-type">Product Type</label>
                            <select class="d-block" name="product_type" id="product_type">
                                <option value="hoodies" <?= ($product_type==="hoodies") ? 'selected' : '' ?>>Hoodie</option>
                                <option value="shirts" <?= ($product_type==="shirts") ? 'selected' : '' ?>>Shirt</option>
                                <option value="accessories" <?= ($product_type==="accessories") ? 'selected' : '' ?>>Accessories / Other</option>
                            </select>
                        </div>
                        <div class="ms-sm-3 mt-3 mt-sm-0 mb-4 mb-sm-0">
                            <label for="brand">Brand</label>
                            <select class="d-block" name="brand" id="brand">
                                <option value="'Tis Ordained" <?= ($brand==="'Tis Ordained") ? 'selected' : '' ?>>'Tis Ordained</option>
                                <option value="NSA Games" <?= ($brand==="NSA Games") ? 'selected' : '' ?>>NSA Games</option>
                            </select>
                        </div>
                    </div>

                </div>
                <input type="submit" value="save" class="btn btn-light mt-4">
            </form>
        </div>
    </div>
</div>