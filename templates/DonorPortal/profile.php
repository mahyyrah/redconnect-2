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

.btn-red {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #c1121f;
    color: white;
    border-radius: 12px;
    padding: 10px 20px;
    min-height: 44px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border: none;
}

.btn-red:hover {
    background: #9b0f19;
    color: white;
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

/* DARK MODE */
body.dark-mode {
    background: #121212;
    color: #f1f1f1;
}

body.dark-mode .sidebar,
body.dark-mode .topbar,
body.dark-mode .profile-card,
body.dark-mode .empty-card {
    background: #1f1f1f;
    color: #f1f1f1;
    border-color: #333;
}

body.dark-mode .sidebar a {
    color: #ddd;
}

body.dark-mode .sidebar a:hover,
body.dark-mode .sidebar a.active {
    background: #2d2d2d;
    color: #ff6b6b;
}

body.dark-mode .text-muted {
    color: #b8b8b8 !important;
}

body.dark-mode .profile-header {
    background: linear-gradient(135deg, #8b0000, #4b0000);
}

body.dark-mode .info-box {
    background: #2b2b2b;
    border-color: #444;
}

body.dark-mode .info-label {
    color: #b8b8b8;
}

body.dark-mode .info-value {
    color: #f1f1f1;
}

body.dark-mode .top-action {
    background: #2d2d2d;
    color: #f1f1f1;
}

body.dark-mode .top-action:hover {
    background: #ff6b6b;
    color: #111;
}

body.dark-mode .blood-badge {
    background: #2d2d2d;
    color: #ff6b6b;
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

       <?= $this->Html->link(
    '🏠 Dashboard',
    ['controller'=>'DonorPortal','action'=>'dashboard']
) ?>

<?= $this->Html->link(
    '👤 My Profile',
    ['controller'=>'DonorPortal','action'=>'profile'],
    ['class'=>'active']
) ?>

<?= $this->Html->link(
    '📅 My Appointments',
    ['controller'=>'DonorPortal','action'=>'appointments']
) ?>

<?= $this->Html->link(
    '📋 Donation History',
    ['controller'=>'DonorPortal','action'=>'donationHistory']
) ?>

<?= $this->Html->link(
    '🏅 My Certificates',
    ['controller'=>'DonorPortal','action'=>'certificates']
) ?>

<hr>

<?= $this->Html->link(
    '🚪 Logout',
    ['controller'=>'Users','action'=>'logout']
) ?>
    </aside>

    <main class="main-content">

        <div class="topbar d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="mb-1">My Profile</h4>
                <p class="text-muted mb-0">View your donor information and personal details.</p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="top-action" onclick="toggleDarkMode()" type="button">🌙 Dark</button>
                <button class="top-action" onclick="toggleFull()" type="button">⛶</button>
                <button class="top-action" onclick="showNotification()" type="button">🔔</button>

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

        <?php if ($donor): ?>

            <div class="profile-card">

                <div class="profile-header d-flex align-items-center gap-3 flex-wrap">
                    <div class="avatar">👤</div>

                    <div>
                        <h2 class="mb-1"><?= h($donor->full_name) ?></h2>
                        <p class="mb-0 opacity-75">
                            RedConnect Blood Donor
                        </p>
                    </div>
                </div>

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
                            <div class="info-label">Phone Number</div>
                            <div class="info-value"><?= h($donor->phone_number ?: '-') ?></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-box">
                            <div class="info-label">Gender</div>
                            <div class="info-value"><?= h($donor->gender ?: '-') ?></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value"><?= h($donor->date_of_birth ?: '-') ?></div>
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
                            <div class="info-value"><?= nl2br(h($donor->address ?: '-')) ?></div>
                        </div>
                    </div>

                </div>

                <div class="text-end mt-4">
                    <?= $this->Html->link(
    '✏️ Update Profile',
    ['controller' => 'DonorPortal', 'action' => 'editProfile'],
    ['class' => 'btn-red']
) ?>
                </div>

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

    if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("redconnect-theme", "dark");
    } else {
        localStorage.setItem("redconnect-theme", "light");
    }
}

function toggleFull() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(function() {
            alert("Fullscreen mode is not supported by this browser.");
        });
    } else {
        document.exitFullscreen();
    }
}

function showNotification() {
    alert("No new notifications at the moment.");
}

window.onload = function () {
    if (localStorage.getItem("redconnect-theme") === "dark") {
        document.body.classList.add("dark-mode");
    }
}
</script>