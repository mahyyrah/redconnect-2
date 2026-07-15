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
body{background:#f6f7fb;font-family:'Segoe UI',sans-serif;font-size:15px;overflow-x:hidden;}
.dashboard-wrapper{display:flex;min-height:100vh;}
.sidebar{width:260px;background:#fff;border-right:1px solid #eee;padding:28px 20px;position:fixed;height:100vh;}
.logo-box{background:linear-gradient(135deg,#c1121f,#780000);color:white;border-radius:20px;padding:18px;margin-bottom:30px;}
.logo-box h4{font-size:21px}.logo-box small{font-size:14px}
.sidebar a{display:flex;align-items:center;gap:12px;color:#555;text-decoration:none;padding:13px 16px;border-radius:14px;margin-bottom:8px;font-size:15px;font-weight:600;}
.sidebar a:hover,.sidebar a.active{background:#fff0f0;color:#c1121f;}
.main-content{margin-left:260px;padding:32px;width:calc(100% - 260px);}
.topbar,.page-card{background:white;border-radius:22px;box-shadow:0 8px 25px rgba(0,0,0,.05);}
.topbar{padding:20px 26px;}
.topbar h4{font-size:24px;font-weight:700;}
.topbar p{font-size:14px;}
.page-card{padding:28px;margin-bottom:24px;}
.page-title{color:#c1121f;font-size:24px;font-weight:700;}
.top-action{border-radius:12px;background:#f1f3f5;border:none;padding:9px 14px;font-size:14px;font-weight:600;color:#444;}
.top-action:hover{background:#c1121f;color:white;}
.profile-btn{border-radius:12px;background:#c1121f;color:white;border:none;padding:9px 18px;font-size:14px;font-weight:700;}
.table-responsive{border-radius:16px;overflow-x:auto;}
.table{font-size:15px;margin-bottom:0;}
.table thead th{background:#c1121f;color:white;border:none;padding:14px;font-size:15px;font-weight:600;white-space:nowrap;}
.table tbody td{padding:14px;vertical-align:middle;}
.qty-badge{display:inline-flex;align-items:center;justify-content:center;background:#fff0f0;color:#c1121f;padding:6px 14px;border-radius:999px;font-size:14px;font-weight:700;}
.cert-btn{display:inline-flex;align-items:center;justify-content:center;background:#e8f2ff;color:#0d6efd;border-radius:10px;padding:7px 13px;font-size:14px;font-weight:600;text-decoration:none;}
.cert-btn:hover{background:#d8eaff;color:#0d6efd;}
.empty-card{text-align:center;padding:40px;color:#777;}

/* DARK MODE */
body.dark-mode{background:#121212;color:#f1f1f1;}
body.dark-mode .sidebar,
body.dark-mode .topbar,
body.dark-mode .page-card{background:#1f1f1f;color:#f1f1f1;border-color:#333;}
body.dark-mode .sidebar a{color:#ddd;}
body.dark-mode .sidebar a:hover,
body.dark-mode .sidebar a.active{background:#2d2d2d;color:#ff6b6b;}
body.dark-mode .text-muted{color:#bdbdbd!important;}
body.dark-mode .top-action{background:#2d2d2d;color:#fff;}
body.dark-mode .top-action:hover{background:#ff6b6b;color:#111;}
body.dark-mode .table{color:#f1f1f1;}
body.dark-mode .table tbody td{border-color:#333;}
body.dark-mode .qty-badge{background:#2d2d2d;color:#ff6b6b;}
body.dark-mode .cert-btn{background:#2d2d2d;color:#8ab4ff;}
body.dark-mode .cert-btn:hover{background:#333;color:#8ab4ff;}
body.dark-mode .empty-card{color:#bdbdbd;}

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

body.dark-mode .qty-badge {
    background: #2d2d2d;
    color: #ff6b6b;
}

body.dark-mode .cert-btn {
    background: #2d2d2d;
    color: #8ab4ff;
}
@media(max-width:768px){.sidebar{position:relative;width:100%;height:auto}.dashboard-wrapper{display:block}.main-content{margin-left:0;width:100%;padding:20px}}
</style>

<div class="dashboard-wrapper">

<aside class="sidebar">
    <div class="logo-box">
        <h4 class="fw-bold mb-1">🩸 RedConnect</h4>
        <small>Donor Portal</small>
    </div>

    <?= $this->Html->link('🏠 Dashboard', ['controller'=>'DonorPortal','action'=>'dashboard']) ?>
    <?= $this->Html->link('👤 My Profile', ['controller'=>'DonorPortal','action'=>'profile']) ?>
    <?= $this->Html->link('📅 My Appointments', ['controller'=>'DonorPortal','action'=>'appointments']) ?>
    <?= $this->Html->link('📋 Donation History', ['controller'=>'DonorPortal','action'=>'donationHistory'], ['class'=>'active']) ?>
    <?= $this->Html->link('🏅 My Certificates', ['controller'=>'DonorPortal','action'=>'certificates']) ?>

    <hr>

    <?= $this->Html->link('🚪 Logout', ['controller'=>'Users','action'=>'logout']) ?>
</aside>

<main class="main-content">

    <div class="topbar d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h4 class="mb-1">Donation History</h4>
            <p class="text-muted mb-0">View your completed blood donation records.</p>
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

    <?= $this->Flash->render() ?>

    <div class="page-card">
        <div class="mb-4">
            <h2 class="page-title mb-1">📋 Completed Donations</h2>
            <p class="text-muted mb-0">These records are created after staff confirm your blood donation.</p>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Donation Date</th>
                        <th>Quantity Pack</th>
                        <th>Staff</th>
                        <th>Appointment</th>
                        <th>Remarks</th>
                        <th>Certificate</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>

                    <?php foreach ($donationHistories as $history): ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td><?= h($history->donation_date ?? '-') ?></td>

                            <td>
                                <span class="qty-badge">
                                    <?= h($history->quantity_pack ?? '-') ?> Pack
                                </span>
                            </td>

                            <td>
                                <?= h($history->staff->full_name ?? '-') ?>
                            </td>

                            <td>
                                <?php if (!empty($history->appointment)): ?>
                                    <?= h($history->appointment->appointment_date ?? '-') ?>
                                    <?= h($history->appointment->appointment_time ?? '') ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td><?= h($history->remarks ?: '-') ?></td>

                            <td>
                                <?php if (!empty($history->certificate)): ?>
                                    <?= $this->Html->link(
                                        'View',
                                        ['controller'=>'DonorPortal','action'=>'viewCertificate',$history->certificate->id],
                                        ['class'=>'cert-btn']
                                    ) ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($donationHistories) || $donationHistories->count() == 0): ?>
                        <tr>
                            <td colspan="7" class="empty-card">
                                No donation history records found.
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
function toggleDarkMode(){
    document.body.classList.toggle("dark-mode");

    if(document.body.classList.contains("dark-mode")){
        localStorage.setItem("redconnect-theme","dark");
    }else{
        localStorage.setItem("redconnect-theme","light");
    }
}

function toggleFull(){
    if(!document.fullscreenElement){
        document.documentElement.requestFullscreen().catch(function(){
            alert("Fullscreen is not supported.");
        });
    }else{
        document.exitFullscreen();
    }
}

function showNotification(){
    alert("📢 No new notifications.");
}

window.onload=function(){
    if(localStorage.getItem("redconnect-theme")==="dark"){
        document.body.classList.add("dark-mode");
    }
}
</script>
