<!doctype html>
<html lang="en">
  <?php $this->load->view('assets/head');?>
  <body>
    <?php $this->load->view('modules/header');?>
    <div class="main-container">
      <?php $this->load->view($module);?>

      <?php $this->load->view('modules/footer');?>
    </div>
    <?php $this->load->view('assets/scripts');?>
  </body>
</html>
