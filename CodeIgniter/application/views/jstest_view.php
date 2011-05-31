<html>
<head>
<base href="<?php echo base_url(); ?>" />
<script src="<?php echo base_url(); ?>css/javascript/jquery-1.6.1.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>css/javascript/myfirstscript.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>css/javascript/useronline.js" type="text/javascript"></script>
<title>My first Javascript</title>
</head>
<body>

<?php echo form_open('jstest/test'); ?>
	
		<ul>
		<li>
		<label>Username</label>
		<div>
		<?php echo form_input(array('id' => 'username', 'name' => 'username')); ?>
		</div>
		</li>
		
		<li>
		<label>Another Field</label>
		<div>
		<?php echo form_input(array('id' => 'anotherfield', 'name' => 'anotherfield')); ?>
		</div>
		</li>
		
		<li>
		<?php echo validation_errors(); ?>
		</li>
	
		<li>
		<?php echo form_submit(array('name' => 'submit'), 'Test'); ?>
		</li>
		</ul>
	
<?php echo form_close(); ?>


<br>
<br>
<br>
<p> Logged in users </p>
	    <div id="messages">
	        <div class="msg old">
	            BargePoll message requester!
	        </div>
	        <div id="usersonline"></div>
	    </div>

</body>

</html>