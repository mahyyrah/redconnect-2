<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.view-card{
    max-width:1000px;
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

.blood-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background:#c1121f;
    color:#fff;
    padding:5px 12px;
    min-height:34px;
    border-radius:999px;
    font-size:14px;
    font-weight:700;
    line-height:1;
    width:auto;
}

.btn-red,
.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:12px;
    padding:10px 20px;
    min-height:44px;
    font-size:14px;
    font-weight:600;
}

.btn-red{
    background:#c1121f;
    color:white;
    border:none;
    text-decoration:none;
}

.btn-red:hover{
    background:#9b0f19;
    color:white;
}

.action-link{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    padding:8px 14px;
    min-height:40px;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    margin:2px;
}

.view-btn{background:#e8f2ff;color:#0d6efd;}
.edit-btn{background:#fff4d6;color:#856404;}
</style>

<div class="container py-5">

    <div class="view-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="page-title mb-1">🅾️ Blood Type Details</h2>
                <p class="text-muted mb-0">View blood group information and related donors.</p>
            </div>

            <div class="d-flex gap-2">
                <?= $this->Html->link('← Back', ['action'=>'index'], ['class'=>'btn btn-outline-secondary btn-back']) ?>
                <?= $this->Html->link('Edit Blood Type', ['action'=>'edit', $bloodType->id], ['class'=>'btn-red']) ?>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Blood Type ID</div>
                    <div class="info-value"><?= $this->Number->format($bloodType->id) ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Blood Group</div>
                    <div class="info-value">
                        <span class="blood-badge"><?= h($bloodType->blood_group) ?></span>
                    </div>
                </div>
            </div>

        </div>

        <div class="related-card">
            <h4 class="related-title">🩸 Related Donors</h4>

            <?php if (!empty($bloodType->donors)) : ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>IC Number</th>
                                <th>Phone Number</th>
                                <th>Gender</th>
                                <th>Last Donation</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($bloodType->donors as $donor) : ?>
                                <tr>
                                    <td class="fw-semibold"><?= h($donor->full_name) ?></td>
                                    <td><?= h($donor->ic_number) ?></td>
                                    <td><?= h($donor->phone_number) ?></td>
                                    <td><?= h($donor->gender) ?></td>
                                    <td><?= h($donor->last_donation ?: '-') ?></td>
                                    <td class="text-center">
                                        <?= $this->Html->link('View', ['controller'=>'Donors','action'=>'view',$donor->id], ['class'=>'action-link view-btn']) ?>
                                        <?= $this->Html->link('Edit', ['controller'=>'Donors','action'=>'edit',$donor->id], ['class'=>'action-link edit-btn']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted mb-0">No donors found for this blood type.</p>
            <?php endif; ?>
        </div>

    </div>

</div>