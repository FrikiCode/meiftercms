<div class="nav-container">
  <nav class="nav-centered">
    <div class="nav-utility">
      <div class="module left">
        <i class="ti-location-pin">&nbsp;</i>
        <span class="sub"><?php echo $fullAdress;?></span>
      </div>
      <div class="module left">
        <i class="ti-email">&nbsp;</i>
        <span class="sub"><?php echo $emailContact;?></span>
      </div>
      <div class="module left">
        <i class="ti-mobile">&nbsp;</i>
        <span class="sub"><?php echo $phoneContact;?></span>
      </div>
      <?php if ($this->ion_auth->logged_in()): ?>
        <div class="module right">
          <ul class="menu">
            <li><a href="<?php echo base_url();?>user/profile">Mi Perfil</a></li>
            <li><a href="<?php echo base_url();?>user/security">Seguridad</a></li>
            <li><a href="<?php echo base_url();?>user/buys">Mis Compras</a></li>
            <li><a href="<?php echo base_url();?>logout">Salir</a></li>
        </ul>
        </div>
      <?php else: ?>
        <div class="module right">
          <a class="btn btn-sm" href="<?php echo base_url();?>login">Login</a>
          <a class="btn btn-sm" href="<?php echo base_url();?>register">Crear Cuenta</a>
        </div>
      <?php endif ?>
    </div>
    <div class="text-center">
      <a href="<?php echo base_url();?>">
          <img class="logo logo-light" alt="Foundry" src="<?php echo base_url();?>assets/img/logo-light.png">
          <div class="vnu"><img class="logo logo-dark" alt="Foundry" src="<?php echo base_url();?>assets/img/logo-dark.png"></div>
      </a>
    </div>
    <div class="nav-bar text-center">
      <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
        <i class="ti-menu"></i>
      </div>
      <div class="module-group text-left">
        <div class="module left">
          <?php $this->load->view('modules/menu');?>
        </div>
      </div>
    </div>
  </nav>
</div>
