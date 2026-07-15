<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Certificate $certificate
 * @var string[]|\Cake\Collection\CollectionInterface $donationHistories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $certificate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $certificate->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Certificates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="certificates form content">
            <?= $this->Form->create($certificate) ?>
            <fieldset>
                <legend><?= __('Edit Certificate') ?></legend>
                <?php
                    echo $this->Form->control('donation_history_id', ['options' => $donationHistories]);
                    echo $this->Form->control('certificate_code');
                    echo $this->Form->control('issued_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
