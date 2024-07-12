                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                    <?php helper('isauth'); ?>
                    <? if (isAuth()): ?>
                        <span><img src="/emptypad.png" class="uiico">&ensp;<a href="<?= site_url('new') ?>" class="card-link link-underline link-underline-opacity-25 link-underline-opacity-50-hover">Add Datapoint</a></span>
                        <span><img src="/pad.png" class="uiico">&ensp;<a href="<?= site_url('update') ?>" class="card-link link-underline link-underline-opacity-25 link-underline-opacity-50-hover">Modify Datapoint</a></span>
                        <span><img src="/msagent.png" class="uiico">&ensp;<a href="<?= site_url('logout') ?>" class="card-link link-underline link-underline-opacity-25 link-underline-opacity-50-hover">Logout</a></span>
                    <? else: ?>
                        <div class="d-inline-flex">&ensp;</div>
                        <div class="d-inline-flex">
                            <a href="<?= site_url('login') ?>" class="card-link link-underline link-underline-opacity-25 link-underline-opacity-50-hover">Login</a>
                        </div>
                        <div class="d-inline-flex">&ensp;</div>
                        <!-- <div class="d-inline-flex align-content-start">
                            <span class="card-text text-muted">
                                <a class="link-underline link-underline-opacity-25 link-underline-opacity-50-hover" href="https://en.wikipedia.org/wiki/Nicotine#Central_nervous_system_2">Nicotine<sup><small>x</small></sup> is healthy!</a>
                            </span>
                        </div>
                        <div class="d-inline-flex align-content-end">
                            <span class="card-text text-muted">
                                <i><sup>x</sup><small>NOT tobacco</small></i>
                            </span>
                        </div> -->
                    <? endif ?>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <?= isset($showCharts) ? view('charts') : '' ?>
    </div>
    <footer class="navbar bg-light fixed-bottom d-flex justify-content-between border-top user-select-none console">
		<div class="d-inline-flex align-content-start mx-1 mx-md-4">
			<a href="https://lowkey.network" class="sz16 text-dark text-decoration-none user-select-none">lowkey networks</a>
		</div>
		<div class="d-inline-flex align-content-end mx-1 mx-md-4">
			<a href="https://lowkey.network" class="sz16 text-dark text-decoration-none user-select-none">keep it on the DL...</a>
		</div>
	</footer>
</body>
</html>