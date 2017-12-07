<nav class="navbar navbar-default">
    <div class="container-fluid">    
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Panel de Control</a>
        </div>
        <div class="collapse navbar-collapse">       
            
            <form class="navbar-form navbar-left navbar-search-form" role="search">                  
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" value="" class="form-control" placeholder="Buscar...">
                </div> 
            </form>
              
            <ul class="nav navbar-nav navbar-right">
                                        
                <li class="dropdown dropdown-with-icons">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-list"></i>
                        <p class="hidden-md hidden-lg">
							Sistema
							<b class="caret"></b>
						</p>
                    </a>
                    <ul class="dropdown-menu dropdown-with-icons">
                        <li>
                            <a href="<?php echo base_url();?>Crud/SiteConfView">
                                <i class="pe-7s-tools"></i> Configuracion
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?=base_url()?>auth/logout" class="text-danger">
                                <i class="pe-7s-close-circle"></i>
                                Cerrar Sesion
                            </a>
                        </li>
                    </ul>
                </li>
                 
            </ul>
        </div>
    </div>
</nav>