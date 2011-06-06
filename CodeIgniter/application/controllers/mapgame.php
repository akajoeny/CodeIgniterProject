<?php

class MapGame extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code
        $this->load->library('GMap');
	}
	
	public function index()
	{
		$this->load->view('mapgamescript_view');	
	}
	
}?>