<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.view-card{
    max-width:1100px;
    margin:40px auto;
    background:#fff;
    border-radius:24px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.page-title{
    color:#c1121f;
    font-size:26px;
    font-weight:700;
}

.info-box{
    background:#fff7f7;
    border:1px solid #f1dada;
    border-radius:18px;
    padding:20px;
    height:100%;
}

.info-label{
    color:#777;
    font-size:13px;
    margin-bottom:4px;
}

.info-value{
    font-weight:600;
    font-size:15px;
}

.badge-red{
    background:#c1121f;
    color:white;
    padding:7px 14px;
    border-radius:20px;
    font-weight:600;
}

.btn-red{
    background:#c1121f;
    color:white;
    border:none;
    border-radius:12px;
    padding:10px 20px;
    font-weight:600;
    text-decoration:none;
}

.btn-red:hover{
    background:#9b0f19;
    color:white;
}

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

.table{
    font-size:15px;
    margin-bottom:0;
}

.table thead th{
    background:#c1121f;
    color:white;
    border:none;
    padding:13px;
}

.table tbody td{
    padding:13px;
    vertical-align:middle;
}

.action-link{
    text-decoration:none;
    padding:6px 11px;
    border-radius:9px;
    font-size:14px;
    font-weight:600;
    margin:2px;
    display:inline-block;
}

.view-btn{background:#e8f2ff;color:#0d6efd;}
.edit-btn{background:#fff4d6;color:#856404;}
.delete-btn{background:#ffe4e4;color:#c1121f;}
</style>

<div class="container py-5">

    <div class="view-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="page-title mb-1">🩸 Donor Details</h2>
                <p class="text-muted mb-0">View donor personal, blood type, appointment, and donation information.</p>
            </div>

            <div class="d-flex gap-2">
                <?= $this->Html->link('← Back', ['action'=>'index'], ['class'=>'btn btn-outline-secondary']) ?>
                <?= $this->Html->link('Edit Donor', ['action'=>'edit', $donor->id], ['class'=>'btn-red']) ?>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Full Name</div>
                    <div class="info-value"><?= h($donor->full_name) ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">User Account</div>
                    <div class="info-value">
                        <?= $donor->hasValue('user') ? h($donor->user->email) : '-' ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">Blood Type</div>
                    <div class="info-value">
                        <span class="badge-red">
                            <?= $donor->hasValue('blood_type') ? h($donor->blood_type->blood_group) : '-' ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">IC Number</div>
                    <div class="info-value"><?= h($donor->ic_number) ?></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value"><?= h($donor->phone_number) ?></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">Gender</div>
                    <div class="info-value"><?= h($donor->gender) ?></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">Date of Birth</div>
                    <div class="info-value"><?= h($donor->date_of_birth) ?></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-label">Last Donation</div>
                    <div class="info-value"><?= h($donor->last_donation ?: '-') ?></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="info-box">
                    <div class="info-label">Address</div>
                    <div class="info-value"><?= nl2br(h($donor->address)) ?></div>
                </div>
            </div>

        </div>

        <div class="related-card">
            <h4 class="related-title">📅 Related Appointments</h4>

            <?php if (!empty($donor->appointments)) : ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Health Declaration</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($donor->appointments as $appointment) : ?>
                                <tr>
                                    <td><?= h($appointment->appointment_date) ?></td>
                                    <td><?= h($appointment->appointment_time) ?></td>
                                    <td><?= h($appointment->health_declaration) ?></td>
                                    <td><?= h($appointment->status) ?></td>
                                    <td class="text-center">
                                        <?= $this->Html->link('View', ['controller'=>'Appointments','action'=>'view',$appointment->id], ['class'=>'action-link view-btn']) ?>
                                        <?= $this->Html->link('Edit', ['controller'=>'Appointments','action'=>'edit',$appointment->id], ['class'=>'action-link edit-btn']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted mb-0">No appointment records found.</p>
            <?php endif; ?>
        </div>

        <div class="related-card">
            <h4 class="related-title">📋 Related Donation Histories</h4>

            <?php if (!empty($donor->donation_histories)) : ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Donation Date</th>
                                <th>Staff ID</th>
                                <th>Appointment ID</th>
                                <th>Quantity Pack</th>
                                <th>Remarks</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($donor->donation_histories as $donationHistory) : ?>
                                <tr>
                                    <td><?= h($donationHistory->donation_date) ?></td>
                                    <td><?= h($donationHistory->staff_id) ?></td>
                                    <td><?= h($donationHistory->appointment_id ?: '-') ?></td>
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