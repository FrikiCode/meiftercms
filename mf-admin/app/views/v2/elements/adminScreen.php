<div class="admin">
  <img src="<?php echo getUserNfo(getMyID())['image'];?>" alt="" />
  <div class="admin-detail">
    <h2><?php echo getUserNfo(getMyID())['first_name'];?> <?php echo getUserNfo(getMyID())['last_name'];?></h2>
    <a class="dropdown-button" href='#' title="" data-activates='dropdown2'><span class="green"></span> Online <i class="ti-angle-down"></i></a>
    <ul id='dropdown2' class='dropdown-content'>
      <li><a href="<?php echo base_url();?>user">Mi Perfil</a></li>
      <li><a href="#">Configurar Cuenta</a></li>
      <li><a href="<?=base_url()?>auth/logout">Cerrar Sesion</a></li>
    </ul>
  </div>
</div>
