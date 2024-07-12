<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<? /* <form action="<?= url_to('UpdateDataController::updateDataForm') ?>" method="post"> */ ?>
<form method="post">
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
                    <input type="date" name="date" id="date" value="<?= $entry['date'] ?>" />
                </span>
            </div>
            <div class="col-4">
                <span class="card-text text-muted">
                    <label for="time">Time</label>
                    <input type="time" name="time" id="time" value="<?= $entry['time'] ?>" />
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
                <input type="text" name="mg" value="<?= $entry['mg'] ?>" placeholder="6" />
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-4">
                <label for="brand" class="">Brand</label>
            </div>
            <div class="col-8">
                <input type="text" name="brand" value="<?= $entry['brand'] ?>"  placeholder="Zyn" />
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-4">
                <label for="ct" class="">Count</label>
            </div>
            <div class="col-8">
                <input type="text" name="ct" value="<?= $entry['ct'] ?>" placeholder="1" />
            </div>
        </div>
    </li>
</ul>
<div class="card-body text-center">
    <button class="btn btn-sm btn-primary py-0" type="submit">Update</button>
</div>
</form>