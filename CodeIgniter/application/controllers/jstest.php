<?php

class Jstest extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code
        
		$this->load->library('javascript');
	}
	
	public function index()
	{
		$this->load->view('jstest_view');
	}
	
	public function username_taken()
	{
		$username = trim($_POST['username']);
		if ($username = 'Olof')
		{
			echo '1';
		}
	}
	
	public function test()
	{
		if(rand(1,3) == 1)
		{
    		/* Fake an error */
    		header("HTTP/1.0 404 Not Found");
    		die();
		}
		/* Send a string after a random number of seconds (2-10) */
		sleep(rand(2,10));
		echo("Hi! Have a random number: " . rand(1,10));
	}
	
	public function loggedinusers()
	{
		$this->load->model('account_model');
		
		$temp['users'] = $this->account_model->loggedinusers();
		
		//$i = 0;
		$send = false;
		
		$data = "";
		
		foreach ($temp['users'] as $user)
		{
			echo $user;
		}
	}
	
}?>