<div id="products" class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <h3>Produkte</h3>

            <a href="/products/create"><button class="btn btn-light mt-3 mb-4">Produkt erstellen</button></a>
            <?php if (count($args['products']) > 0) {
            ?>
                <table class="table">
                    <thead>
                        <td><strong>Title</strong></td>
                        <td><strong>Date</strong></td>
                        <td></td>
                    </thead>
                    <?php
                    foreach ($args['posts'] as $post) {
                    ?>
                        <tr>
                            <td><?= $post['section'] ?></td>
                            <td></td>
                            <td><a href="/products/edit/<?= $post['id'] ?>">edit</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            } else {
            ?>
                <p>Bisher gibt es noch keine Produkte.</p>
            <?php
            } ?>
        </div>
    </div>
</div>