<style>
body{background:#f6f7fb;font-family:'Segoe UI',sans-serif;}

.view-card{
    max-width:1000px;
    margin:40px auto;
    background:#fff;
    border-radius:24px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.page-title{color:#c1121f;font-size:26px;font-weight:700;}

.info-box{
    background:#fff7f7;
    border:1px solid #f1dada;
    border-radius:18px;
    padding:20px;
    height:100%;
}

.info-label{color:#777;font-size:13px;margin-bottom:4px;}
.info-value{font-weight:600;font-size:15px;}

.status-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:6px 14px;
    border-radius:999px;
    font-size:14px;
    font-weight:700;
    text-transform:capitalize;
}

.status-pending{background:#fff4d6;color:#856404;}
.status-approved{background:#d1e7dd;color:#0f5132;}
.status-declined{background:#ffe4e4;color:#c1121f;}
.status-completed{background:#e8f2ff;color:#0d6efd;}

.btn-red,.btn-back{
    display:inline-flex!important;
    align-items:center!important;
    justify-content:center!important;
    height:44px!important;
    min-width:150px!important;
    padding:0 22px!important;
    border-radius:12px!important;
    font-size:14px!important;
    font-weight:600!important;
    text-decoration:none!important;
}

.btn-red{
    background:#c1121f!important;
    color:#fff!important;
    border:none!important;
}

.btn-red:hover{background:#9b0f19!important;color:#fff!important;}

.related-card{
    margin-top:30px;
    background:white;
    border:1px solid #eee;
    border-radius:20px;
    padding:24px;
}

.related-title{
    color:#c1121f;
    font-size:20px;
    font-weight:700;
    margin-bottom:18px;
}

.table{font-size:15px;margin-bottom:0;}
.table thead th{background:#c1121f;color:white;border:none;padding:13px;}
.table tbody td{padding:13px;vertical-align:middle;}

.action-link{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-height:38px;
    padding:7px 13px;
    border-radius:9px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
    margin:2px;
}

.view-btn{background:#e8f2ff;color:#0d6efd;}
.edit-btn{background:#fff4d6;color:#856404;}
</style>

<?php
$status = strtolower((string)$appointment->status);
$statusClass = 'status-pending';

if ($status === 'approved') {
    $statusClass = 'status-approved';
} elseif ($status === 'declined') {
    $statusClass = 'status-declined';
} elseif ($status === 'completed') {
    $statusClass = 'status-completed';
}
?>

<div class="container py-5">

    <div class="view-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="page-title mb-1">📅 Appointment Details</h2>
                <p class="text-muted mb-0">View appointment booking and health declaration information.</p>
            </div>

            <div class="d-flex gap-2">
                <?= $this->Html->link('← Back', ['action'=>'index'], ['class'=>'btn btn-outline-secondary btn-back']) ?>
                <?= $this->Html->link('Edit Appointment', ['action'=>'edit', $appointment->id], ['class'=>'btn-red']) ?>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Donor</div>
                    <div class="info-value">
                        <?= $appointment->hasValue('donor') ? h($appointment->donor->full_name) : '-' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="status-badge <?= $statusClass ?>">
                            <?= h($appointment->status) ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">Appointment ID</div>
                    <div class="info-value"><?= $this->Number->format($appointment->id) ?></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">Appointment Date</div>
                    <div class="info-value"><?= h($appointment->appointment_date) ?></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">Appointment Time</div>
                    <div class="info-value"><?= h($appointment->appointment_time) ?></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="info-box">
                    <div class="info-label">Health Declaration</div>
                    <div class="info-value"><?= nl2br(h($appointment->health_declaration)) ?></div>
                </div>
            </div>

        </div>

        <div class="related-card">
            <h4 class="related-title">📋 Related Donation Histories</h4>

            <?php if (!empty($appointment->donation_histories)) : ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Donation Date</th>
                                <th>Donor ID</th>
                                <th>Staff ID</th>
                                <th>Quantity Pack</th>
                                <th>Remarks</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($appointment->donation_histories as $donationHistory) : ?>
                                <tr>
                                    <td><?= h($donationHistory->donation_date) ?></td>
                                    <td><?= h($donationHistory->donor_id) ?></td>
                                    <td><?= h($donationHistory->staff_id) ?></td>
                                    <td><?= h($donationHistory->quantity_pack) ?></td>
                                    <td><?= h($donationHistory->remarks ?: '-') ?></td>
                                    <td class="text-center">
                                        <?= $this->Html->link('View', ['controller'=>'DonationHistories','action'=>'view',$donationHistory->id], ['class'=>'action-link view-btn']) ?>
                                        <?= $this->Html->link('Edit', ['controller'=>'DonationHistories','action'=>'edit',$donationHistory->id], ['class'=>'action-link edit-btn']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted mb-0">No donation history records found.</p>
            <?php endif; ?>
        </div>

    </div>

</div>