<?php echo form_open('login/openid'); ?>
	
		<ul>
		<li>
		<label>Put in your openid</label>
		<div>
		<?php echo form_input(array('id' => 'connect_openid_url', 'name' => 'connect_openid_url')); ?>
		</div>
		</li>
		
		<li>
		<?php echo validation_errors(); ?>
		</li>
	
		<li>
		<?php echo form_submit(array('name' => 'submit'), 'Log in'); ?>
		</li>
		</ul>
	
<?php echo form_close(); ?>