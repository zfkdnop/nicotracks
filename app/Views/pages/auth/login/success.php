<center><h1 class="zmuli sc text-success p-0 m-0"">Logged in</pre></center>
<meta http-equiv="refresh" content="3; url='<?= url_to('HomeController::home') ?>'" />
<script>let x = () => {
    clearInterval(z);
    window.location.href = '<?= url_to('HomeController::home') ?>';
};
let z = setInterval(x, 2000);</script>