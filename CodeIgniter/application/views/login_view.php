<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->lang->line('website_title'); ?></title>
	<base href="<?php echo base_url(); ?>" />
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	
</head>
<body>
<div class="loginbox">
<h5> Welcome </h5>
<br />
<h6>Login with...</h6>
	<ul>
			<li>
	            	<ul>
	                <?php foreach($third_party_auth_providers as $provider) : ?>
	                	<li class="third_party <?php echo $provider; ?>">
	                	<?php echo anchor('login/openid_'.$provider, $provider); ?>
	                	</li>
	                <?php endforeach; ?>
			        </ul>
					<div class="clear"></div>
					      
			</li>
	</ul>	
</div> 
<br /> 	
<div class="openid_form">
	<?php if($show){
		$this->load->view('openid_form');} ?>
</div>