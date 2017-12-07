<div class="topbar">

  <div class="logo">
    <a href="<?php echo base_url();?>">
        Meifter CMS v2
    </a>
  </div>

  <a class="sidemenu-btn waves-effect waves-light" href="#" title=""><i class="ti-menu"></i></a><!-- Sidemenu Button -->
  <div class="dropdown">
    <a class="dropdown-button" href='#' title="" data-activates='dropdown1'>Soporte <i class="ti-angle-down"></i></a>
    <ul id='dropdown1' class='dropdown-content'>
      <li><a href="#" title="">Estadisticas</a></li>
      <li><a href="#" title="">Configuracion</a></li>
      <li><a href="#" title="">Soporte Tecnico</a></li>
      <li><a href="#" title="">Manual de Usuario</a></li>
      <li><a href="#" title="">Noticias y Novedades</a></li>
    </ul>
  </div>

  <div class="topbar-links">
    <div class="launcher">
      <a class="click-btn" href="#" title=""><i class="ti-widget"></i></a>
      <div class="launcher-dropdown z-depth-2">
        <a class="launch-btn" href="<?=base_url()?>auth/logout">
          <i class="ti-help orange-text"></i>
            Manual
        </a>
        <a class="launch-btn" href="<?php echo base_url();?>Crud/SiteConfView">
            <i class="ti-settings cyan-text"></i>
            Configuracion
        </a>
        <a class="launch-btn" href="<?=base_url()?>auth/logout">
            <i class="ti-lock purple-text"></i>
            Cerrar Sesion
        </a>
      </div>
    </div><!-- Launcher -->
  </div><!-- Topbar Links -->
</div><!-- Top Bar -->
