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

  <?php $this->load->view('v2/elements/toolbar');?>

  <?php $this->load->view('v2/elements/sidebar');?>

  <div class="content-area">
    <?php $this->load->view('v2/elements/breadcrum');?>
		<div class="widgets-wrapper">
			<div class="row">
        <div class="masonary">
          <div class="col s12">
            <div class="widget z-depth-1">
              <div class="loader"></div>
              <div class="widget-title">
                <h3><?php echo $title;?></h3>
                <p><?php echo $desc;?></p>
              </div>
              <div class="widget-crud">
                <div class="col s12">
                  <?php echo form_open_multipart('User/updateProfile');?>
                      <div class="row">
                        <div class="input-field col s6">
                          <input id="last_name" type="text" class="validate" placeholder="Nombre" value="<?php echo getUserNfo(getMyID())['first_name'];?>">
                          <label for="first_name">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                          <input id="last_name" type="text" class="validate" placeholder="Apellido" value="<?php echo getUserNfo(getMyID())['last_name'];?>">
                          <label for="last_name">Apellido</label>
                        </div>
      									<div class="input-field col s12">
      										<textarea id="textarea1" class="materialize-textarea"><?php echo getUserNfo(getMyID())['about'];?></textarea>
      										<label for="textarea1">Un poco sobre mi</label>
      									</div>
                      </div>
                      <div class="row">
                        <div class="input-field col s6">
                          <input id="last_name" type="text" class="validate" placeholder="Compañia" value="<?php echo getUserNfo(getMyID())['company'];?>">
                          <label for="first_name">Compañia</label>
                        </div>
                        <div class="input-field col s6">
                          <input id="last_name" type="text" class="validate" placeholder="Username" value="<?php echo getUserNfo(getMyID())['username'];?>">
                          <label for="last_name">Nombre de Usuario</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <input id="password" type="password" class="validate">
                          <label for="password">Password</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" placeholder="Email" value="<?php echo getUserNfo(getMyID())['email'];?>">
                            <label for="email">Email</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s8">
                            <input id="email" type="email" class="validate">
                            <label for="email">Direccion</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="paisID" name="paisID">
                              <option value="" disabled selected>Seleccione su Pais</option>
                              <?php foreach ($pais->result() as $sg): ?>
                                <option value="<?php echo $sg->id; ?>"><?php echo $sg->nombre; ?></option>
                              <?php endforeach ?>
                            </select>
                            <label for="paisID">Pais</label>
                        </div>
                        <div class="input-field col s4">
                            <label for="provinciaID">Provincia</label>
                            <select id="provinciaID" name="provinciaID"></select>
                        </div>
                        <div class="input-field col s4">
                            <label for="partidoID">Partido</label>
                            <select id="partidoID" name="partidoID"></select>
                        </div>
                        <div class="input-field col s4">
                            <label for="localidadID">Localidad</label>
                            <select id="localidadID" name="localidadID"></select>
                        </div>
                        <div class="input-field col s4">
                            <label for="barrioID">Barrio</label>
                            <select id="barrioID" name="barrioID"></select>
                        </div>
                        <div class="input-field col s4">
                            <label for="subbarrioID">Sub Barrio</label>
                            <select id="subbarrioID" name="subbarrioID"></select>
                        </div>
                        <div class="input-field col s4">
                            <input id="email" type="text" class="validate" value="<?php echo getUserNfo(getMyID())['zip'];?>">
                            <label for="email">Codigo Postal</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <div class="button-set">
                            <button type="button" class="modal-action modal-close waves-effect waves-light btn-flat green lighten-2 white-text save-contact">Guardar Ajustes</button>
                          </div>
                        </div>
                      </div>
                  <?php echo form_close();?>
                </div>
              </div>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>

<?php $this->load->view('v2/elements/scripts');?>
<script type="text/javascript">
    $('#deleteProfilePic').click(function(){
        $.ajax({
            url: "<?php echo base_url();?>User/removeUserImg"
        })
        .done(function( data ) {

        });
    });
    // Provincia, Localidad, Partido Combo
    $("#paisID").change(function() {
        paisID = $('#paisID').val();
        $("#paisID option:selected").each(function() {
            $.post("<?php echo base_url();?>location/getProvincia", {
                paisID : paisID
            }, function(data) {
                $("#provinciaID").html(data);
            });
        });
    });
    $("#provinciaID").change(function() {
        provinciaID = $('#provinciaID').val();
        $("#provinciaID option:selected").each(function() {
            $.post("<?php echo base_url();?>location/getPartido", {
                provinciaID : provinciaID
            }, function(data) {
                $("#partidoID").html(data);
            });
        });
    });
    $("#partidoID").change(function() {
        partidoID = $('#partidoID').val();
        $("#partidoID option:selected").each(function() {
            $.post("<?php echo base_url();?>location/getLocalidad", {
                partidoID : partidoID
            }, function(data) {
                $("#localidadID").html(data);
            });
        });
    });
    $("#localidadID").change(function() {
        localidadID = $('#localidadID').val();
        $("#localidadID option:selected").each(function() {
            $.post("<?php echo base_url();?>location/getBarrio", {
                localidadID : localidadID
            }, function(data) {
                $("#barrioID").html(data);
            });
        });
    });
    $("#barrioID").change(function() {
        barrioID = $('#barrioID').val();
        $("#barrioID option:selected").each(function() {
            $.post("<?php echo base_url();?>location/getSubbarrio", {
                barrioID : barrioID
            }, function(data) {
                $("#subbarrioID").html(data);
            });
        });
    });
    // Provincia, Localidad, Partido Combo End
</script>
