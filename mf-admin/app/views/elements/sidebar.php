<div class="sidebar-wrapper">
            
    <div class="user">
        <div class="photo">
            <img src="<?php echo getUserNfo(getMyID())['image'];?>" />
        </div>  
        <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                <?php echo getUserNfo(getMyID())['first_name'];?> <?php echo getUserNfo(getMyID())['last_name'];?>
                <b class="caret"></b>
            </a>                
            <div class="collapse" id="collapseExample">
                <ul class="nav">
                    <li><a href="<?php echo base_url();?>user">Mi Perfil</a></li>
                    <li><a href="#">Configurar Cuenta</a></li>
                    <li><a href="<?=base_url()?>auth/logout">Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>
    </div>
                          
    <ul class="nav">
        
        <!-- <li>                   
            <a href="<?php echo base_url();?>Crud/Internal">
                <i class="pe-7s-network"></i> 
                <p>Paginas Internas</p>
            </a>                
        </li> -->

        <li>                   
            <a href="<?php echo base_url();?>Crud/AboutView">
                <i class="pe-7s-network"></i> 
                <p>Quienes Somos</p>
            </a>                
        </li>

        <!-- <li>                   
            <a data-toggle="collapse" href="#media" class="collapsed" aria-expanded="true">                        
                <i class="pe-7s-photo"></i> 
                <p>Multimedia
                   <b class="caret"></b>
                </p>
            </a>                
            <div class="collapse" id="media" aria-expanded="true">
                <ul class="nav">
                    <li>
                        <a href="<?php echo base_url();?>Crud/Media">Imagenes</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/Gallerie">Galerias Imagenes</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/Video">Videos</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/GallerieVideo">Galerias Videos</a>
                    </li>
                </ul>
            </div>
        </li> -->

        <li>                   
            <a data-toggle="collapse" href="#products" class="collapsed" aria-expanded="true">                        
                <i class="pe-7s-portfolio"></i> 
                <p>Catalogo
                   <b class="caret"></b>
                </p>
            </a>                
            <div class="collapse" id="products" aria-expanded="true">
                <ul class="nav">
                    <!-- <li>
                        <a href="<?php echo base_url();?>Crud/StoreConfView">Configurar Tienda</a>
                    </li> -->
                    <li>
                        <a href="<?php echo base_url();?>Crud/ProdCat">Categorias</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/Product">Productos</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/combosview">Combos</a>
                    </li>
                    <!-- <li>
                        <a href="<?php echo base_url();?>Crud/BrandView">Marcas</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/SegmentView">Segmentos</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/Tax">Impuesto</a>
                    </li> -->
                    <!-- <li>
                        <a href="<?php echo base_url();?>Crud/PromoCodeView">Codigos Promocionales</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/PayUView">Configuracion de PayU</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/currencyview">Divisas</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/methodpayview">Metodos de Pago</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/SaleRegistryView">Registro de Compras</a>
                    </li> -->
                </ul>
            </div>
        </li>
        
        <!-- <li>                   
            <a data-toggle="collapse" href="#shipping" class="collapsed" aria-expanded="true">                        
                <i class="pe-7s-portfolio"></i> 
                <p>Shipping
                   <b class="caret"></b>
                </p>
            </a>                
            <div class="collapse" id="shipping" aria-expanded="true">
                <ul class="nav">
                    <li>
                        <a href="<?php echo base_url();?>Crud/ShippingView">Costas de Envio</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/PaisView">Shipping: Paises</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/ProvinciaView">Shipping: Provincias</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/PartidosView">Shipping: Partidos</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/LocalidadView">Shipping: Localidades</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/BarriosView">Shipping: Barrios</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/SubBarriosView">Shipping: Sub Barrios</a>
                    </li>
                </ul>
            </div>
        </li> -->
        
        <!-- <li>                   
            <a data-toggle="collapse" href="#blog" class="collapsed" aria-expanded="true">                        
                <i class="pe-7s-news-paper"></i> 
                <p>Industrias
                   <b class="caret"></b>
                </p>
            </a>                
            <div class="collapse" id="blog" aria-expanded="true">
                <ul class="nav">
                    <li>
                        <a href="<?php echo base_url();?>Crud/IndCatView">Categorias</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/IndSubCatView">Sub Categorias</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/IndView">Industria</a>
                    </li>
                </ul>
            </div>
        </li> -->

        <!-- <li>                   
            <a data-toggle="collapse" href="#cand" class="collapsed" aria-expanded="true">                        
                <i class="pe-7s-news-paper"></i> 
                <p>Candidatos
                   <b class="caret"></b>
                </p>
            </a>                
            <div class="collapse" id="cand" aria-expanded="true">
                <ul class="nav">
                    <li>
                        <a href="<?php echo base_url();?>Crud/CandCatView">Categorias</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/CandView">Candidatos</a>
                    </li>
                </ul>
            </div>
        </li> -->

        <!-- <li>                   
            <a data-toggle="collapse" href="#blog" class="collapsed" aria-expanded="true">                        
                <i class="pe-7s-news-paper"></i> 
                <p>Blog
                   <b class="caret"></b>
                </p>
            </a>                
            <div class="collapse" id="blog" aria-expanded="true">
                <ul class="nav">
                    <li>
                        <a href="<?php echo base_url();?>Crud/PostCatView">Categorias</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>Crud/PostView">Posts</a>
                    </li>
                </ul>
            </div>
        </li> -->

        <!-- <li>                   
            <a href="<?php echo base_url();?>Crud/FrequentQuestions">
                <i class="pe-7s-users"></i> 
                <p>Faq</p>
            </a>                
        </li> -->

        <li>                   
            <a href="<?php echo base_url();?>Crud/testimonialView">
                <i class="pe-7s-users"></i> 
                <p>Testimoniales</p>
            </a>                
        </li>

         <li>                   
            <a href="<?php echo base_url();?>Crud/UserListView">
                <i class="pe-7s-users"></i> 
                <p>Usuarios</p>
            </a>                
        </li>

        <li>                   
            <a href="<?php echo base_url();?>Crud/Internal">
                <i class="pe-7s-graph2"></i> 
                <p>Estadisticas</p>
            </a>                
        </li>

        <li>                   
            <a href="<?php echo base_url();?>Crud/MailConfView">
                <i class="pe-7s-map"></i> 
                <p>Configurar Mailing</p>
            </a>                
        </li>

        <li>                   
            <a href="<?php echo base_url();?>Crud/InfoContactConf">
                <i class="pe-7s-map"></i> 
                <p>Info. de Contacto</p>
            </a>                
        </li>

    </ul>  
</div>