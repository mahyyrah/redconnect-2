<?php
$history = $certificate->donation_history;
$donor = $history->donor;
$staff = $history->staff;
?>

<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.certificate{
    max-width:1000px;
    margin:40px auto;
    background:#fff;
    border-radius:25px;
    box-shadow:0 10px 35px rgba(0,0,0,.08);
    overflow:hidden;
}

.header{
    background:linear-gradient(135deg,#c1121f,#780000);
    color:#fff;
    text-align:center;
    padding:40px;
}

.header h1{
    margin:0;
    font-size:38px;
    font-weight:700;
}

.header h4{
    margin-top:10px;
    opacity:.9;
}

.content{
    padding:45px;
}

.title{
    text-align:center;
    font-size:34px;
    font-weight:700;
    color:#c1121f;
    margin-bottom:10px;
}

.subtitle{
    text-align:center;
    color:#666;
    margin-bottom:40px;
}

table{
    width:100%;
    border-collapse:collapse;
}

td{
    padding:14px;
    border-bottom:1px solid #eee;
}

td:first-child{
    width:250px;
    font-weight:600;
    color:#444;
}

.footer{
    text-align:center;
    padding:35px;
}

.btn-red{
    background:#c1121f;
    color:#fff;
    border-radius:12px;
    padding:10px 22px;
    text-decoration:none;
    margin:5px;
    display:inline-block;
}

.btn-red:hover{
    background:#9b0f19;
    color:#fff;
}

.btn-outline{
    border:2px solid #c1121f;
    color:#c1121f;
    border-radius:12px;
    padding:10px 22px;
    text-decoration:none;
    display:inline-block;
}

.btn-outline:hover{
    background:#c1121f;
    color:#fff;
}

@media print{
    .footer{
        display:none;
    }
}
</style>

<div class="certificate">

    <div class="header">
        <h1>🩸 RedConnect</h1>
        <h4>Blood Donation Certificate</h4>
    </div>

    <div class="content">

        <div class="title">
            Certificate of Appreciation
        </div>

        <div class="subtitle">
            This certificate is proudly presented to
        </div>

        <h2 style="text-align:center;font-size:38px;color:#780000;margin-bottom:45px;">
            <?= h($donor->full_name) ?>
        </h2>

        <table>

            <tr>
                <td>Certificate Code</td>
                <td><?= h($certificate->certificate_code) ?></td>
            </tr>

            <tr>
                <td>Blood Group</td>
                <td><?= h($donor->blood_type->blood_group) ?></td>
            </tr>

            <tr>
                <td>Donation Date</td>
                <td><?= h($history->donation_date) ?></td>
            </tr>

            <tr>
                <td>Quantity Donated</td>
                <td><?= h($history->quantity_pack) ?> Pack</td>
            </tr>

            <tr>
                <td>Handled By</td>
                <td><?= h($staff->full_name) ?></td>
            </tr>

            <tr>
                <td>Issued At</td>
                <td><?= h($certificate->issued_at) ?></td>
            </tr>

            <tr>
                <td>Remarks</td>
                <td><?= h($history->remarks ?: '-') ?></td>
            </tr>

        </table>

    </div>

    <div class="footer">

        <a href="javascript:window.print();" class="btn-red">
            🖨 Print Certificate
        </a>

        <?= $this->Html->link(
            '← Back',
            ['controller'=>'DonorPortal','action'=>'certificates'],
            ['class'=>'btn-outline']
        ) ?>

    </div>

</div>