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

.hero-card {
    background: linear-gradient(135deg, #c1121f, #780000);
    color: white;
    border-radius: 24px;
    padding: 30px;
    box-shadow: 0 18px 40px rgba(193,18,31,.20);
}

.hero-card h2 {
    font-size: 28px;
    font-weight: 700;
}

.hero-card p {
    font-size: 15px;
}

.stat-card,
.module-card {
    border: 0;
    border-radius: 22px;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

.stat-card {
    padding: 20px;
}

.stat-card p {
    font-size: 14px;
}

.stat-card h3 {
    font-size: 26px;
}

.stat-icon,
.module-icon {
    background: #fff0f0;
    color: #c1121f;
    display: flex;
    justify-content: center;
    align-items: center;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 15px;
    font-size: 24px;
}

.module-icon {
    width: 55px;
    height: 55px;
    border-radius: 17px;
    font-size: 26px;
}

.module-card {
    transition: .3s;
}

.module-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 40px rgba(0,0,0,.10);
}

.module-card h5 {
    font-size: 18px;
    font-weight: 700;
}

.module-card p {
    font-size: 14px;
    line-height: 1.5;
}

.btn-red {
    background: #c1121f;
    color: white;
    border-radius: 12px;
    padding: 8px 18px;
    font-size: 15px;
    font-weight: 600;
}

.btn-red:hover {
    background: #9b0f19;
    color: white;
}

.section-title {
    font-size: 18px;
    font-weight: 700;
}

/* DARK MODE */
body.dark-mode {
    background: #121212;
    color: #f1f1f1;
}

body.dark-mode .sidebar,
body.dark-mode .topbar,
body.dark-mode .stat-card,
body.dark-mode .module-card {
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

body.dark-mode .hero-card {
    background: linear-gradient(135deg, #8b0000, #4b0000);
}

body.dark-mode .stat-icon,
body.dark-mode .module-icon {
    background: #2d2d2d;
    color: #ff6b6b;
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
</style>

<div class="dashboard-wrapper">

    <aside class="sidebar">
        <div class="logo-box">
            <h4 class="fw-bold mb-1">🩸 RedConnect</h4>
            <small>Blood Donation System</small>
        </div>

        <?= $this->Html->link('🏠 Dashboard', ['controller' => 'Users', 'action' => 'dashboard'], ['class' => 'active']) ?>
        <?= $this->Html->link('👤 Users', ['controller' => 'Users', 'action' => 'index']) ?>
        <?= $this->Html->link('🩸 Donors', ['controller' => 'Donors', 'action' => 'index']) ?>
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
                <h4 class="mb-1">Dashboard Overview</h4>
                <p class="text-muted mb-0">Manage RedConnect system modules from one place.</p>
            </div>

            <div class="d-flex align-items-center gap-2">

                <button class="top-action" onclick="toggleDarkMode()" type="button">
                    🌙 Dark
                </button>

                <button class="top-action" onclick="toggleFull()" type="button">
                    ⛶
                </button>

                <button class="top-action" type="button">
                    🔔
                </button>

                <?php
$currentUser = $this->request->getSession()->read('Auth.User');

$currentRole = 'User';
$currentEmail = '';

if (is_array($currentUser)) {
    $currentRole = $currentUser['role'] ?? 'User';
    $currentEmail = $currentUser['email'] ?? '';
} elseif (is_object($currentUser)) {
    $currentRole = $currentUser->role ?? 'User';
    $currentEmail = $currentUser->email ?? '';
}
?>

<div class="dropdown">
    <button class="profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <?= ucfirst(h($currentRole)) ?>
    </button>

    <ul class="dropdown-menu dropdown-menu-end">
        <li class="dropdown-header">
            <strong><?= ucfirst(h($currentRole)) ?></strong><br>
            <small><?= h($currentEmail) ?></small>
        </li>

        <li><hr class="dropdown-divider"></li>

        <li>
            <?= $this->Html->link(
                'Logout',
                ['controller' => 'Users', 'action' => 'logout'],
                ['class' => 'dropdown-item']
            ) ?>
        </li>
    </ul>
</div>

            </div>
        </div>

        <div class="hero-card mb-4">
            <h2 class="mb-2">Welcome to RedConnect</h2>
            <p class="mb-0 opacity-75">
                A web-based system for managing donors, appointments, donation records, blood types, staff, and certificates.
            </p>
        </div>

        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Blood Groups</p>
                            <h3 class="fw-bold text-danger mb-0"><?= $totalBloodTypes ?? 8 ?></h3>
                        </div>
                        <div class="stat-icon">🅾️</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Staffs</p>
                            <h3 class="fw-bold text-danger mb-0"><?= $totalStaffs ?? 0 ?></h3>
                        </div>
                        <div class="stat-icon">🧑‍⚕️</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Donors</p>
                            <h3 class="fw-bold text-danger mb-0"><?= $totalDonors ?? 0 ?></h3>
                        </div>
                        <div class="stat-icon">🩸</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Donation Records</p>
                            <h3 class="fw-bold text-danger mb-0"><?= $totalHistories ?? 0 ?></h3>
                        </div>
                        <div class="stat-icon">📋</div>
                    </div>
                </div>
            </div>

        </div>

        <h5 class="section-title mb-3">System Modules</h5>

        <div class="row g-4">
            <?php
            $modules = [
                ['👤', 'Users', 'Manage login accounts and roles.', 'Users'],
                ['🩸', 'Donors', 'Manage donor details and blood type.', 'Donors'],
                ['🧑‍⚕️', 'Staffs', 'Manage staff profiles and positions.', 'Staffs'],
                ['🅾️', 'Blood Types', 'Manage blood group categories.', 'BloodTypes'],
                ['📅', 'Appointments', 'Manage appointment bookings.', 'Appointments'],
                ['📋', 'Donation Histories', 'Record completed donations.', 'DonationHistories'],
                ['🏅', 'Certificates', 'Manage donation certificates.', 'Certificates'],
            ];
            ?>

            <?php foreach ($modules as $module): ?>
                <div class="col-md-4">
                    <div class="card module-card h-100">
                        <div class="card-body p-4">
                            <div class="module-icon mb-3"><?= $module[0] ?></div>
                            <h5><?= $module[1] ?></h5>
                            <p class="text-muted"><?= $module[2] ?></p>
                            <?= $this->Html->link('Open Module', ['controller' => $module[3], 'action' => 'index'], ['class' => 'btn btn-red']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Charts Section -->
        <h5 class="section-title mb-3 mt-4">System Analytics</h5>
        <div class="row g-4 mb-4">

            <div class="col-md-6">
                <div class="card stat-card" style="padding: 24px;">
                    <h6 class="fw-bold mb-1" style="font-size:15px;">🩸 Donations by Blood Group</h6>
                    <p class="text-muted mb-3" style="font-size:13px;">Total donations distributed per blood type.</p>
                    <div style="position:relative; height:240px;">
                        <canvas id="bloodGroupBarChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card stat-card" style="padding: 24px;">
                    <h6 class="fw-bold mb-1" style="font-size:15px;">📈 Monthly Donation Trend</h6>
                    <p class="text-muted mb-3" style="font-size:13px;">System-wide donation activity over the last 6 months.</p>
                    <div style="position:relative; height:240px;">
                        <canvas id="monthlyLineChart"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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

// PHP data to JS
const bloodGroupLabels   = <?= json_encode($bloodGroupLabels) ?>;
const bloodGroupData     = <?= json_encode($bloodGroupData) ?>;
const donationMonthLabels = <?= json_encode($donationMonthLabels) ?>;
const donationMonthData   = <?= json_encode($donationMonthData) ?>;

window.onload = function () {
    if (localStorage.getItem("redconnect-theme") === "dark") {
        document.body.classList.add("dark-mode");
    }

    const isDark = document.body.classList.contains("dark-mode");
    const gridColor = isDark ? "rgba(255,255,255,0.08)" : "rgba(0,0,0,0.06)";
    const textColor = isDark ? "#cccccc" : "#555555";

    // Chart 1: Donations by Blood Group — Bar Chart
    const barCtx = document.getElementById("bloodGroupBarChart").getContext("2d");
    new Chart(barCtx, {
        type: "bar",
        data: {
            labels: bloodGroupLabels,
            datasets: [{
                label: "Donations",
                data: bloodGroupData,
                backgroundColor: [
                    "rgba(193,18,31,0.75)",
                    "rgba(120,0,0,0.75)",
                    "rgba(239,68,68,0.75)",
                    "rgba(249,115,22,0.75)",
                    "rgba(234,179,8,0.75)",
                    "rgba(34,197,94,0.75)",
                    "rgba(59,130,246,0.75)",
                    "rgba(139,92,246,0.75)"
                ],
                borderColor: "transparent",
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#c1121f",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.y} donation(s)`
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: textColor, font: { size: 13, weight: "600" } }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: {
                        color: textColor,
                        font: { size: 12 },
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });

    // Chart 2: Monthly Donation Trend — Line Chart
    const lineCtx = document.getElementById("monthlyLineChart").getContext("2d");
    new Chart(lineCtx, {
        type: "line",
        data: {
            labels: donationMonthLabels,
            datasets: [{
                label: "Donations",
                data: donationMonthData,
                fill: true,
                backgroundColor: "rgba(193,18,31,0.08)",
                borderColor: "#c1121f",
                borderWidth: 2.5,
                pointBackgroundColor: "#c1121f",
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#c1121f",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.y} donation(s)`
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: gridColor },
                    ticks: { color: textColor, font: { size: 12 } }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: {
                        color: textColor,
                        font: { size: 12 },
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });
}
</script>