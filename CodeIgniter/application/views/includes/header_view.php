<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<base href="<?php echo base_url(); ?>" />
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	
	<title>Main Page</title>
</head>
<body>

<h1>Klunsa loss</h1>

<?php  $this->load->helper('html'); ?>

<table id="mainmenu">
<th>
	<td id="sidetabs"><?php echo anchor('start', img('css/img/Home.jpg')); ?></td>
	<td id="maintabs"><?php echo anchor('start/UserPage', $tabs['1']); ?> </td>
	<td id="maintabs"><?php echo anchor('start/GamePage', $tabs['2']); ?> </td>
	<td id="maintabs"><?php echo anchor('start/AboutUs', $tabs['3']); ?> </td>
	<td id="maintabs"><?php echo anchor('MapGame', $tabs['4']); ?> </td>
	<td id="sidetabs"><?php echo anchor('start/signout', 'Sign Out'); ?></td>
</th>
</table>
