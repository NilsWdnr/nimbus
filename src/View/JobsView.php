<div id="jobs" class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <h3>Jobs</h3>

            <a href="/jobs/create"><button class="btn btn-light mt-3 mb-4">create job</button></a>

            <?php if (count($args['jobs']) > 0) {
            ?>
                <table class="table overview-table">
                    <thead>
                        <td><strong>Title</strong></td>
                        <td><strong>Section</strong></td>
                        <td><strong>Time Model</strong></td>
                        <td><strong>Location</strong></td>
                        <td><strong>Date</strong></td>
                        <td></td>
                        <td></td>
                    </thead>
                <?php
                foreach ($args['jobs'] as $job) {
                ?>
                    <tr>
                        <td><?= $job['title'] ?></td>
                        <td><?= $job['time_model'] ?></td>
                        <td><?= $job['location'] ?></td>
                        <td><?= $job['section'] ?></td>
                        <td><?= $job['date_created'] ?></td>
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
                <p>Bisher gibt es noch keine Jobs.</p>
            <?php
            }
            ?>
        </div>
    </div>
</div>