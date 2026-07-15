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

.topbar {
    background: white;
    border-radius: 22px;
    padding: 20px 26px;
    box-shadow: 0 8px 25px rgba(0,0,0,.05);
}

.topbar h4 {
    font-size: 24px;
    font-weight: 700;
}

.topbar p {
    font-size: 14px;
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

.page-card {
    background: #ffffff;
    border-radius: 22px;
    padding: 28px;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

.page-title {
    color: #c1121f;
    font-size: 24px;
    font-weight: 700;
}

.page-subtitle {
    font-size: 14px;
}

.btn-red {
    background: #c1121f;
    color: white;
    border-radius: 12px;
    padding: 9px 18px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border: none;
}

.btn-red:hover {
    background: #9b0f19;
    color: white;
}

.search-box {
    background: #fff7f7;
    border: 1px solid #f1dada;
    border-radius: 16px;
    padding: 16px;
    margin: 24px 0;
}

.search-box form,
.search-box .input {
    margin: 0 !important;
}

.search-box .form-control {
    height: 44px;
    border-radius: 11px;
    font-size: 15px;
    padding: 9px 14px;
}

.search-box .btn {
    height: 44px;
    border-radius: 11px;
    font-size: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
}

.table-responsive {
    border-radius: 16px;
    overflow-x: auto;
}

.table {
    font-size: 15px;
    margin-bottom: 0;
    min-width: 1050px;
}

.table thead th {
    background: #c1121f;
    color: white;
    border: none;
    padding: 14px;
    font-size: 15px;
    font-weight: 600;
    white-space: nowrap;
}

.table tbody td {
    padding: 14px;
    vertical-align: middle;
}

.badge-blood {
    background: #c1121f;
    color: white;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.action-link {
    display: inline-block;
    text-decoration: none;
    padding: 7px 12px;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 600;
    margin: 2px;
}

.view-btn { background: #e8f2ff; color: #0d6efd; }
.edit-btn { background: #fff4d6; color: #856404; }
.delete-btn { background: #ffe4e4; color: #c1121f; }

/* DARK MODE SAME AS DASHBOARD */
body.dark-mode {
    background: #121212;
    color: #f1f1f1;
}

body.dark-mode .sidebar,
body.dark-mode .topbar,
body.dark-mode .page-card {
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

body.dark-mode .top-action {
    background: #2d2d2d;
    color: #f1f1f1;
}

body.dark-mode .top-action:hover {
    background: #ff6b6b;
    color: #111;
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
body.dark-mode .table-responsive,
body.dark-mode .table,
body.dark-mode .table tbody,
body.dark-mode .table tbody tr,
body.dark-mode .table tbody td {
    background: #1f1f1f !important;
    color: #f1f1f1 !important;
}

body.dark-mode .table tbody td {
    border-color: #333 !important;
}

body.dark-mode .table tbody tr:hover td {
    background: #2d2d2d !important;
}
body.dark-mode .search-box{
    background:#2a2a2a !important;
    border:1px solid #3a3a3a !important;
}

body.dark-mode .search-box .form-control{
    background:#1f1f1f !important;
    color:#fff !important;
    border:1px solid #444 !important;
}

body.dark-mode .search-box .form-control::placeholder{
    color:#9e9e9e;
}

body.dark-mode .btn-outline-secondary{
    background:#2b2b2b !important;
    border-color:#555 !important;
    color:#ddd !important;
}

body.dark-mode .btn-outline-secondary:hover{
    background:#3b3b3b !important;
}
/* Chrome, Edge */
.table-responsive::-webkit-scrollbar{
    height:10px;
}

.table-responsive::-webkit-scrollbar-track{
    background:#1f1f1f;
    border-radius:20px;
}

.table-responsive::-webkit-scrollbar-thumb{
    background:#555;
    border-radius:20px;
}

.table-responsive::-webkit-scrollbar-thumb:hover{
    background:#777;
}

/* Firefox */
.table-responsive{
    scrollbar-width:thin;
    scrollbar-color:#555 #1f1f1f;
}
body.dark-mode .search-box{
    background:#252525 !important;
}
</style>

<?php $currentUser = $this->request->getSession()->read('Auth.User'); ?>

<div class="dashboard-wrapper">

    <aside class="sidebar">
        <div class="logo-box">
            <h4 class="fw-bold mb-1">🩸 RedConnect</h4>
            <small>Blood Donation System</small>
        </div>

        <?= $this->Html->link('🏠 Dashboard', ['controller' => 'Users', 'action' => 'dashboard']) ?>
        <?= $this->Html->link('👤 Users', ['controller' => 'Users', 'action' => 'index']) ?>
        <?= $this->Html->link('🩸 Donors', ['controller' => 'Donors', 'action' => 'index'], ['class' => 'active']) ?>
        <?= $this->Html->link('🧑‍⚕️ Staffs', ['controller' => 'Staffs', 'action' => 'index']) ?>
        <?= $this->Html->link('🅾️ Blood Types', ['controller' => 'BloodTypes', 'action' => 'index']) ?>
        <?= $this->Html->link('📅 Appointments', ['controller' => 'Appointments', 'action' => 'index']) ?>
        <?= $this->Html->link('📋 Donation Histories', ['controller' => 'DonationHistories', 'action' => 'index']) ?>
        <?= $this->Html->link('🏅 Certificates', ['controller' => 'Certificates', 'action' => 'index']) ?>

        <hr>

        <?= $this->Html->link('🚪 Logout', ['controller' => 'Users', 'action' => 'logout']) ?>
    </aside>

    <main class="main-content">

        <div class="topbar d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="mb-1">Donor Management</h4>
                <p class="text-muted mb-0">Manage donor personal details and blood type information.</p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="top-action" onclick="toggleDarkMode()" type="button">🌙 Dark</button>
                <button class="top-action" onclick="toggleFull()" type="button">⛶</button>
                <button class="top-action" type="button">🔔</button>

                <div class="dropdown">
                    <button class="profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <?= ucfirst(h($currentUser->role ?? 'User')) ?>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">
                            <strong><?= ucfirst(h($currentUser->role ?? 'User')) ?></strong><br>
                            <small><?= h($currentUser->email ?? '') ?></small>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item']) ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-card">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="page-title mb-1">🩸 Donor List</h2>
                    <p class="text-muted page-subtitle mb-0">All registered donors in RedConnect.</p>
                </div>

                <?= $this->Html->link('+ Add Donor', ['action' => 'add'], ['class' => 'btn-red']) ?>
            </div>

            <div class="search-box">
                <?= $this->Form->create(null, ['type' => 'get']) ?>

                <div class="row g-2 align-items-center">
                    <div class="col-lg-8 col-md-12">
                        <?= $this->Form->control('search', [
                            'label' => false,
                            'value' => $search ?? '',
                            'placeholder' => 'Search by name, IC number, phone, email, or blood group...',
                            'class' => 'form-control'
                        ]) ?>
                    </div>

                    <div class="col-lg-2 col-6">
                        <?= $this->Form->button('Search', ['class' => 'btn btn-danger w-100']) ?>
                    </div>

                    <div class="col-lg-2 col-6">
                        <?= $this->Html->link('Reset', ['action' => 'index'], [
                            'class' => 'btn btn-outline-secondary w-100'
                        ]) ?>
                    </div>
                </div>

                <?= $this->Form->end() ?>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Donor Name</th>
                            <th>Email</th>
                            <th>Blood Group</th>
                            <th>IC Number</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Last Donation</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($donors as $donor): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-semibold"><?= h($donor->full_name) ?></td>
                                <td><?= $donor->hasValue('user') ? h($donor->user->email) : '-' ?></td>
                                <td>
                                    <span class="badge-blood">
                                        <?= $donor->hasValue('blood_type') ? h($donor->blood_type->blood_group) : '-' ?>
                                    </span>
                                </td>
                                <td><?= h($donor->ic_number) ?></td>
                                <td><?= h($donor->phone_number) ?></td>
                                <td><?= h($donor->gender) ?></td>
                                <td><?= h($donor->last_donation ?: '-') ?></td>

                                <td class="text-center">
                                    <?= $this->Html->link('View', ['action' => 'view', $donor->id], ['class' => 'action-link view-btn']) ?>
                                    <?= $this->Html->link('Edit', ['action' => 'edit', $donor->id], ['class' => 'action-link edit-btn']) ?>
                                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $donor->id], [
                                        'confirm' => __('Are you sure you want to delete {0}?', $donor->full_name),
                                        'class' => 'action-link delete-btn'
                                    ]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if ($donors->count() == 0): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No donor records found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>

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
        document.documentElement.requestFullscreen();
    } else {
        document.exitFullscreen();
    }
}

window.onload = function () {
    if (localStorage.getItem("redconnect-theme") === "dark") {
        document.body.classList.add("dark-mode");
    }
}
</script>