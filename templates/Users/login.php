<style>
body{
    background:linear-gradient(135deg,#fff5f5,#ffe3e3);
    min-height:100vh;
    font-family:'Segoe UI',sans-serif;
}

.login-wrapper{
    min-height:100vh;
}

.login-card{
    max-width:950px;
    border-radius:28px;
    overflow:hidden;
}

.login-left{
    background:linear-gradient(135deg,#c1121f,#780000);
    color:#fff;
    padding:60px 45px;
    position:relative;
}

.login-left::before{
    content:"";
    position:absolute;
    right:-40px;
    bottom:-40px;
    width:220px;
    height:220px;
    background:rgba(255,255,255,.08);
    border-radius:50%;
}

.login-left::after{
    content:"";
    position:absolute;
    left:-70px;
    top:-70px;
    width:180px;
    height:180px;
    background:rgba(255,255,255,.06);
    border-radius:50%;
}

.blood-icon{
    font-size:70px;
    position:relative;
    z-index:2;
}

.login-left h1,
.login-left p{
    position:relative;
    z-index:2;
}

.login-right{
    background:#fff;
    padding:55px 45px;
}

.form-control{
    border-radius:14px;
    padding:12px 15px;
    font-size:15px;
}

.form-control:focus{
    border-color:#c1121f;
    box-shadow:0 0 0 .2rem rgba(193,18,31,.15);
}

.btn-login{
    border:none;
    border-radius:14px;
    padding:12px;
    background:#c1121f;
    font-weight:600;
}

.btn-login:hover{
    background:#9b0f19;
}

.signup-box{
    margin-top:30px;
    padding-top:25px;
    border-top:1px solid #ececec;
}

.signup-btn{
    border-radius:14px;
    padding:12px;
    font-weight:600;
}

.signup-btn:hover{
    background:#c1121f;
    color:#fff;
}

@media(max-width:768px){
    .login-left{
        padding:45px 35px;
    }

    .login-right{
        padding:40px 30px;
    }
}
</style>

<div class="container login-wrapper d-flex justify-content-center align-items-center">

<div class="card login-card shadow-lg border-0 w-100">

<div class="row g-0">

<div class="col-md-5 login-left d-flex flex-column justify-content-center">

<div class="blood-icon mb-4">
🩸
</div>

<h1 class="fw-bold mb-3">
RedConnect
</h1>

<p class="fs-5 mb-3">
Blood Donation Appointment & Donor Management System
</p>

<p class="opacity-75">
Connecting donors with lifesaving opportunities.
</p>

</div>

<div class="col-md-7 login-right">

<h3 class="fw-bold text-danger mb-2">
Login
</h3>

<p class="text-muted mb-4">
Please sign in to continue.
</p>

<?= $this->Flash->render() ?>

<?= $this->Form->create(null) ?>

<div class="mb-3">

<?= $this->Form->control('email',[
'type'=>'email',
'label'=>'Email Address',
'class'=>'form-control',
'placeholder'=>'Enter your email',
'required'=>true
]) ?>

</div>

<div class="mb-4">

<?= $this->Form->control('password',[
'type'=>'password',
'label'=>'Password',
'class'=>'form-control',
'placeholder'=>'Enter your password',
'required'=>true
]) ?>

</div>

<?= $this->Form->button(
'Login',
[
'class'=>'btn btn-danger btn-login w-100 text-white'
]
) ?>

<?= $this->Form->end() ?>

<div class="signup-box text-center">

<p class="mb-3 text-muted">
Don't have a donor account yet?
</p>

<?= $this->Html->link(
'🩸 Register as Donor',
['controller'=>'Users','action'=>'signup'],
[
'class'=>'btn btn-outline-danger signup-btn w-100'
]
) ?>

</div>

</div>

</div>

</div>

</div>