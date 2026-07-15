<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.view-card{
    max-width:1000px;
    margin:40px auto;
    background:#fff;
    border-radius:24px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.page-title{
    color:#c1121f;
    font-size:26px;
    font-weight:700;
}

.info-box{
    background:#fff7f7;
    border:1px solid #f1dada;
    border-radius:18px;
    padding:20px;
    height:100%;
}

.info-label{
    color:#777;
    font-size:13px;
    margin-bottom:4px;
}

.info-value{
    font-size:15px;
    font-weight:600;
}

.btn-red,
.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    height:44px;
    min-width:150px;
    padding:0 22px;
    border-radius:12px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
}

.btn-red{
    background:#c1121f;
    color:#fff;
    border:none;
}

.btn-red:hover{
    background:#9b0f19;
    color:#fff;
}

.certificate-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background:#c1121f;
    color:#fff;
    padding:6px 14px;
    border-radius:999px;
    font-weight:700;
    font-size:14px;
}
</style>

<div class="container py-5">

<div class="view-card">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h2 class="page-title">🩸 Donation History Details</h2>
<p class="text-muted mb-0">
View completed blood donation information.
</p>
</div>

<div class="d-flex gap-2">

<?= $this->Html->link(
'← Back',
['action'=>'index'],
['class'=>'btn btn-outline-secondary btn-back']
) ?>

<?= $this->Html->link(
'Edit Record',
['action'=>'edit',$donationHistory->id],
['class'=>'btn-red'
]) ?>

</div>

</div>

<div class="row g-3">

<div class="col-md-6">
<div class="info-box">
<div class="info-label">Donation ID</div>
<div class="info-value">
<?= $this->Number->format($donationHistory->id) ?>
</div>
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<div class="info-label">Certificate</div>
<div class="info-value">

<?php if($donationHistory->hasValue('certificate')): ?>

<span class="certificate-badge">
<?= h($donationHistory->certificate->certificate_code) ?>
</span>

<?php else: ?>

<span class="text-muted">Not Generated</span>

<?php endif; ?>

</div>
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<div class="info-label">Donor</div>
<div class="info-value">
<?= $donationHistory->hasValue('donor') ? h($donationHistory->donor->full_name) : '-' ?>
</div>
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<div class="info-label">Staff</div>
<div class="info-value">
<?= $donationHistory->hasValue('staff') ? h($donationHistory->staff->full_name) : '-' ?>
</div>
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<div class="info-label">Appointment Status</div>
<div class="info-value">
<?= $donationHistory->hasValue('appointment') ? h($donationHistory->appointment->status) : '-' ?>
</div>
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<div class="info-label">Donation Date</div>
<div class="info-value">
<?= h($donationHistory->donation_date) ?>
</div>
</div>
</div>

<div class="col-md-6">
<div class="info-box">
<div class="info-label">Quantity Pack</div>
<div class="info-value">
<?= h($donationHistory->quantity_pack) ?> Pack(s)
</div>
</div>
</div>

<div class="col-md-12">
<div class="info-box">
<div class="info-label">Remarks</div>
<div class="info-value">
<?= !empty($donationHistory->remarks) ? nl2br(h($donationHistory->remarks)) : '-' ?>
</div>
</div>
</div>

</div>

</div>

</div>