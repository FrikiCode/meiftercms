<!doctype html>
<html lang="en">
	<?php $this->load->view('elements/head');?>
<body> 

<div class="wrapper">
    <div class="sidebar" data-color="orange" data-image="<?php echo base_url();?>assets/dashboard/img/full-screen-image-3.jpg">    
    	
        <?php $this->load->view('elements/logo');?>
        
    	<?php $this->load->view('elements/sidebar');?>

    </div>
    
    <div class="main-panel">

    	<?php $this->load->view('elements/toolbar');?>       
                     
        <div class="content">
            <div class="container-fluid">    
                <iframe src="<?php echo base_url();?>/Crud/shippingCost" style="height:450px;width:100%;float:left;border:none;"></iframe>
            </div>
        </div>

        <?php $this->load->view('elements/footer');?>
        
    </div>   
</div>

<?php $this->load->view('elements/scripts');?>