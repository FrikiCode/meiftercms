<!doctype html>
<html lang="en">
  <?php $this->load->view('elements/head');?>
<body>

<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url();?>">Meifter CMS 1.0</a>
        </div>
    </div>
</nav>

<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="orange" data-image="../../assets/img/full-screen-image-1.jpg">

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <?php echo form_open('auth/login');?>

                            <div class="card">
                                <div class="header text-center">Iniciar Sesion</div>
                                <div class="content">
                                    <div class="form-group">
                                        <?php echo lang('login_identity_label', 'identity');?>
                                        <?php echo form_input($identity);?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo lang('login_password_label', 'password');?>
                                        <?php echo form_input($password);?>
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox">
                                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember" data-toggle="checkbox"');?>
                                            <?php echo lang('login_remember_label', 'remember');?>
                                        </label>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-fill btn-warning btn-wd"');?>
                                </div>
                            </div>

                        <?php echo form_close();?>

                    </div>
                </div>
            </div>
        </div>

      <footer class="footer footer-transparent">
          <div class="container">
              <p class="copyright pull-right">
                  &copy; 2016 <a href="codemeifter.com">CodeMeifter</a>, Soluciones Practicas
              </p>
          </div>
      </footer>

    </div>

</div>

<?php $this->load->view('elements/scripts');?>
