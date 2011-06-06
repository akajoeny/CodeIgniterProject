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
		$gamemap = $this->gmap;
		
		$gamemap->GoogleMapAPI();
		//valid types are hybrid, satellite, terrain, map
		$gamemap->setMapType('map');
		
		$gamemap->setZoomLevel(2);
		$gamemap->setWidth(800);
		$gamemap->setHeight(400);
		//$gamemap->setCenterCoords();
		$gamemap->adjustCenterCoords(0,0);
		$data['headerjs'] = $gamemap->getHeaderJS();
		$data['headermap'] = $gamemap->getMapJS();
		$data['onload'] = $gamemap->printOnLoad();
		$data['map'] = $gamemap->printMap();
		$data['sidebar'] = $gamemap->printSidebar();
	
		$this->load->view('mapgame_view', $data);
		
	}
	
}?>