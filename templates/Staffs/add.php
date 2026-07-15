<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.form-card{
    max-width:850px;
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

.section-title{
    color:#c1121f;
    font-weight:700;
    font-size:17px;
    margin:25px 0 15px;
}

.btn-red{
    background:#c1121f;
    color:white;
    border:none;
    border-radius:12px;
    padding:10px 22px;
    font-weight:600;
}

.btn-red:hover{
    background:#9b0f19;
    color:white;
}

.btn-back{
    border-radius:12px;
}
</style>

<div class="container py-5">

    <div class="form-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="page-title">🧑‍⚕️ Add Staff</h2>
                <p class="text-muted mb-0">Register a new staff profile in RedConnect.</p>
            </div>

            <?= $this->Html->link('← Back', ['action'=>'index'], ['class'=>'btn btn-outline-secondary btn-back']) ?>
        </div>

        <?= $this->Form->create($staff) ?>

        <div class="section-title">Account Information</div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <?= $this->Form->control('user_id', [
                    'label'=>'User Account',
                    'options'=>$users,
                    'empty'=>'Select User',
                    'class'=>'form-select'
                ]) ?>
            </div>
        </div>

        <div class="section-title">Staff Information</div>

        <div class="row">

            <div class="col-md-12 mb-3">
                <?= $this->Form->control('full_name', [
                    'label'=>'Full Name',
                    'class'=>'form-control'
                ]) ?>
            </div>

            <div class="col-md-6 mb-3">
                <?= $this->Form->control('phone_number', [
                    'label'=>'Phone Number',
                    'class'=>'form-control'
                ]) ?>
            </div>

            <div class="col-md-6 mb-3">
                <?= $this->Form->control('position', [
                    'label'=>'Position',
                    'class'=>'form-control',
                    'placeholder'=>'Example: Admin, Nurse, Medical Staff'
                ]) ?>
            </div>

        </div>

        <div class="text-end mt-4">
            <?= $this->Html->link('Cancel', ['action'=>'index'], ['class'=>'btn btn-outline-secondary me-2']) ?>

            <?= $this->Form->button('Save Staff', ['class'=>'btn-red']) ?>
        </div>

        <?= $this->Form->end() ?>

    </div>

</div>