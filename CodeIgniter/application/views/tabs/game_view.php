<?php echo 'Game Page' ?>

<head>
<script src="<?php echo base_url(); ?>css/javascript/jquery-1.6.1.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>css/javascript/useronline.js" type="text/javascript"></script>
</head>

<br>

	<?php echo anchor('start/play', 'Game', 'Game'); ?>

<br>
<br>
<br>
<ul>
<li>Users Online:</li>
<?php foreach ($users as $user): ?>
	<li><?php echo $user;?>
	</li>
<?php endforeach;?>
</ul>

<br>
<br>
<br>