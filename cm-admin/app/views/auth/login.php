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
