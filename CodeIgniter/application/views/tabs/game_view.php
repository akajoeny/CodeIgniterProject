<!-- Displaying Gameboard creation and currently signed on users -->
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
 
<h5> Users Online </h5>

<div id="users">
<ul id="usersonline"></ul>	   
</div>
</div>