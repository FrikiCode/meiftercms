<section class="cover fullscreen image-bg overlay">
    <div class="background-image-holder">
        <img alt="image" class="background-image"  src="<?php echo base_url();?>assets/img/home2.jpg" />
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">Crear nueva cuenta</h4>
                    <?php echo form_open("User/regUser", 'class="text-left"');?>
                        <input type="text" name="name" id="name" placeholder="Nombre" />
                        <input type="text" name="lastname" id="lastname" placeholder="Apellido" />
                        <input type="text" name="mail" id="mail" placeholder="E-Mail" />
                        <input type="password" name="pass" id="pass" placeholder="Contraseña" />
                        <input type="submit" value="Registrarme" />
                    <?php echo form_close();?>
                    <p class="mb0">Al registrarse acepta nuestros
                        <a href="#">Terminos y Condiciones</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
