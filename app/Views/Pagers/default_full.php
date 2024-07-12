<? $pager->setSurroundCount(2); ?>

<nav aria-label="Page navigation" class="d-flex justify-content-center">
	<ul class="pagination pagination-sm zmuli-light sc">
		<?php if ($pager->hasPrevious()) : ?>
			<li class="page-link">
				<a href="<?= $pager->getFirst() ?>" aria-label="First">
					<span aria-hidden="true" class="text-dark">First</span>
				</a>
			</li>
		<?php endif ?>

		<?php foreach ($pager->links() as $link) : ?>
			<li class="page-link page-item<?= $link['active'] ? ' active' : '' ?>">
				<a href="<?= $link['uri'] ?>" class="text-dark">
					<?= $link['title'] ?>
				</a>
			</li>
		<?php endforeach ?>

		<?php if ($pager->hasNext()) : ?>
			<li class="page-link">
				<a href="<?= $pager->getLast() ?>" aria-label="Last">
					<span aria-hidden="true" class="text-dark">Last</span>
				</a>
			</li>
		<?php endif ?>
	</ul>
</nav>
