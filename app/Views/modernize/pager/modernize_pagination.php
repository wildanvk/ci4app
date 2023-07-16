<?php
$pager->setSurroundCount(2);
?>
<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-end px-4">
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">First</a>
        </li>

        <!-- <li class="page-item <?= $pager->hasPreviousPage() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-disabled="<?= $pager->hasPreviousPage() ? false : true ?>" aria-label="<?= lang('Pager.previous') ?>">Previous</a>
        </li> -->

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <!-- <li class="page-item <?= $pager->hasNextPage() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-disabled="<?= $pager->hasNextPage() ? false : true ?>" aria-label="<?= lang('Pager.next') ?>">Next</a>
        </li> -->

        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">Last</a>
        </li>
    </ul>
</nav>