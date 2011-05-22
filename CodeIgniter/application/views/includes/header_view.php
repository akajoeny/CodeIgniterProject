<html>
<head>
	<base href="<?php echo base_url(); ?>" />
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	
	<title>Main Page</title>
</head>
<body>

<p id="main">Klunsa loss</p>

<?php  $this->load->helper('html'); ?>

<table id="mainmenu">
<th>
	<td id="sidetabs"><?php echo anchor('start', img('css/img/Home.jpg')); ?></td>
	<td id="maintabs"><?php echo anchor('start/UserPage', $tabs['1']); ?> </td>
	<td id="maintabs"><?php echo anchor('start/GamePage', $tabs['2']); ?> </td>
	<td id="maintabs"><?php echo anchor('start/AboutUs', $tabs['3']); ?> </td>
	<td id="sidetabs"><?php echo anchor('start/signout', 'Sign Out'); ?></td>
</th>
</table>
