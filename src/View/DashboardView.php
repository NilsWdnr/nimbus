<div id="dashboard" class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <h2>Welcome, <?= $args['username'] ?></h2>

            <h3 class="mt-5">Latest posts</h3>
            <?php if (count($args['posts']) > 0) {
            ?>
                <table class="table overview-table">
                    <thead>
                        <td><strong>Title</strong></td>
                        <td><strong>Date</strong></td>
                        <td></td>
                        <td></td>
                    </thead>
                    <?php
                    foreach ($args['posts'] as $post) {
                    ?>
                        <tr>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['date'] ?></td>
                            <td><a class="edit-link" href="/posts/edit/<?= $post['id'] ?>">edit</a></td>
                            <td><a class="delete-link" href="/posts/delete/<?= $post['id'] ?>">delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            } else {
            ?>
                <p>There are no posts so far.</p>
            <?php
            } ?>

            <h3 class="mt-5">Newest Products</h3>
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
            }
            ?>

            <h3 class="mt-5">Latest jobs</h3>
            <?php if (count($args['jobs']) > 0) {
            ?>
                <table class="table overview-table">
                    <thead>
                        <td><strong>Title</strong></td>
                        <td class="d-none d-lg-table-cell"><strong>Time Model</strong></td>
                        <td class="d-none d-sm-table-cell"><strong>Location</strong></td>
                        <td><strong>Section</strong></td>
                        <td class="d-none d-xl-table-cell"><strong>Date</strong></td>
                        <td></td>
                        <td></td>
                    </thead>
                <?php
                foreach ($args['jobs'] as $job) {
                ?>
                    <tr>
                        <td><?= $job['title'] ?></td>
                        <td class="d-none d-lg-table-cell"><?= $job['time_model'] ?></td>
                        <td class="d-none d-sm-table-cell"><?= $job['location'] ?></td>
                        <td><?= $job['section'] ?></td>
                        <td class="d-none d-xl-table-cell"><?= $job['date_created'] ?></td>
                        <td><a class="edit-link" href="/jobs/edit/<?= $job['id'] ?>">edit</a></td>
                        <td><a class="delete-link" href="/jobs/delete/<?= $job['id'] ?>">delete</a></td>
                    </tr>
                <?php
                }
                ?>
                </table>
            <?php
            } else {
            ?>
                <p>There are no jobs so far.</p>
            <?php
            }
            ?>

        </div>
    </div>
</div>