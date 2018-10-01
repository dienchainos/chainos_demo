<?php $number = $this->Paginator->numbers(); ?>
<ul class="pagination pagination-sm">
    <?php if (!empty($number)) :?>
    <li><?= $this->Paginator->prev('Previous') ?></li>
    <?php endif; ?>
    <?= $this->Paginator->numbers() ?>
    <?php if (!empty($number)) :?>
    <li><?= $this->Paginator->next('Next') ?></li>
    <?php endif; ?>
    <li class="page-item">
        <a class="page-link" style="cursor: default" href="#"><?= $this->Paginator->counter() ?></a>
    </li>
</ul>