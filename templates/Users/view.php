<style>
body{
    background:#f6f7fb;
    font-family:'Segoe UI',sans-serif;
}

.view-card{
    max-width:850px;
    margin:40px auto;
    background:#fff;
    border-radius:24px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.user-avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#c1121f;
    color:#fff;
    font-size:38px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
}

.page-title{
    color:#c1121f;
    font-weight:700;
}

.info-table{
    margin-top:30px;
}

.info-table th{
    width:180px;
    background:#fff7f7;
    color:#c1121f;
    padding:14px;
}

.info-table td{
    padding:14px;
}

.role-badge{
    background:#fff0f0;
    color:#c1121f;
    padding:6px 12px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
    border:1px solid #f3c6c6;
}

.btn-red{
    background:#c1121f;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 20px;
    font-weight:600;
}

.btn-red:hover{
    background:#9b0f19;
    color:#fff;
}
</style>

<div class="view-card">

    <div class="text-center">

        <div class="user-avatar">
            👤
        </div>

        <h2 class="page-title mt-3">
            User Details
        </h2>

        <p class="text-muted">
            View user account information.
        </p>

    </div>

    <table class="table table-bordered info-table">

        <tr>
            <th>User ID</th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>

        <tr>
            <th>Email Address</th>
            <td><?= h($user->email) ?></td>
        </tr>

        <tr>
            <th>User Role</th>
            <td>
                <span class="role-badge">
                    <?= ucfirst(h($user->role)) ?>
                </span>
            </td>
        </tr>

        <tr>
            <th>Created At</th>
            <td><?= h($user->created_at) ?></td>
        </tr>

    </table>

    <div class="d-flex justify-content-end gap-2 mt-4">

        <?= $this->Html->link(
            '← Back',
            ['action'=>'index'],
            ['class'=>'btn btn-outline-secondary']
        ) ?>

        <?= $this->Html->link(
            'Edit User',
            ['action'=>'edit',$user->id],
            ['class'=>'btn btn-warning']
        ) ?>

        <?= $this->Form->postLink(
            'Delete',
            ['action'=>'delete',$user->id],
            [
                'confirm'=>'Are you sure you want to delete this user?',
                'class'=>'btn btn-danger'
            ]
        ) ?>

    </div>

</div>