<div id="login-wrapper">
    <div id="login-container">
        <h2>Login</h2>
        <form method="POST">
            <div>
                <input type="text" placeholder="username" name="username" id="username">
            </div>
            <div>
                <input type="password" placeholder="password" name="password" id="password">
            </div>
            <input class="btn btn-light py-1" type="submit" value="login">
        </form>
        <?php
        if (isset($args['message'])) {
        ?>
            <div class="alert alert-warning mt-4">
                <?= $args['message']; ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div id="credit-container">
        <p class="mb-0">Photo by <a href="https://unsplash.com/@pawel_czerwinski?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Pawel Czerwinski</a> on <a href="https://unsplash.com/photos/water-splash-in-close-up-photography-5x7kyu3J4Xs?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a></p>
    </div>
</div>