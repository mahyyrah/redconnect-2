<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Certificate $certificate
 */
?>

<style>
@page {
    size: A4 landscape;
    margin: 0;
}

html, body {
    margin: 0;
    padding: 0;
    background: #ececec;
    font-family: Georgia, serif;
}

.actions {
    text-align: center;
    margin: 18px 0;
}

.btn-cert {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 42px;
    padding: 0 22px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    margin: 0 5px;
}

.btn-back {
    background: #f1f3f5;
    color: #333;
}

.btn-print {
    background: #c1121f;
    color: #fff;
}

.certificate-wrap {
    width: 297mm;
    height: 210mm;
    margin: 0 auto 25px;
    background: white;
    box-sizing: border-box;
    padding: 12mm;
}

.certificate {
    width: 100%;
    height: 100%;
    border: 10px solid #c1121f;
    box-sizing: border-box;
    text-align: center;
    position: relative;
    overflow: hidden;
    padding: 22mm 25mm;
}

.inner-border {
    position: absolute;
    inset: 8mm;
    border: 2px solid #e6b8b8;
    pointer-events: none;
}

.watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 190px;
    opacity: 0.045;
}

.system-name {
    color: #c1121f;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 4px;
}

.title {
    margin-top: 12px;
    font-size: 34px;
    font-weight: 800;
    color: #780000;
    letter-spacing: 2px;
}

.presented {
    margin-top: 18px;
    font-size: 16px;
    color: #555;
}

.donor-name {
    margin: 14px auto 18px;
    font-size: 32px;
    font-weight: 800;
    color: #111;
    border-bottom: 3px solid #c1121f;
    display: inline-block;
    padding: 0 35px 7px;
}

.cert-text {
    font-size: 15px;
    line-height: 1.65;
    color: #444;
    max-width: 790px;
    margin: 0 auto;
}

.info-row {
    display: flex;
    justify-content: center;
    gap: 50px;
    margin-top: 26px;
}

.info-box small {
    display: block;
    color: #777;
    margin-bottom: 4px;
    font-size: 11px;
}

.info-box strong {
    color: #c1121f;
    font-size: 15px;
}

.signature-row {
    display: flex;
    justify-content: space-between;
    margin-top: 38px;
}

.signature {
    width: 240px;
    text-align: center;
}

.signature-name {
    font-family: "Brush Script MT", "Segoe Script", cursive;
    font-size: 28px;
    color: #111;
    margin-bottom: 0;
}

.signature hr {
    margin: 3px 0 7px;
    border: 1px solid #111;
}

.signature strong {
    font-size: 12px;
}

.footer {
    position: absolute;
    bottom: 10mm;
    left: 0;
    width: 100%;
    text-align: center;
    font-size: 11px;
    color: #777;
}

@media print {
    body * {
        visibility: hidden !important;
    }

    .certificate-wrap,
    .certificate-wrap * {
        visibility: visible !important;
    }

    .actions {
        display: none !important;
    }

    html, body {
        width: 297mm;
        height: 210mm;
        background: white !important;
        overflow: hidden;
    }

    .certificate-wrap {
        position: fixed;
        left: 0;
        top: 0;
        width: 297mm;
        height: 210mm;
        margin: 0;
        padding: 8mm;
        box-shadow: none;
    }

    .certificate {
        width: 100%;
        height: 100%;
    }
}
</style>

<div class="actions">
    <?= $this->Html->link('← Back', ['action' => 'index'], ['class' => 'btn-cert btn-back']) ?>

    <button onclick="window.print()" class="btn-cert btn-print">
        🖨 Print Certificate
    </button>
</div>

<div class="certificate-wrap">
    <div class="certificate">

        <div class="inner-border"></div>
        <div class="watermark">🩸</div>

        <div class="system-name">REDCONNECT BLOOD DONATION SYSTEM</div>

        <div class="title">CERTIFICATE OF APPRECIATION</div>

        <p class="presented">This certificate is proudly presented to</p>

        <div class="donor-name">
            <?= h($certificate->donation_history->donor->full_name ?? '-') ?>
        </div>

        <p class="cert-text">
            In recognition of your generous contribution and successful blood donation.
            Your kindness and willingness to donate blood have helped save lives and support
            patients in need. Thank you for making a meaningful difference in the community.
        </p>

        <div class="info-row">
            <div class="info-box">
                <small>Blood Group</small>
                <strong><?= h($certificate->donation_history->donor->blood_type->blood_group ?? '-') ?></strong>
            </div>

            <div class="info-box">
                <small>Donation Date</small>
                <strong><?= h($certificate->donation_history->donation_date ?? '-') ?></strong>
            </div>

            <div class="info-box">
                <small>Certificate Code</small>
                <strong><?= h($certificate->certificate_code) ?></strong>
            </div>
        </div>

        <div class="signature-row">
            <div class="signature">
                <div class="signature-name">Dr. Amelia</div>
                <hr>
                <strong>Blood Bank Officer</strong>
            </div>

            <div class="signature">
                <div class="signature-name">RedConnect</div>
                <hr>
                <strong>System Administrator</strong>
            </div>
        </div>

        <div class="footer">
            Issued on <?= h($certificate->issued_at) ?> |
            Certificate Code: <?= h($certificate->certificate_code) ?>
        </div>

    </div>
</div>