<div id="posts" class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <h3>Posts</h3>

            <a href="/posts/create"><button class="btn btn-light mt-3 mb-4">create post</button></a>
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
        </div>
    </div>
</div>