<?php

$this->load->helper('date', 'html');
$now = time();

$datanew['image_properties'] = array(
								           'src' => 'http://www.ajbinspections.com/images/home-icon%20copy.jpg',
								           'alt' => 'Welcome',
								           'class' => 'post_images',
								           'width' => '25',
								           'height' => '25',
								           'title' => 'That was quite a night',
								           'rel' => 'lightbox'
											);

$datanew['time'] = unix_to_human($now, FALSE, 'eu');
$datanew['tabs'] = array( 1 => 'User Page', 2 => 'Game Page', 3 => 'About Us');

$this->load->view('includes/header_view', $datanew);
$this->load->view('tabs/' . $main_content . '_view');
$this->load->view('includes/footer_view', $datanew);

?>