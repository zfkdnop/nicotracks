<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>
<? use CodeIgniter\I18n\Time;  ?>

<form action="<?= url_to('UpdateDataController::listDataPoints') ?>" method="post">
    <?= csrf_field() ?>
<div class="card-body">
    <h5 class="card-title text-center p-0 m-0"><?= esc($title) ?></h5>
</div>
<!-- <ul class="list-group list-group-flush">
    <li class="list-group-item"> -->
<table class="table table-sm table-hover table-striped user-select-none">
    <thead>
        <tr>
            <th scope="col">&ensp;</th>
            <th scope="col">id</th>
            <th scope="col">timestamp</th>
            <th scope="col">mg</th>
            <th scope="col">brand</th>
            <th scope="col">count</th>
        </tr>
    </thead>
    <tbody>
    <? foreach($dataPoints['chartData'] as $point): ?>
        <tr>
            <td><a href="/update/<?= $point['id'] ?>" class="link-underline link-underline-opacity-25 link-underline-opacity-50-hover">
                <span class="badge bg-info p-2">Edit</span>
            </a></td>
            <th scope="row"><?= $point['id'] ?></th>
            <td><? echo Time::parse($point['ts'])->format('m-d-y H:i'); ?></td>
            <td><?= $point['mg'] ?></td>
            <td><?= $point['brand'] ?></td>
            <td><?= $point['ct'] ?></td>
        </tr>
    <? endforeach ?>
    </tbody>
</table>
    <!-- </li>
</ul> -->
<!-- <div class="text-center"> -->
    <?= $pager->links() ?>
    <!-- <button class="btn btn-sm btn-primary py-0" type="submit">Update</button> -->
<!-- </div> -->
</form>