<div id="products" class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <h3>Products</h3>

            <a href="/products/create"><button class="btn btn-light mt-3 mb-4">create product</button></a>
            <?php if (count($args['products']) > 0) {
            ?>
                <table class="table overview-table">
                    <thead>
                        <td><strong>Title</strong></td>
                        <td class="d-none d-sm-table-cell"><strong>Type</strong></td>
                        <td class="d-none d-sm-table-cell"><strong>Date</strong></td>
                        <td></td>
                        <td></td>
                    </thead>
                    <?php
                    foreach ($args['products'] as $product) {
                    ?>
                        <tr>
                            <td><?= $product['title'] ?></td>
                            <td class="d-none d-sm-table-cell"><?= $product['product_type'] ?></td>
                            <td class="d-none d-sm-table-cell"><?= $product['date_created'] ?></td>
                            <td><a class="edit-link" href="/products/edit/<?= $product['id'] ?>">edit</a></td>
                            <td><a class="delete-link" href="/products/delete/<?= $product['id'] ?>">delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            } else {
            ?>
                <p>There are no products so far.</p>
            <?php
            } ?>
        </div>
    </div>
</div>