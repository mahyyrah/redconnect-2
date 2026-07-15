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
            <h2 class="page-title mb-1">✏️ Edit User</h2>
            <p class="text-muted mb-0">Update user account details.</p>
        </div>

        <?= $this->Html->link('← Back', ['action' => 'index'], ['class' => 'btn btn-outline-secondary btn-back']) ?>
    </div>

    <?= $this->Form->create($user) ?>

    <div class="row g-3">

        <div class="col-md-12">
            <?= $this->Form->control('email', [
                'label' => 'Email Address',
                'type' => 'email',
                'class' => 'form-control'
            ]) ?>
        </div>

        <div class="col-md-12">
            <?= $this->Form->control('password', [
                'label' => 'Password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Enter new password'
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
                'class' => 'form-select'
            ]) ?>
        </div>

    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">

        <?= $this->Form->postLink(
            'Delete User',
            ['action' => 'delete', $user->id],
            [
                'confirm' => __('Are you sure you want to delete # {0}?', $user->id),
                'class' => 'btn btn-outline-danger btn-back'
            ]
        ) ?>

        <div class="d-flex gap-2">
            <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-outline-secondary btn-back']) ?>

            <?= $this->Form->button('Update User', ['class' => 'btn-red']) ?>
        </div>

    </div>

    <?= $this->Form->end() ?>

</div>