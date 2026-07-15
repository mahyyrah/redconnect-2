<style>
body { 
background:#f6f7fb; 
font-family:'Segoe UI',sans-serif; 
font-size:15px; 
overflow-x:hidden; 
}

.dashboard-wrapper { 
display:flex; 
min-height:100vh; 
}

.sidebar { 
width:260px; background:#fff; 
border-right:1px solid #eee; 
padding:28px 20px; 
position:fixed; 
height:100vh; 
}

.logo-box { 
background:linear-gradient(135deg,#c1121f,#780000); 
color:#fff; 
border-radius:20px; 
padding:18px; 
margin-bottom:30px; 
}

.logo-box h4 { 
font-size:21px; 
}

.logo-box small {
 font-size:14px; 
}

.sidebar a { 
display:flex; 
align-items:center; 
gap:12px; 
color:#555; 
text-decoration:none; 
padding:13px 16px; 
border-radius:14px; 
margin-bottom:8px; 
font-size:15px; 
font-weight:600; 
}

.sidebar a:hover,.sidebar a.active { 
background:#fff0f0; 
color:#c1121f; 
}

.main-content { 
    margin-left:260px; 
    padding:32px; 
    width:calc(100% - 260px); 
}

.topbar,.page-card { 
    background:#fff; 
    border-radius:22px; 
    box-shadow:0 8px 25px rgba(0,0,0,.05); 
}

.topbar { 
    padding:20px 26px; 
}

.topbar h4 { 
    font-size:24px; 
    font-weight:700; 
}

.topbar p,.page-subtitle { 
    font-size:14px; 
}

.top-action { 
    border-radius:12px; 
    background:#f1f3f5; 
    border:none; 
    padding:9px 14px; 
    font-size:14px; 
    font-weight:600; 
    color:#444; 
}

.top-action:hover { 
    background:#c1121f; 
    color:#fff; 
}

.profile-btn,.btn-red { 
    background:#c1121f; 
    color:#fff; 
    border:none; 
    font-weight:700; 
}

.profile-btn { 
    border-radius:12px; 
    padding:9px 18px; 
    font-size:14px; 
}

.page-card { 
    padding:28px; 
}

.page-title { 
    color:#c1121f; 
    font-size:24px; 
    font-weight:700; 
}

.btn-red { 
    border-radius:12px; 
    padding:9px 18px; 
    font-size:15px; 
    text-decoration:none; 
}

.btn-red:hover { 
    background:#9b0f19; 
    color:#fff; 
}

.table-responsive { 
    border-radius:16px; 
    overflow-x:auto; 
}

.table { 
    font-size:15px; 
    margin-bottom:0; 
    min-width:850px; 
}

.table thead th { 
    background:#c1121f; 
    color:white; 
    border:none; 
    padding:14px; 
    font-size:15px; 
    font-weight:600; 
    white-space:nowrap; 
}

.table tbody td { 
    padding:14px; 
    vertical-align:middle; 
}

.position-badge { 
    background:#fff0f0; 
    color:#c1121f; 
    padding:7px 13px; 
    border-radius:20px; 
    font-size:14px; 
    font-weight:700; 
}

.action-link { 
    display:inline-block; 
    text-decoration:none; 
    padding:7px 12px; 
    border-radius:9px; 
    font-size:14px; 
    font-weight:600; 
    margin:2px; 
}

.view-btn { 
    background:#e8f2ff; 
    color:#0d6efd; 
}

.edit-btn 
{ background:#fff4d6; 
color:#856404; 
}

.delete-btn 
{ background:#ffe4e4; 
color:#c1121f; 
}

body.dark-mode 
{ background:#121212; 
color:#f1f1f1; 
}

body.dark-mode .sidebar, body.dark-mode .topbar, body.dark-mode .page-card { 
    background:#1f1f1f; 
    color:#f1f1f1; 
    border-color:#333; 
}

body.dark-mode .sidebar a { 
    color:#ddd; 
}

body.dark-mode .sidebar a:hover, body.dark-mode .sidebar a.active { 
    background:#2d2d2d; 
    color:#ff6b6b; 
}

body.dark-mode .text-muted { 
    color:#b8b8b8!important; 
}

body.dark-mode .top-action { 
    background:#2d2d2d; 
    color:#f1f1f1; 
}

body.dark-mode .top-action:hover { 
    background:#ff6b6b; 
    color:#111; 
}

body.dark-mode .table-responsive, body.dark-mode .table, body.dark-mode .table tbody, body.dark-mode .table tbody tr, body.dark-mode .table tbody td { 
    background:#1f1f1f!important; 
    color:#f1f1f1!important; 
}

body.dark-mode .table tbody td { 
    border-color:#333!important; 
}

body.dark-mode .table tbody tr:hover td { 
    background:#2d2d2d!important; 
}

body.dark-mode .position-badge { 
    background:#2d2d2d; 
    color:#ff6b6b; 
}

@media(max-width:768px){ .sidebar{position:relative;width:100%;height:auto;} .dashboard-wrapper{display:block;} .main-content{margin-left:0;width:100%;padding:20px;} }
</style>

<?php $currentUser = $this->request->getSession()->read('Auth.User'); ?>

<div class="dashboard-wrapper">
    <aside class="sidebar">
        <div class="logo-box">
            <h4 class="fw-bold mb-1">🩸 RedConnect</h4>
            <small>Blood Donation System</small>
        </div>

        <?= $this->Html->link('🏠 Dashboard', ['controller'=>'Users','action'=>'dashboard']) ?>
        <?= $this->Html->link('👤 Users', ['controller'=>'Users','action'=>'index']) ?>
        <?= $this->Html->link('🩸 Donors', ['controller'=>'Donors','action'=>'index']) ?>
        <?= $this->Html->link('🧑‍⚕️ Staffs', ['controller'=>'Staffs','action'=>'index'], ['class'=>'active']) ?>
        <?= $this->Html->link('🅾️ Blood Types', ['controller'=>'BloodTypes','action'=>'index']) ?>
        <?= $this->Html->link('📅 Appointments', ['controller'=>'Appointments','action'=>'index']) ?>
        <?= $this->Html->link('📋 Donation Histories', ['controller'=>'DonationHistories','action'=>'index']) ?>
        <?= $this->Html->link('🏅 Certificates', ['controller'=>'Certificates','action'=>'index']) ?>

        <hr>
        <?= $this->Html->link('🚪 Logout', ['controller'=>'Users','action'=>'logout']) ?>
    </aside>

    <main class="main-content">
        <div class="topbar d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="mb-1">Staff Management</h4>
                <p class="text-muted mb-0">Manage staff profiles and positions.</p>
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
                        <li><?= $this->Html->link('Logout', ['controller'=>'Users','action'=>'logout'], ['class'=>'dropdown-item']) ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h2 class="page-title mb-1">🧑‍⚕️ Staff List</h2>
                    <p class="text-muted page-subtitle mb-0">All registered staff members in RedConnect.</p>
                </div>

                <?= $this->Html->link('+ Add Staff', ['action'=>'add'], ['class'=>'btn-red']) ?>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th>Phone Number</th>
                            <th>Position</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($staffs as $staff): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $staff->hasValue('user') ? h($staff->user->email) : '-' ?></td>
                                <td class="fw-semibold"><?= h($staff->full_name) ?></td>
                                <td><?= h($staff->phone_number) ?></td>
                                <td><span class="position-badge"><?= h($staff->position) ?></span></td>
                                <td class="text-center">
                                    <?= $this->Html->link('View', ['action'=>'view',$staff->id], ['class'=>'action-link view-btn']) ?>
                                    <?= $this->Html->link('Edit', ['action'=>'edit',$staff->id], ['class'=>'action-link edit-btn']) ?>
                                    <?= $this->Form->postLink('Delete', ['action'=>'delete',$staff->id], [
                                        'method'=>'delete',
                                        'confirm'=>__('Are you sure you want to delete # {0}?',$staff->id),
                                        'class'=>'action-link delete-btn'
                                    ]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if ($staffs->count() == 0): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No staff records found.</td>
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
    localStorage.setItem("redconnect-theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
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