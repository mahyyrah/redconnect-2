<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.form-card{
    max-width:650px;
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

.form-control,
.form-select{
    border-radius:12px;
    min-height:46px;
}

.btn-red{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background:#c1121f;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 22px;
    min-height:44px;
    font-weight:600;
}

.btn-red{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background:#c1121f;
    color:#fff;
    border:none;
    border-radius:12px;
    min-width:150px;
    height:44px;
    padding:0 24px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
    transition:.2s;
}

.btn-red:hover{
    background:#9b0f19;
    color:#fff;
}

.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:100px;
    height:44px;
    border-radius:12px;
    font-size:14px;
    font-weight:600;
}
</style>

<div class="container py-5">

<div class="form-card">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h2 class="page-title">🩸 Add Blood Type</h2>
<p class="text-muted mb-0">
Register a new blood group.
</p>
</div>

<?= $this->Html->link(
'← Back',
['action'=>'index'],
['class'=>'btn btn-outline-secondary btn-back']
) ?>

</div>

<?= $this->Form->create($bloodType) ?>

<div class="mb-4">

<?= $this->Form->control('blood_group',[
'label'=>'Blood Group',
'options'=>[
'A+'=>'A+',
'A-'=>'A-',
'B+'=>'B+',
'B-'=>'B-',
'AB+'=>'AB+',
'AB-'=>'AB-',
'O+'=>'O+',
'O-'=>'O-'
],
'empty'=>'Select Blood Group',
'class'=>'form-select'
]) ?>

</div>

<div class="text-end">

<?= $this->Html->link(
'Cancel',
['action'=>'index'],
['class'=>'btn btn-outline-secondary btn-back me-2']
) ?>

<?= $this->Form->button(
'Save Blood Type',
['class'=>'btn-red']
) ?>

</div>

<?= $this->Form->end() ?>

</div>

</div>