<?php
$currentUser = $this->request->getSession()->read('Auth.User');

$currentEmail = '';
if (is_array($currentUser)) {
    $currentEmail = $currentUser['email'] ?? '';
} elseif (is_object($currentUser)) {
    $currentEmail = $currentUser->email ?? '';
}
?>

<style>
body {
    background: #f6f7fb;
    font-family: 'Segoe UI', sans-serif;
    font-size: 15px;
    overflow-x: hidden;
}

.dashboard-wrapper {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    width: 260px;
    background: #ffffff;
    border-right: 1px solid #eee;
    padding: 28px 20px;
    position: fixed;
    height: 100vh;
}

.logo-box {
    background: linear-gradient(135deg, #c1121f, #780000);
    color: white;
    border-radius: 20px;
    padding: 18px;
    margin-bottom: 30px;
}

.logo-box h4 { font-size: 21px; }
.logo-box small { font-size: 14px; }

.sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #555;
    text-decoration: none;
    padding: 13px 16px;
    border-radius: 14px;
    margin-bottom: 8px;
    font-size: 15px;
    font-weight: 600;
}

.sidebar a:hover,
.sidebar a.active {
    background: #fff0f0;
    color: #c1121f;
}

.main-content {
    margin-left: 260px;
    padding: 32px;
    width: calc(100% - 260px);
}

.topbar,
.profile-card {
    background: white;
    border-radius: 22px;
    box-shadow: 0 8px 25px rgba(0,0,0,.05);
}

.topbar {
    padding: 20px 26px;
}

.topbar h4 {
    font-size: 24px;
    font-weight: 700;
}

.topbar p {
    font-size: 14px;
}

.profile-card {
    padding: 28px;
}

.profile-header {
    background: linear-gradient(135deg, #c1121f, #780000);
    color: white;
    border-radius: 24px;
    padding: 30px;
    margin-bottom: 24px;
}

.avatar {
    width: 78px;
    height: 78px;
    border-radius: 20px;
    background: rgba(255,255,255,.18);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
}

.profile-header h2 {
    font-size: 26px;
    font-weight: 700;
}

.profile-header p {
    font-size: 15px;
}

.info-box {
    background: #fff7f7;
    border: 1px solid #f1dada;
    border-radius: 18px;
    padding: 18px;
    height: 100%;
}

.info-label {
    color: #777;
    font-size: 13px;
    margin-bottom: 6px;
}

.info-value {
    font-size: 15px;
    font-weight: 600;
    color: #333;
}

.form-control {
    border-radius: 12px !important;
    min-height: 44px;
    font-size: 15px;
}

textarea.form-control {
    min-height: 110px;
}

.form-control:focus {
    border-color: #c1121f;
    box-shadow: 0 0 0 .2rem rgba(193,18,31,.15);
}

.blood-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #c1121f;
    color: #fff;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 700;
}

.btn-red,
.btn-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    padding: 10px 20px;
    min-height: 44px;
    min-width: 130px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border: none;
}

.btn-red {
    background: #c1121f;
    color: white;
}

.btn-red:hover {
    background: #9b0f19;
    color: white;
}

.btn-back {
    background: #f1f3f5;
    color: #444;
}

.btn-back:hover {
    background: #e2e6ea;
    color: #222;
}

.top-action {
    border-radius: 12px;
    background: #f1f3f5;
    border: none;
    padding: 9px 14px;
    font-size: 14px;
    font-weight: 600;
    color: #444;
}

.top-action:hover {
    background: #c1121f;
    color: white;
}

.profile-btn {
    border-radius: 12px;
    background: #c1121f;
    color: white;
    border: none;
    padding: 9px 18px;
    font-size: 14px;
    font-weight: 700;
}

.empty-card {
    background: #fff;
    border-radius: 22px;
    padding: 35px;
    box-shadow: 0 8px 25px rgba(0,0,0,.05);
    text-align: center;
}

@media (max-width: 768px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
    }

    .dashboard-wrapper {
        display: block;
    }

    .main-content {
        margin-left: 0;
        width: 100%;
        padding: 20px;
    }
}
</style>

<div class="dashboard-wrapper">

    <aside class="sidebar">
        <div class="logo-box">
            <h4 class="fw-bold mb-1">🩸 RedConnect</h4>
            <small>Donor Portal</small>
        </div>

        <?= $this->Html->link('🏠 Dashboard', ['controller'=>'DonorPortal','action'=>'dashboard']) ?>
        <?= $this->Html->link('👤 My Profile', ['controller'=>'DonorPortal','action'=>'profile'], ['class'=>'active']) ?>
        <?= $this->Html->link('📅 My Appointments', ['controller'=>'DonorPortal','action'=>'appointments']) ?>
        <?= $this->Html->link('🏅 My Certificates', ['controller'=>'DonorPortal','action'=>'certificates']) ?>

        <hr>

        <?= $this->Html->link('🚪 Logout', ['controller'=>'Users','action'=>'logout']) ?>
    </aside>

    <main class="main-content">

        <div class="topbar d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="mb-1">Update Profile</h4>
                <p class="text-muted mb-0">Update your phone number and address.</p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="top-action" onclick="toggleDarkMode()" type="button">🌙 Dark</button>
                <button class="top-action" onclick="toggleFull()" type="button">⛶</button>

                <div class="dropdown">
                    <button class="profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Donor
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">
                            <strong>Donor</strong><br>
                            <small><?= h($currentEmail) ?></small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><?= $this->Html->link('Logout', ['controller'=>'Users','action'=>'logout'], ['class'=>'dropdown-item']) ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <?= $this->Flash->render() ?>

        <?php if ($donor): ?>

            <div class="profile-card">

                <div class="profile-header d-flex align-items-center gap-3 flex-wrap">
                    <div class="avatar">✏️</div>

                    <div>
                        <h2 class="mb-1"><?= h($donor->full_name) ?></h2>
                        <p class="mb-0 opacity-75">
                            Edit allowed details only
                        </p>
                    </div>
                </div>

                <?= $this->Form->create($donor) ?>

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="info-label">Email Address</div>
                            <div class="info-value"><?= h($currentEmail ?: '-') ?></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="info-label">Blood Group</div>
                            <div class="info-value">
                                <span class="blood-badge">
                                    <?= h($donor->blood_type->blood_group ?? '-') ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-box">
                            <div class="info-label">IC Number</div>
                            <div class="info-value"><?= h($donor->ic_number ?: '-') ?></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-box">
                            <div class="info-label">Gender</div>
                            <div class="info-value"><?= h($donor->gender ?: '-') ?></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-box">
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value"><?= h($donor->date_of_birth ?: '-') ?></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="info-label">Phone Number</div>
                            <?= $this->Form->control('phone_number', [
                                'label' => false,
                                'class' => 'form-control',
                                'value' => $donor->phone_number,
                                'placeholder' => 'Enter phone number'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="info-label">Last Donation</div>
                            <div class="info-value"><?= h($donor->last_donation ?: 'No donation yet') ?></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="info-box">
                            <div class="info-label">Address</div>
                            <?= $this->Form->control('address', [
                                'type' => 'textarea',
                                'rows' => 4,
                                'label' => false,
                                'class' => 'form-control',
                                'value' => $donor->address,
                                'placeholder' => 'Enter address'
                            ]) ?>
                        </div>
                    </div>

                </div>

                <div class="text-end mt-4">
                    <?= $this->Html->link(
                        'Cancel',
                        ['controller'=>'DonorPortal','action'=>'profile'],
                        ['class'=>'btn-back me-2']
                    ) ?>

                    <?= $this->Form->button(
                        '💾 Save Changes',
                        ['class'=>'btn-red']
                    ) ?>
                </div>

                <?= $this->Form->end() ?>

            </div>

        <?php else: ?>

            <div class="empty-card">
                <h4 class="text-danger fw-bold">No donor profile found</h4>
                <p class="text-muted mb-0">Your donor information has not been linked to this account yet.</p>
            </div>

        <?php endif; ?>

    </main>
</div>

<script>
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
}

function toggleFull() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
    } else {
        document.exitFullscreen();
    }
}
</script>