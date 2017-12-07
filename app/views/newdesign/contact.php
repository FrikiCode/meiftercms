<!doctype html>
<html lang="<?php echo $language;?>">
  <head>
    <?php $this->load->view('newdesign/assets/headnfo');?>
    <?php $this->load->view('newdesign/assets/style');?>
  </head>
  <body>
    <?php $this->load->view('newdesign/elements/header');?>

    <div class="main-container">

      <section class="image-slider slider-all-controls parallax controls-inside pt0 pb0">
      	<ul class="slides">
      		<li class="overlay image-bg pt240 pb240 pt-xs-120 pb-xs-120">
      		<div class="background-image-holder">
      			<img alt="image" class="background-image" src="<?php echo base_url();?>assets/v2/img/contactbg.jpg">
      		</div>
      		<div class="container">
      			<div class="row text-center">
      				<div class="col-md-12">
      					<h2 class="mb40 uppercase">conocenos hoy</h2>
      				</div>
      			</div>
      		</div>
      		</li>
      	</ul>
    	</section>

      <section>
    	   <div class="container">
      		<div class="row">
      			<div class="col-sm-6">
      			</div>
      			<div class="col-sm-6">
              <div class="map-holder pt160 pb160 mt-xs-0 mb24" style="height: 500px;">
      					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1912.1651080127142!2d-58.70429952749014!3d-34.54636942450474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcbd08c4c07a89%3A0xf2243e381d6923ae!2sPaunero+1008%2C+B1662ARF+Mu%C3%B1iz%2C+Buenos+Aires!5e0!3m2!1ses-419!2sar!4v1510920654072" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      				</div>
      				<div class="feature bordered">
      					<h4 class="uppercase">Contactanos</h4>
      					<p>
                  Paunero 1008 (Esq. Las Heras)<br>
      						 <?php echo getContactNfo()['city'];?>, Buenos Aires
      					</p>
      					<p>
      						<strong>Tel.: 4007-5013 / 4664-7071 <br>
      						<strong>E-Mail:</strong> <?php echo getContactNfo()['email'];?> <br>
                  <strong>Horario:</strong> 19Hs. a 23Hs.
      					</p>
                <h4 class="uppercase">Redes Sociales</h4>
                <a href="https://www.facebook.com/ohaku.sushi/" target="_blank"><i class="ti ti-facebook icon-sm"></i></a>
                <a href="https://www.instagram.com/ohakusushi/" target="_blank" style="margin-left: 60px;"><i class="ti ti-instagram icon-sm"></i></a>
      				</div>
      			</div>
      		</div>
      	</div>
    	</section>

    	<?php $this->load->view('newdesign/elements/footer');?>

    </div>

    <?php $this->load->view('newdesign/assets/scripts');?>
    <script>
      $( "#contactForm" ).submit(function( event ) {
        event.preventDefault();
        var $form = $( this );
        var urlForm = $form.attr( "action" );
        var name = $("#contact-name").val();
        var email = $("#contact-email").val();
        var subject = $("#contact-subject").val();
        var message = $("#contact-message").val();
        $.ajax({
          method: "POST",
          url: urlForm,
          data: { name: name, email: email, subject: subject, message: message },
          beforeSend: function() {
              $('#loadingDiv').show();
            },
        }).done(function() {
          $('#loadingDiv').hide();
          $('#contactOk').css('display', 'block');
          $('#contactSend').prop('disabled', true);
          $('#contactSend').addClass('sent');
        })
        .fail(function() {
          $('#loadingDiv').hide();
          $('#contactError').css('display', 'block');
          $('#contactSend').prop('disabled', true);
          $('#contactSend').addClass('sent');
        });
      });
    </script>
    <style>
      .form-error {
        display: none!important;
      }
    </style>
  </body>
</html>
