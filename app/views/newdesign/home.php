<!doctype html>
<html lang="<?php echo $language;?>">
  <head>
    <?php $this->load->view('newdesign/assets/headnfo');?>
    <?php $this->load->view('newdesign/assets/style');?>
  </head>
  <body>
    <?php $this->load->view('newdesign/elements/header');?>

    <div class="main-container">
    	<section class="cover fullscreen image-slider slider-arrow-controls controls-inside parallax">
      	<ul class="slides">

          <li class="overlay image-bg">
        		<div class="background-image-holder">
        			<img alt="image" class="background-image" src="<?php echo base_url();?>assets/v2/img/slide1.jpg">
        		</div>
        		<div class="container v-align-transform">
        			<div class="row">
        				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
        					<h3 class="uppercase mb32">Sushi Fresco. Siempre.</h3>
        					<p class="text-center mb0">
        						 En Ohaku preparamos nuestro sushi con ingredientes seleccionados, todos los dias.
        					</p>
        				</div>
        			</div>
        		</div>
      		</li>

          <li class="overlay image-bg">
        		<div class="background-image-holder">
        			<img alt="image" class="background-image" src="<?php echo base_url();?>assets/v2/img/slide2.jpg">
        		</div>
        		<div class="container v-align-transform">
        			<div class="row">
        				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
        					<h3 class="uppercase mb32">Aprovecha las Promociones</h3>
        					<p class="text-center mb0">
                    Sumate con nosotros en nuestras Redes Sociales y enterate de las promociones que lanzamos todos los dias.
                  </p>
        				</div>
        			</div>
        		</div>
      		</li>

      	</ul>
    	</section>

    	<?php $this->load->view('newdesign/elements/footer');?>

    </div>

    <?php $this->load->view('newdesign/assets/scripts');?>
  </body>
</html>
