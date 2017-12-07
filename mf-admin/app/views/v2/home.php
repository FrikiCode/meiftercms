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
        <?php $this->load->view('v2/modules/dashboard');?>
			</div>
		</div>

	</div>

<?php $this->load->view('v2/elements/scripts');?>
