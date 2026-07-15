<style>
body {
    background: #f6f7fb;
    font-family: 'Segoe UI', sans-serif;
    font-size: 15px;
}

.signup-card {
    max-width: 850px;
    margin: 45px auto;
    background: white;
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

.signup-title {
    color: #c1121f;
    font-size: 26px;
    font-weight: 700;
}

.form-control, .form-select {
    height: 44px;
    border-radius: 11px;
    font-size: 15px;
}

textarea.form-control {
    height: 90px;
}

.btn-red {
    background: #c1121f;
    color: white;
    border-radius: 11px;
    padding: 10px 20px;
    font-weight: 600;
    border: none;
}

.btn-red:hover {
    background: #9b0f19;
    color: white;
}
</style>

<div class="signup-card">

    <h2 class="signup-title mb-1">Create Donor Account</h2>
    <p class="text-muted mb-4">Register as a blood donor in RedConnect.</p>

    <?= $this->Flash->render() ?>

    <?= $this->Form->create() ?>

    <h5 class="fw-bold text-danger mb-3">Login Information</h5>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <?= $this->Form->control('email', [
                'label' => 'Email Address',
                'type' => 'email',
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $this->Form->control('password', [
                'label' => 'Password',
                'type' => 'password',
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>
    </div>

    <h5 class="fw-bold text-danger mb-3">Donor Profile</h5>

    <div class="row g-3">
        <div class="col-md-6">
            <?= $this->Form->control('full_name', [
                'label' => 'Full Name',
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $this->Form->control('ic_number', [
                'label' => 'IC Number',
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $this->Form->control('phone_number', [
                'label' => 'Phone Number',
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $this->Form->control('blood_type_id', [
                'label' => 'Blood Type',
                'options' => $bloodTypes,
                'empty' => 'Select blood type',
                'class' => 'form-select',
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $this->Form->control('gender', [
                'label' => 'Gender',
                'options' => ['Male' => 'Male', 'Female' => 'Female'],
                'empty' => 'Select gender',
                'class' => 'form-select',
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $this->Form->control('date_of_birth', [
                'label' => 'Date of Birth',
                'type' => 'date',
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $this->Form->control('last_donation', [
                'label' => 'Last Donation Date',
                'type' => 'date',
                'class' => 'form-control',
                'empty' => true
            ]) ?>
        </div>

        <div class="col-md-12">
            <?= $this->Form->control('address', [
                'label' => 'Address',
                'type' => 'textarea',
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <?= $this->Html->link('Already have an account? Login', ['action' => 'login'], ['class' => 'text-danger fw-semibold']) ?>

        <?= $this->Form->button('Create Account', ['class' => 'btn-red']) ?>
    </div>

    <?= $this->Form->end() ?>

</div>