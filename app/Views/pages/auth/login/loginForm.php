<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="<?= url_to('AuthLoginController::loginForm') ?>" method="post">
    <?= csrf_field() ?>
<div class="card-body">
    <h5 class="card-title text-center p-0 m-0"><?= esc($title) ?></h5>
</div>
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <div class="row">
            <div class="col-4">
                <label for="username" class="">Username</label>
            </div>
            <div class="col-8">
                <input type="text" name="username" value="<?= set_value('username') ?>" />
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-4">
                <label for="passwd" class="">Password</label>
            </div>
            <div class="col-8">
                <input type="password" name="passwd" value="<?= set_value('passwd') ?>" />
            </div>
        </div>
    </li>
</ul>
<div class="card-body text-center">
    <button class="btn btn-sm btn-primary py-0" type="submit">Login</button>
    <!-- <a href="#" class="card-link link-underline link-underline-opacity-25 link-underline-opacity-50-hover">Card link</a>
    <a href="#" class="card-link link-underline link-underline-opacity-25 link-underline-opacity-50-hover">Another link</a> -->
</div>
</form>