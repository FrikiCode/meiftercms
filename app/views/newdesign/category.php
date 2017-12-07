<?php
  foreach ($category->result() as $catDisplay) {
    $catNameDisplay = $catDisplay->title;
  }
?>

<!doctype html>
<html lang="<?php echo $language;?>">
  <head>
    <?php $this->load->view('newdesign/assets/headnfo');?>
    <?php $this->load->view('newdesign/assets/style');?>
  </head>
  <body>
    <?php $this->load->view('newdesign/elements/header');?>

    <div class="main-container">

      <section class="page-title page-title-2 image-bg overlay">
          <div class="background-image-holder">
              <img alt="Background Image" class="background-image" src="<?php echo base_url();?>assets/v2/img/wide-1.jpg" />
          </div>
          <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <h2 class="uppercase mb8">Nuestra Carta</h2>
                      <h4 class="uppercase mb8"><?php echo $catNameDisplay;?></h4>
                      <p class="lead mb0">Productos frescos, siempre.</p>
                  </div>
              </div>
          </div>
      </section>

      <section>
          <div class="container">
              <div class="row">

                  <div class="col-md-9 col-md-push-3">

                      <div class="row masonry">

                        <?php foreach ($products->result() as $pro): ?>
                          <div class="col-md-4 col-sm-4 masonry-item col-xs-12">
                              <div class="image-tile outer-title text-center">
                                <a href="<?php echo base_url() . 'product/' . $pro->slug; ?>">
                                  <img alt="<?php echo $pro->name; ?>" class="product-thumb" src="<?php echo base_url() . 'assets/uploads/files/products/' . $pro->pic ?>" />
                                  <div class="title">
                                      <h5 class="mb0"><?php echo $pro->name; ?></h5>
                                      <p style="margin-bottom: 5px;"><?php echo $pro->short_desc; ?></p>
                                  </div>
                                </a>
                              </div>
                          </div>
                        <?php endforeach ?>

                      </div>
                  </div>


                  <div class="col-md-3 col-md-pull-9 hidden-sm">
                      <div class="widget">
                          <h6 class="title">Categorias</h6>
                          <hr>
                          <ul class="link-list">
                              <?php foreach ($categories->result() as $cts): ?>
                                <li>
                                  <a href="<?php echo base_url() . 'category/' . $cts->slug ?>"><?php echo $cts->title ?></a>
                                </li>
                              <?php endforeach ?>
                          </ul>
                      </div>
                  </div>

              </div>
          </div>

      </section>

    	<?php $this->load->view('newdesign/elements/footer');?>

    </div>

    <?php $this->load->view('newdesign/assets/scripts');?>
  </body>
</html>
