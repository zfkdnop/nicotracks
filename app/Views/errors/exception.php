<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/icon" href="favicon.ico" />
    <link href="bootstrap-yeti.min.css" rel="stylesheet" crossorigin="anonymous" />
	<link href="styles.css" rel="stylesheet" crossorigin="anonymous" />
	<title><?= env('app.siteName') ?> by lowkey.link</title>
</head>
<body>
<center><h1 class="zmuli sc text-danger p-0 m-0""><?= esc($title) ?></h1><pre><?= esc($message) ?></pre></center>
<meta http-equiv="refresh" content="3; url='<?= url_to('HomeController::home') ?>'" />
<script>let x = () => {
    clearInterval(z);
    window.location.href = '<?= url_to('HomeController::home') ?>';
};
let z = setInterval(x, 2000);</script>
</body>
</html>