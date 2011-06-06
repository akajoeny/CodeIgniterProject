
<h4>Map over registrered users</h4>
<?php $this->load->view('gmap_view'); ?>
<br />

<div class="container10">
<div id="Userpage"> <?php //echo $this->session->userdata('account_id'); ?> <br>  

<?php echo form_open('start/userupdate'); ?>
	<ul>
	<?php foreach($userdata as $attributes) : ?>
 	<li>
 	<label><?php echo $attributes; ?></label>
 	<?php echo form_input(array('id' => $attributes, 'name' => $attributes)); ?>		
	</li>	
	<?php endforeach; ?>	
	<li>
	<?php echo validation_errors(); ?>
	</li>
	<li>
	<?php echo form_submit(array('name' => 'submit'), 'Change'); ?>
	</li>
	</ul>
	
<?php echo form_close(); ?>
<br />
</div>
<br />
</div>