<div class="masonary">
  <div class="col s12">
    <div class="widget z-depth-1">
      <div class="loader"></div>
      <div class="widget-title">
        <h3><?php echo $title;?></h3>
        <p><?php echo $desc;?></p>
      </div>
      <div class="widget-crud">
        <iframe class="widgetForCrud" src="<?php echo base_url() . '/Crud/' .  $url;?>" style="height:450px;width:100%;float:left;border:none;"></iframe>
      </div>
    </div>
  </div>
</div>
