<?php

class Game extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code
        
	}
	
	public function index()
	{
		redirect('start');
	}
	
	public function loggedinusers()
	{
		$this->load->model('account_model');
		
		$temp['users'] = "";
		$temp['users'] = $this->account_model->loggedinusers();
		
		//$i = 0;
		$send = false;
		$data = "";
		
		foreach ($temp['users'] as $user)
		{
			$data = $data . " <li> " . $user . "</li>";
		}
		echo $data;
	}
	public function gameboard()
	{
		echo "Gameboard";
		
		
	}
	
	
	
	
}?>
