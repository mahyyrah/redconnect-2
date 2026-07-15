<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Certificate $certificate
 * @var array|\Cake\Collection\CollectionInterface $donationHistories
 */
?>

<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.form-card{
    max-width:950px;
    margin:40px auto;
    background:#fff;
    border-radius:24px;
    padding:32px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.page-title{
    color:#c1121f;
    font-size:24px;
    font-weight:700;
}

.section-title{
    color:#c1121f;
    font-size:17px;
    font-weight:700;
    margin:20px 0 15px;
}

.form-control,
.form-select,
textarea{
    border-radius:12px !important;
    min-height:46px;
    font-size:15px;
}

.form-control:focus,
.form-select:focus{
    border-color:#c1121f;
    box-shadow:0 0 0 .2rem rgba(193,18,31,.15);
}

.btn-red,
.btn-back{
    display:inline-flex !important;
    align-items:center !important;
    justify-content:center !important;
    height:44px !important;
    min-width:150px !important;
    padding:0 22px !important;
    border-radius:12px !important;
    font-size:14px !important;
    font-weight:600 !important;
    line-height:1 !important;
    text-decoration:none !important;
}

.btn-red{
    background:#c1121f !important;
    color:#fff !important;
    border:none !important;
}

.btn-red:hover{
    background:#9b0f19 !important;
    color:#fff !important;
}

.info-box{
    background:#fff7f7;
    border:1px solid #f1dada;
    border-radius:14px;
    padding:16px;
    color:#555;
    font-size:14px;
    line-height:1.7;
}

.empty-message{
    background:#fff4d6;
    color:#856404;
    border:1px solid #ffe69c;
    border-radius:14px;
    padding:16px;
}

@media(max-width:768px){
    .form-card{
        margin:20px;
        padding:24px;
    }

    .form-header{
        flex-direction:column;
        align-items:flex-start !important;
        gap:15px;
    }
}
</style>

<div class="container py-5">

    <div class="form-card">

        <div class="form-header d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="page-title">🏆 Generate Certificate</h2>
                <p class="text-muted mb-0">
                    Generate a certificate for a completed blood donation.
                </p>
            </div>

            <?= $this->Html->link(
                '← Back',
                ['controller'=>'Certificates','action'=>'index'],
                [
                    'class'=>'btn btn-outline-secondary btn-back'
                ]
            ) ?>
        </div>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create($certificate) ?>

        <div class="section-title">
            Certificate Information
        </div>

        <?php if (!empty($donationHistories)): ?>

            <div class="row">

                <div class="col-md-12 mb-3">
                    <?= $this->Form->control('donation_history_id', [
                        'label'=>'Completed Donation',
                        'options'=>$donationHistories,
                        'empty'=>'Select Donor and Donation',
                        'class'=>'form-select',
                        'required'=>true
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Certificate Code</label>
                    <input
                        type="text"
                        class="form-control"
                        value="Generated automatically"
                        readonly
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Issued Date</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?= date('d M Y') ?>"
                        readonly
                    >
                </div>

                <div class="col-md-12 mb-3">
                    <div class="info-box">
                        <strong>Certificate Code</strong> will be generated automatically after submission.<br>
                        <strong>Issued Date</strong> will use the current date and time.<br>
                        Each completed donation can only have one certificate.
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">

                <?= $this->Html->link(
                    'Cancel',
                    ['controller'=>'Certificates','action'=>'index'],
                    [
                        'class'=>'btn btn-outline-secondary btn-back'
                    ]
                ) ?>

                <?= $this->Form->button(
                    'Generate Certificate',
                    [
                        'class'=>'btn-red',
                        'type'=>'submit'
                    ]
                ) ?>

            </div>

        <?php else: ?>

            <div class="empty-message">
                <strong>No completed donations available.</strong><br>
                Please add a Donation History record before generating a certificate.
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">

                <?= $this->Html->link(
                    'Cancel',
                    ['controller'=>'Certificates','action'=>'index'],
                    [
                        'class'=>'btn btn-outline-secondary btn-back'
                    ]
                ) ?>

                <?= $this->Form->button(
                    'Generate Certificate',
                    [
                        'class'=>'btn-red',
                        'type'=>'button',
                        'disabled'=>true
                    ]
                ) ?>

            </div>

        <?php endif; ?>

        <?= $this->Form->end() ?>

    </div>

</div>