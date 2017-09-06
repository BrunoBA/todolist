<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $activity->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $activity->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Activities'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="activities form large-9 medium-8 columns content">
    <?= $this->Form->create($activity) ?>
    <fieldset>
        <legend><?= __('Edit Activity') ?></legend>
        <?php
            echo $this->Form->control('nome');
            echo $this->Form->control('excluido');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
