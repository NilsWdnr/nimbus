<div id="dashboard">
    <div class="container">
        <h2>Wilkommen, <?= $args['username'] ?></h2>
        <button class="btn btn-light">Beitrag erstellen</button>

        <h3 class="mt-5">Beiträge</h3>
        <?php if(count($args['posts'])>0){
            foreach($args['posts'] as $post){
                ?>
                <h4><?= $post['title'] ?></h4>
                <?php
            }
        } else {
            ?>
            <p>Bisher gibt es noch keine Beiträge.</p>
            <?php
        } ?>
    </div>
</div>