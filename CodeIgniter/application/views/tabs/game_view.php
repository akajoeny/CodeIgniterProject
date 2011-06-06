<head>
<script src="<?php echo base_url(); ?>css/javascript/jquery-1.6.1.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>css/javascript/useronline.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>css/javascript/userlist.js" type="text/javascript"></script>
</head>
<div class="container40">
<?php //echo anchor('start/play', 'Game', 'Game'); ?>
<br />
<div class="container41">
<div class="gameboard">
	<?php $atts = array(
               'width'      => '200',
               'height'     => '200',
               'scrollbars' => 'no',
               'status'     => 'yes',
               'resizable'  => 'no',
               'screenx'    => '200',
               'screeny'    => '100'
             );

	echo anchor_popup('game/gameboard', 'Create Gameboard!', $atts); ?>
</div>
 
<h5> Logged in users </h5>

<div id="users">
<ul id="usersonline"></ul>	   
</div>
</div>
<br />
<br />
<br />
</div>