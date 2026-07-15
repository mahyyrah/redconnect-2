<style>
body {
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
    font-size:15px;
}

.form-card {
    max-width:750px;
    margin:40px auto;
    background:#fff;
    border-radius:24px;
    padding:32px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.page-title {
    color:#c1121f;
    font-size:24px;
    font-weight:700;
}

.form-control,
.form-select {
    height:46px;
    border-radius:12px;
    font-size:15px;
}

.btn-red {
    background:#c1121f;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 20px;
    font-weight:600;
}

.btn-red:hover {
    background:#9b0f19;
    color:#fff;
}

.btn-back {
    border-radius:12px;
    padding:10px 20px;
    font-weight:600;
}
</style>

<div class="form-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1">👤 Add User</h2>
            <p class="text-muted mb-0">Create a new login account for RedConnect.</p>
        </div>

        <?= $this->Html->link('← Back', ['action' => 'index'], ['class' => 'btn btn-outline-secondary btn-back']) ?>
    </div>

    <?= $this->Form->create($user) ?>

    <div class="row g-3">

        <div class="col-md-12">
            <?= $this->Form->control('email', [
                'label' => 'Email Address',
                'type' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Enter email address'
            ]) ?>
        </div>

        <div class="col-md-12">
            <?= $this->Form->control('password', [
                'label' => 'Password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Enter password'
            ]) ?>
        </div>

        <div class="col-md-12">
            <?= $this->Form->control('role', [
                'label' => 'User Role',
                'options' => [
                    'admin' => 'Admin',
                    'staff' => 'Staff',
                    'donor' => 'Donor'
                ],
                'empty' => 'Select role',
                'class' => 'form-select'
            ]) ?>
        </div>

    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
        <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-outline-secondary btn-back']) ?>

        <?= $this->Form->button('Save User', ['class' => 'btn-red']) ?>
    </div>

    <?= $this->Form->end() ?>

</div>