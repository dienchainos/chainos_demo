<ul class="pagination pagination-sm">
    <li><?= $this->Paginator->prev('Previous') ?></li>
    <?= $this->Paginator->numbers() ?>
    <li><?= $this->Paginator->next('Next') ?></li>
    <li class="page-item">
        <a class="page-link" style="cursor: default" href="#"><?= $this->Paginator->counter() ?></a>
    </li>
</ul>