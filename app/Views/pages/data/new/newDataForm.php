<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="<?= url_to('NewDataController::newDataForm') ?>" method="post">
    <?= csrf_field() ?>
<div class="card-body">
    <h5 class="card-title text-center p-0 m-0"><?= esc($title) ?></h5>
</div>
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <div class="row">
            <div class="col-4">
                <button class="btn btn-sm btn-primary py-0" type="button" onClick="{setCurrentDateTime()}">Now</button>
            </div>
            <div class="col-4">
                <span class="card-text text-muted">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" value="<?= set_value('date') ?>" />
                </span>
            </div>
            <div class="col-4">
                <span class="card-text text-muted">
                    <label for="time">Time</label>
                    <input type="time" name="time" id="time" value="<?= set_value('time') ?>" />
                </span>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-4">
                <label for="mg" class="">Dose (mg)</label>
            </div>
            <div class="col-8">
                <input type="text" name="mg" value="<?= set_value('mg') ?>" placeholder="6" />
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-4">
                <label for="brand" class="">Brand</label>
            </div>
            <div class="col-8">
                <input type="text" name="brand" value="<?= set_value('brand') ?>"  placeholder="Zyn" />
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-4">
                <label for="ct" class="">Count</label>
            </div>
            <div class="col-8">
                <input type="text" name="ct" value="<?= set_value('ct') ?>" placeholder="1" />
            </div>
        </div>
    </li>
</ul>
<div class="card-body text-center">
    <button class="btn btn-sm btn-primary py-0" type="submit">Add</button>
    </form>
</div>
<div class="card-body text-center pt-0">
    <form action="<?= url_to('NewDataController::quickAddZyn3') ?>" method="post"><?= csrf_field() ?><button class="btn btn-sm btn-primary py-0" type="submit">Quick-add Zyn 3mg</button></form>
    <form action="<?= url_to('NewDataController::quickAddZyn6') ?>" method="post"><?= csrf_field() ?><button class="btn btn-sm btn-primary py-0" type="submit">Quick-add Zyn 6mg</button></form>
    <form action="<?= url_to('NewDataController::quickAddOn8') ?>" method="post"><?= csrf_field() ?><button class="btn btn-sm btn-primary py-0" type="submit">Quick-add On 8mg</button></form>
    <form action="<?= url_to('NewDataController::quickAddGum2') ?>" method="post"><?= csrf_field() ?><button class="btn btn-sm btn-primary py-0" type="submit">Quick-add Gum 2mg</button></form>
    <form action="<?= url_to('NewDataController::quickAddGum4') ?>" method="post"><?= csrf_field() ?><button class="btn btn-sm btn-primary py-0" type="submit">Quick-add Gum 4mg</button></form>
</div>
