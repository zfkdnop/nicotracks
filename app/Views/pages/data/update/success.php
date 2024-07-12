<center><h1 class="zmuli sc text-success p-0 m-0"">Datapoint updated</pre></center>
<meta http-equiv="refresh" content="3; url='<?= url_to('UpdateDataController::listDataPoints') ?>'" />
<script>let x = () => {
    clearInterval(z);
    window.location.href = '<?= url_to('UpdateDataController::listDataPoints') ?>';
};
let z = setInterval(x, 2000);</script>