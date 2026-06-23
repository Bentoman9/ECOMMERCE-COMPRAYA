<?php $pager->setSurroundCount(2) ?>
<nav aria-label="Page navigation">
    <ul class="pagination pagination-sm mb-0">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a href="<?= $pager->getFirst() ?>" class="page-link" aria-label="First">
                <span aria-hidden="true">&laquo; Primero</span>
            </a>
        </li>
        <li class="page-item">
            <a href="<?= $pager->getPrevious() ?>" class="page-link" aria-label="Previous">
                <span aria-hidden="true">&lsaquo; Ant</span>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
            <a href="<?= $link['uri'] ?>" class="page-link">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="page-item">
            <a href="<?= $pager->getNext() ?>" class="page-link" aria-label="Next">
                <span aria-hidden="true">Sig &rsaquo;</span>
            </a>
        </li>
        <li class="page-item">
            <a href="<?= $pager->getLast() ?>" class="page-link" aria-label="Last">
                <span aria-hidden="true">Último &raquo;</span>
            </a>
        </li>
    <?php endif ?>
    </ul>
</nav>