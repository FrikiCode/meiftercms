<!doctype html>
<html lang="en">
	<?php $this->load->view('elements/head');?>
<body> 

<div class="wrapper">
    <div class="sidebar" data-color="orange" data-image="<?php echo base_url();?>assets/dashboard/img/full-screen-image-3.jpg">    
    	
        <?php $this->load->view('elements/logo');?>
        
    	<?php $this->load->view('elements/sidebar');?>

    </div>
    
    <div class="main-panel">

    	<?php $this->load->view('elements/toolbar');?>       
                     
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Perfil</h4>
                            </div>
                            <div class="content">
                                <?php echo form_open_multipart('User/updateProfile');?>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Compañia</label>
                                                <input type="text" class="form-control" name="company" id="company" placeholder="Compañia" value="<?php echo getUserNfo(getMyID())['company'];?>">
                                            </div>        
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nombre de Usuario</label>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo getUserNfo(getMyID())['username'];?>">
                                            </div>        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">E-Mail</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo getUserNfo(getMyID())['email'];?>">
                                            </div>        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nombre" value="<?php echo getUserNfo(getMyID())['first_name'];?>">
                                            </div>        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Apellido</label>
                                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellido" value="<?php echo getUserNfo(getMyID())['last_name'];?>">
                                            </div>        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Direccion</label>
                                                <input type="text" class="form-control" name="adress" id="adress" placeholder="Direccion" value="<?php echo getUserNfo(getMyID())['adress'];?>">
                                            </div>        
                                        </div>
                                    </div>
                                    
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="paisID">Pais</label>
                                                <select id="paisID" name="paisID" class="form-control">
                                                  <option value="">Seleccione un Pais</option>
                                                  <?php foreach ($pais->result() as $sg): ?>
                                                    <option value="<?php echo $sg->id; ?>"><?php echo $sg->nombre; ?></option>  
                                                  <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="provinciaID">Provincia</label>
                                                <select id="provinciaID" name="provinciaID" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="partidoID">Partido</label>
                                                <select id="partidoID" name="partidoID" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="localidadID">Localidad</label>
                                                <select id="localidadID" name="localidadID" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="barrioID">Barrio</label>
                                                <select id="barrioID" name="barrioID" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subbarrioID">Sub Barrio</label>
                                                <select id="subbarrioID" name="subbarrioID" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Codigo Postal</label>
                                                <input type="number" class="form-control" name="zip" id="zip" placeholder="Codigo Postal" value="<?php echo getUserNfo(getMyID())['zip'];?>">
                                            </div>        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sobre Mi</label>
                                                <textarea rows="5" class="form-control" name="about" id="about" placeholder="Una breve descripcion"> <?php echo getUserNfo(getMyID())['about'];?></textarea>
                                            </div>        
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userPic">Imagen de Perfil</label>
                                                <?php echo form_upload('userPic'); ?>
                                                <img width="300" src="<?php echo getUserNfo(getMyID())['userPic'];?>">
                                                <a id="deleteProfilePic">Delete</a>
                                            </div>        
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Actualizar Perfil</button>
                                    <div class="clearfix"></div>
                                <?php echo form_close();?>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="<?php echo base_url();?>assets/dashboard/img/full-screen-image-3.jpg" alt="..."/>  
                            </div>
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                    <img class="avatar border-gray" src="<?php echo getUserNfo(getMyID())['image'];?>" alt="..."/>
                                   
                                      <h4 class="title"><?php echo getUserNfo(getMyID())['first_name'];?> <?php echo getUserNfo(getMyID())['last_name'];?><br />
                                         <small><?php echo getUserNfo(getMyID())['username'];?></small>
                                      </h4> 
                                    </a>
                                </div>  
                                <p class="description text-center">
                                    <?php echo getUserNfo(getMyID())['about'];?>
                                </p>
                            </div>
                        </div>
                    </div>
               
                </div>                    
            </div>
        </div>
        
        <?php $this->load->view('elements/footer');?>
        
    </div>   
</div>




<?php $this->load->view('elements/scripts');?>

<script type="text/javascript">
    $('#deleteProfilePic').click(function(){
        $.ajax({
            url: "/cm-admin/User/removeUserImg"            
        })
        .done(function( data ) {
         
        });
    });
    // Provincia, Localidad, Partido Combo
    $("#paisID").change(function() {
        paisID = $('#paisID').val();
        $("#paisID option:selected").each(function() {
            $.post("/location/getProvincia", {
                paisID : paisID
            }, function(data) {          
                $("#provinciaID").html(data);
            });
        });
    });
    $("#provinciaID").change(function() {
        provinciaID = $('#provinciaID').val();
        $("#provinciaID option:selected").each(function() {
            $.post("/location/getPartido", {
                provinciaID : provinciaID
            }, function(data) {          
                $("#partidoID").html(data);
            });
        });
    });
    $("#partidoID").change(function() {
        partidoID = $('#partidoID').val();
        $("#partidoID option:selected").each(function() {
            $.post("/location/getLocalidad", {
                partidoID : partidoID
            }, function(data) {          
                $("#localidadID").html(data);
            });
        });
    });
    $("#localidadID").change(function() {
        localidadID = $('#localidadID').val();
        $("#localidadID option:selected").each(function() {
            $.post("/location/getBarrio", {
                localidadID : localidadID
            }, function(data) {          
                $("#barrioID").html(data);
            });
        });
    });
    $("#barrioID").change(function() {
        barrioID = $('#barrioID').val();
        $("#barrioID option:selected").each(function() {
            $.post("/location/getSubbarrio", {
                barrioID : barrioID
            }, function(data) {          
                $("#subbarrioID").html(data);
            });
        });
    });
    // Provincia, Localidad, Partido Combo End
</script>