<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->lang->line('website_title'); ?></title>
	<base href="<?php echo base_url(); ?>" />
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	
</head>
<body>
	<ul>
		<?php echo form_open('login/createuser'); ?>
		<?php foreach($userdata as $item) : ?>
		<li>
		<label><?php echo $item; ?></label>
	 	<?php echo form_input(array('id' => $item, 'name' => $item)); ?>   
		</li>
		<?php endforeach; ?>
		<li>
		<?php echo validation_errors(); ?>
		</li>
		<li>
		<?php echo form_submit(array('name' => 'submit'), 'Submit'); ?>
		</li>
		
	</ul>
</body>
</html>