<div class="sidemenu">
  <div class="sidemenu-inner scroll">
    <?php $this->load->view('v2/elements/adminScreen');?>
    <nav class="admin-nav">
      <h6>Tools Principales</h6>
      <ul>
        <li>
          <a class="waves-effect" href="<?php echo base_url();?>" title=""><i class="ti-home red lighten-1"></i> Dashboard</a>
        </li>
        <li><a class="waves-effect" href="#" title=""><i class="ti-layout-tab orange lighten-1"></i> Sitio</a>
          <ul>
            <li><a href="<?php echo base_url();?>crud/Internal" title="">Secciones</a></li>
            <li><a href="<?php echo base_url();?>crud/AboutView" title="">Nosotros</a></li>
            <li><a href="<?php echo base_url();?>crud/TestimonialView" title="">Testimoniales</a></li>
            <li><a href="<?php echo base_url();?>crud/FrequentQuestions" title="">F.A.Q.</a></li>
            <li><a href="<?php echo base_url();?>crud/UserListView" title="">Usuarios</a></li>
            <li><a href="<?php echo base_url();?>crud/MailConfView" title="">Configuracion de E-Mail</a></li>
            <li><a href="<?php echo base_url();?>crud/InfoContactConf" title="">Contacto</a></li>
          </ul>
        </li>
        <li><a class="waves-effect" href="#" title=""><i class="ti-shopping-cart blue lighten-1"></i> Catalogo</a>
          <ul>
            <li><a href="<?php echo base_url();?>crud/Product" title="">Productos</a></li>
            <li><a href="<?php echo base_url();?>crud/ProdCat" title="">Categorias</a></li>
            <li><a href="<?php echo base_url();?>crud/combosview" title="">Combos</a></li>
            <li><a href="<?php echo base_url();?>crud/Tax" title="">Impuestos</a></li>
            <li><a href="<?php echo base_url();?>crud/SegmentView" title="">Segmentos</a></li>
            <li><a href="<?php echo base_url();?>crud/BrandView" title="">Marcas</a></li>
            <li><a href="<?php echo base_url();?>crud/currencyview" title="">Divisas</a></li>
            <li><a href="<?php echo base_url();?>crud/methodpayview" title="">Metodos de Pago</a></li>
            <li><a href="<?php echo base_url();?>crud/StoreConfView" title="">Configuracion de la Tienda</a></li>
            <li><a href="<?php echo base_url();?>crud/PromoCodeView" title="">Codigos Promocionales</a></li>
            <li><a href="<?php echo base_url();?>crud/SaleRegistryView" title="">Registros de Ventas</a></li>
            <li><a href="<?php echo base_url();?>crud/ShippingView" title="">Costos de Envio</a></li>
          </ul>
        </li>
        <li><a class="waves-effect" href="#" title=""><i class="ti-book black lighten-1"></i> Blog</a>
          <ul>
            <li><a href="<?php echo base_url();?>crud/PostView" title="">Articulos</a></li>
            <li><a href="<?php echo base_url();?>crud/PostCatView" title="">Categoria de Articulos</a></li>
          </ul>
        </li>
      </ul>
      <h6>Tools de Soporte</h6>
      <ul>
        <li><a class="waves-effect" href="#" title=""><i class="ti-pie-chart green lighten-1"></i> Estadisticas</a></li>
        <li><a class="waves-effect" href="<?php echo base_url();?>Crud/SiteConfView" title=""><i class="ti-panel purple lighten-1"></i> Configuracion</a></li>
        <li><a class="waves-effect" href="#" title=""><i class="ti-support pink lighten-2"></i> Soporte Tecnico</a></li>
        <li><a class="waves-effect" href="#" title=""><i class="ti-help orange lighten-1"></i> Manual de Usuario</a></li>
        <li><a class="waves-effect" href="#" title=""><i class="ti-rss-alt yellow lighten-1"></i> Noticias y Novedades</a></li>
      </ul>
      <h6 class="copyright">
        Meifter CMS v2.
        <br>
        <small>Desarrollado por <a class="purple-text" href="https://friki-code.com" target="_blank">FrikiCode</a></small>
        <br><br>
        <small>&copy; <?php echo date('Y');?> Todos los Derechos Reservados</small>
      </h6>
    </nav>
  </div>
</div>
