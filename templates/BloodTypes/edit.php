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
    min-width:140px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
}

.btn-red:hover{
    background:#9b0f19;
    color:#fff;
}

.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:12px;
    padding:10px 22px;
    min-height:44px;
    min-width:100px;
    font-size:14px;
    font-weight:600;
}

.action-link{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:72px;
    min-height:38px;
    padding:8px 16px;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
    margin:2px;
}

.view-btn{
    background:#e8f2ff;
    color:#0d6efd;
}

.edit-btn{
    background:#fff4d6;
    color:#856404;
}

.delete-btn{
    background:#ffe4e4;
    color:#c1121f;
}

.blood-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background:#c1121f;
    color:#fff;
    min-width:58px;
    min-height:34px;
    padding:0 14px;
    border-radius:999px;
    font-size:14px;
    font-weight:700;
}
</style>

<div class="container py-5">

<div class="form-card">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h2 class="page-title">🩸 Edit Blood Type</h2>
<p class="text-muted mb-0">
Update blood group information.
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
'class'=>'form-select'
]) ?>

</div>

<div class="d-flex justify-content-between align-items-center mt-4">

<?= $this->Form->postLink(
'Delete Blood Type',
['action'=>'delete',$bloodType->id],
[
'confirm'=>__('Are you sure you want to delete this blood type?'),
'class'=>'btn btn-outline-danger btn-back'
]
) ?>

<div>

<?= $this->Html->link(
'Cancel',
['action'=>'index'],
['class'=>'btn btn-outline-secondary btn-back me-2']
) ?>

<?= $this->Form->button(
'Update Blood Type',
['class'=>'btn-red']
) ?>

</div>

</div>

<?= $this->Form->end() ?>

</div>

</div>