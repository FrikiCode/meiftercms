<!doctype html>
<html lang="en">
	<?php $this->load->view('v2/elements/head');?>
<body>

<div class="loader-container circle-pulse-multiple">
  <div class="page-loader">
    <div id="loading-center-absolute">
      <div class="object" id="object_four"></div>
      <div class="object" id="object_three"></div>
      <div class="object" id="object_two"></div>
      <div class="object" id="object_one"></div>
    </div>
  </div>
</div>

<div class="login-page">
  <div class="login-form-box z-depth-1">
    <h1>Meifter CMS v2</h1>
    <h3>Inicia Sesion</h3>
    <?php echo form_open('auth/login');?>
      <div class="input-field">
        <?php echo form_input($identity);?>
        <?php echo lang('login_identity_label', 'identity');?>
      </div>
      <div class="input-field">
        <?php echo form_input($password);?>
        <?php echo lang('login_password_label', 'password');?>
      </div>
      <div class="input-field">
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
        <?php echo lang('login_remember_label', 'remember');?>
      </div>
      <span></span>
      <br>
      <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn waves-effect waves-light red"');?>
    <?php echo form_close();?>
  </div>
</div>

<?php $this->load->view('v2/elements/scripts');?>

<style>
  body {
    background-image: url(../assets/img/loginbg.jpg);
    background-size: 100%;
    background-position: center center;
  }
</style>
