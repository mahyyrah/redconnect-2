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
body{
:#f6f7fb;font-family:'Segoe UI',sans-serif;font-size:15px;
overflow-x:hidden;
}

.dashboard-wrapper{
display:flex;
min-height:100vh;
}

.sidebar{
width:260px;background:#fff;
border-right:1px solid #eee;
padding:28px 20px;
position:fixed;
height:100vh;
}

.logo-box{
background:linear-gradient(135deg,#c1121f,#780000);
color:white;
border-radius:20px;
padding:18px;
margin-bottom:30px;
}

.logo-box h4{
font-size:21px
}

.logo-box small{
font-size:14px
}

.sidebar a{
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

.sidebar a:hover,.sidebar a.active{
background:#fff0f0;
color:#c1121f;
}

.main-content{
margin-left:260px;
padding:32px;
width:calc(100% - 260px);
}

.topbar,.page-card{
background:white;
border-radius:22px;
box-shadow:0 8px 25px rgba(0,0,0,.05);
}

.topbar{
padding:20px 26px;
}

.topbar h4{
font-size:24px;
font-weight:700;
}

.topbar p{
font-size:14px;
}

.page-card{
padding:28px;
margin-bottom:24px;
}

.page-title{
color:#c1121f;
font-size:24px;
font-weight:700;
}

.top-action{
    border-radius:12px;
    background:#f1f3f5;
    border:none;
    padding:9px 14px;
    font-size:14px;
    font-weight:600;
    color:#444;
}

.top-action:hover{
    background:#c1121f;
    color:white;
}

.profile-btn{
    border-radius:12px;
    background:#c1121f;
    color:white;
    border:none;
    padding:9px 18px;
    font-size:14px;
    font-weight:700;
}

.table-responsive{
    border-radius:16px;
    overflow-x:auto;
}

.table{
    font-size:15px;
    margin-bottom:0;
    min-width:1000px;
}

.table thead th{
    background:#c1121f;
    color:white;
    border:none;
    padding:14px;
    font-size:15px;
    font-weight:600;
    white-space:nowrap;
}

.table tbody td{
    padding:14px;
    vertical-align:middle;
}

.cert-badge{
    background:#fff0f0;
    color:#c1121f;
    padding:7px 13px;
    border-radius:20px;
    font-size:14px;
    font-weight:700;
}

.blood-badge{
    background:#c1121f;
    color:#fff;
    padding:7px 13px;
    border-radius:20px;
    font-size:14px;
    font-weight:700;
}

.action-link{
    display:inline-block;
    text-decoration:none;
    padding:7px 12px;
    border-radius:9px;
    font-size:14px;
    font-weight:600;
    margin:2px;
}

.view-btn{
    background:#e8f2ff;
    color:#0d6efd;
}

.view-btn:hover{
    background:#d8eaff;
    color:#0d6efd;
}

.print-btn{
    background:#fff4d6;
    color:#856404;
    border:none;
}

.empty-card{
    text-align:center;
    padding:40px;
    color:#777;
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
    <?= $this->Html->link('📋 Donation History', ['controller'=>'DonorPortal','action'=>'donationHistory']) ?>
    <?= $this->Html->link('🏅 My Certificates', ['controller'=>'DonorPortal','action'=>'certificates'], ['class'=>'active']) ?>

    <hr>

    <?= $this->Html->link('🚪 Logout', ['controller'=>'Users','action'=>'logout']) ?>
</aside>

<main class="main-content">

    <div class="topbar d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h4 class="mb-1">My Certificates</h4>
            <p class="text-muted mb-0">View certificates generated for your completed blood donations.</p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <button class="top-action" onclick="toggleDarkMode()" type="button">🌙 Dark</button>
            <button class="top-action" onclick="toggleFull()" type="button">⛶</button>
            <button class="top-action" type="button">🔔</button>

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
            <h2 class="page-title mb-1">🏅 Certificate List</h2>
            <p class="text-muted mb-0">Certificates issued after successful blood donation.</p>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Certificate Code</th>
                        <th>Donor Name</th>
                        <th>Blood Group</th>
                        <th>Donation Date</th>
                        <th>Issued At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>

                    <?php foreach ($certificates as $certificate): ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td>
                                <span class="cert-badge">
                                    <?= h($certificate->certificate_code) ?>
                                </span>
                            </td>

                            <td class="fw-semibold">
                                <?= h($certificate->donation_history->donor->full_name ?? '-') ?>
                            </td>

                            <td>
                                <span class="blood-badge">
                                    <?= h($certificate->donation_history->donor->blood_type->blood_group ?? '-') ?>
                                </span>
                            </td>

                            <td>
                                <?= h($certificate->donation_history->donation_date ?? '-') ?>
                            </td>

                            <td>
                                <?= h($certificate->issued_at ?? '-') ?>
                            </td>

                            <td class="text-center">
                                <?= $this->Html->link(
                                    'View',
                                    ['controller'=>'DonorPortal','action'=>'viewCertificate',$certificate->id],
                                    ['class'=>'action-link view-btn']
                                ) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($certificates) || $certificates->count() == 0): ?>
                        <tr>
                            <td colspan="7" class="empty-card">
                                No certificate records found.
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
function toggleDarkMode(){document.body.classList.toggle("dark-mode");}
function toggleFull(){
    if(!document.fullscreenElement){document.documentElement.requestFullscreen();}
    else{document.exitFullscreen();}
}
</script>