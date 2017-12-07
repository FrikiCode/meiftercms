<div class="breadcrumb-bar">
  <ul class="admin-breadcrumb">
    <li>
      <a href="<?php echo base_url();?>" title="">Dashboard</a>
    </li>
    <?php if (isset($title)): ?>
      <li>
        <?php echo $title;?>
      </li>
    <?php endif; ?>
  </ul>
</div>
