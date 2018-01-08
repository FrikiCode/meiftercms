<section class="cover fullscreen image-bg overlay">
    <div class="background-image-holder">
        <img alt="image" class="background-image" src="<?php echo base_url();?>assets/img/home12.jpg" />
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">Iniciar Sesion</h4>
                    <?php echo form_open("User/logUser", 'class="text-left"');?>
                        <input type="text" name="logmail" id="logmail" class="mb0" value="" placeholder="E-Mail">
                        <input type="password" name="logpass" id="logpass" class="mb0" value="" placeholder="Password">
                        <input type="submit" value="Iniciar Sesion" />
                    <?php echo form_close();?>
                    <p class="mb0">
                        <a href="#">Olvide mi contraseña</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
