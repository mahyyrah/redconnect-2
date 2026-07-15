<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.form-card{
    max-width:900px;
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
}

textarea{
    min-height:120px;
}

.btn-red,
.btn-back {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    height: 44px !important;
    min-width: 150px !important;
    padding: 0 22px !important;
    border-radius: 12px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    line-height: 1 !important;
    text-decoration: none !important;
}

.btn-red {
    background: #c1121f !important;
    color: #fff !important;
    border: none !important;
}

.btn-red:hover {
    background: #9b0f19 !important;
    color: #fff !important;
}
</style>

<div class="container py-5">

<div class="form-card">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h2 class="page-title">📅 Add Appointment</h2>
<p class="text-muted mb-0">
Schedule a new blood donation appointment.
</p>
</div>

<?= $this->Html->link(
'← Back',
['action'=>'index'],
['class'=>'btn btn-outline-secondary btn-back']
) ?>

</div>

<?= $this->Form->create($appointment) ?>

<div class="section-title">
Appointment Information
</div>

<div class="row">

<div class="col-md-12 mb-3">
<?= $this->Form->control('donor_id',[
'label'=>'Donor',
'options'=>$donors,
'empty'=>'Select Donor',
'class'=>'form-select'
]) ?>
</div>

<div class="col-md-6 mb-3">
<?= $this->Form->control('appointment_date',[
'label'=>'Appointment Date',
'class'=>'form-control'
]) ?>
</div>

<div class="col-md-6 mb-3">
<?= $this->Form->control('appointment_time',[
'label'=>'Appointment Time',
'class'=>'form-control'
]) ?>
</div>

<div class="col-md-12 mb-3">
<?= $this->Form->control('health_declaration',[
'type'=>'textarea',
'label'=>'Health Declaration',
'placeholder'=>'Enter donor health declaration...'
]) ?>
</div>

<div class="col-md-6 mb-3">
</div>

</div>

<div class="text-end mt-4">

<?= $this->Html->link(
'Cancel',
['action'=>'index'],
['class'=>'btn btn-outline-secondary btn-back me-2']
) ?>

<?= $this->Form->button(
'Save Appointment',
['class'=>'btn-red']
) ?>

</div>

<?= $this->Form->end() ?>

</div>

</div>