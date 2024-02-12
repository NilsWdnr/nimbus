<div id="settings" class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <h3>Settings</h3>
            <h4 class="mt-5">Change Password</h4>
            <form class="pb-5" action="/settings/save_password" method="POST">
                <div class="mt-3">
                    <label for="new_password">New password</label>
                    <input class="d-block" type="password" id="new_password" name="new_password">
                </div>
                <div class="mt-3">
                    <label for="old_password">Old password</label>
                    <input class="d-block" type="password" id="old_password" name="old_password">
                </div>
                <input class="btn btn-danger mt-3" type="submit" id="save_password" name="save_password" value="save password">
                <?php
                if (isset($_GET['passwordSuccess'])) {
                ?>
                    <div class="alert alert-success mt-4">Your password has been changed successfully</div>
                <?php
                } else if (isset($_GET['passwordWrong'])) {
                ?>
                    <div class="alert alert-danger mt-4">Old password incorrect</div>
                <?php
                }
                ?>
            </form>
        </div>
    </div>
</div>