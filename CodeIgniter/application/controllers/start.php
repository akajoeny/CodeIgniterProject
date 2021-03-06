<?php

class Start extends CI_Controller {

	var $userdata;
	
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code
        
		//Load library
		$this->load->library('authentication');
		
		//Check login status
		if(!$this->authentication->is_signed_in())
		{
			redirect('login');
		}
		
		$this->load->helper('url', 'from', 'html');
		$this->load->model(array('account_model', 'account_details_model'));
		$this->userdata = array('Firstname', 'Lastname', 'Country', 'City');
		
    }
    
	public function index()
	{
		$data['main_content'] = 'main';
		
		$news = '';
		$target_url = "http://svt.se/svttext/web/pages/300.html";
		$userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';

		// make the cURL request to $target_url
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($curl, CURLOPT_URL,$target_url);
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		$html= curl_exec($curl);
		if (!$html) {
			echo "<br />cURL error number:" .curl_errno($curl);
			echo "<br />cURL error:" . curl_error($curl);
			exit;
		}
		
		// parse the html into a DOMDocument
		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		
		// grab all the on the page
		$xpath = new DOMXpath($dom);

		// For everything with class = W
		$elements = $xpath->query("//*[@class='W']");
		
		if (!is_null($elements)) 
		{
			$length = $elements->length;
			foreach ($elements as $element) 
			{
	    		$string = $element->nodeValue;
	    		
	    		$firstdot = strpos($string, '.');
	    		if ($firstdot != null && $firstdot > 3)
	    		{
		    		$headline = substr($string, 0, $firstdot);
		    		$news = $news . $headline .  '<br />';
		    	}elseif ($firstdot < 3 && $firstdot != null)
		    	{
		    		$string = substr($string, 4);
		    		$enddot = strpos($string, '.');
		    		if ($enddot != null && $enddot > 3)
	    			{
		    			$headline = substr($string, 0, $enddot);
		    			$news = $news . $headline .  '<br />';
		    		}
		    	}
   			}
		}
 		$data['texttvnews'] = $news;
 		$this->load->view('template_view', $data);		
	}	
	
	public function UserPage()
	{
		$data = $this->google("only me");
		$data['userdata'] = $this->userdata;
 		$data['main_content'] = 'user';
		$this->load->view('template_view', $data);	
	}
	
	public function GamePage()
	{
		$data['main_content'] = 'game';
		
		$data['users'] = $this->account_model->loggedinusers();
		
		$this->load->view('template_view', $data);
		//$this->load->library('ajax');
	}
	
	public function AboutUs()
	{
		$prefs = array (
                'start_day'    => 'saturday',
                'month_type'   => 'long',
                'day_type'     => 'short'
              );

 		$this->load->library('calendar', $prefs);
		
		$data['main_content'] = 'about us';
		$this->load->view('template_view', $data);	
	}
	
	public function play()
	{
		redirect('http://www-und.ida.liu.se/~mikkl381/test/');
		//$this->load->view('test/index.php');
	}
	
	public function userupdate()
	{	
		$attributes['city'] = $this->input->post('City');
		$attributes['country'] = $this->input->post('Country');
		$attributes['firstname'] = $this->input->post('Firstname');
		$attributes['lastname'] = $this->input->post('Lastname');
		
		
		$this->load->model('account_details_model');
		$this->load->model('account_model');		
		$account_email = $this->session->userdata['account_id'];
		$account_id = $this->account_model->get_account_id($account_email);
		$this->account_details_model->update($account_id, $attributes);
		redirect('start');
	}
	
	public function signout()
	{
		$this->authentication->sign_out();
		redirect('');
	}

	public function google($all)
    {
		$account_email = $this->session->userdata['account_id'];
		$account_id = $this->account_model->get_account_id($account_email);
    	$city = $this->account_details_model->get_city($account_id);
    	$country = $this->account_details_model->get_country($account_id);
    	$address = $city . ' , ' .  $country;
    	
    	$this->load->library('GMap');
    	$this->gmap->GoogleMapAPI();
		//valid types are hybrid, satellite, terrain, map
		$this->gmap->setMapType('hybrid');
		$this->gmap->addMarkerByAddress($address, 'You live here', $address);
		$geocode = $this->gmap->getGeoCode($address);
		
		if ($all = "all")
		{
	    	$count = $this->account_details_model->count_all();
	 		for ($i = 1; $i <= $count; $i++) 
	 		{
	    		$city = $this->account_details_model->get_city($i);
	    		$country = $this->account_details_model->get_country($i);
	    		$address = $city . ' , ' .  $country;
	    		$this->gmap->addMarkerByAddress($address, 'Some user', $address);
			}
		}
		
		
		$this->gmap->enableInfoWindow();
		$this->gmap->setInfoWindowTrigger('click');
		$this->gmap->disableSidebar();
		$this->gmap->setZoomLevel(4);
		$this->gmap->setWidth(800);
		$this->gmap->setHeight(400);
		$this->gmap->setCenterCoords($geocode['lon'], $geocode['lat']);
		//$this->gmap->adjustCenterCoords($geocode['lon'],$geocode['lat']);
		$data['headerjs'] = $this->gmap->getHeaderJS();
		$data['headermap'] = $this->gmap->getMapJS();
		$data['onload'] = $this->gmap->printOnLoad();
		$data['map'] = $this->gmap->printMap();
		$data['sidebar'] = $this->gmap->printSidebar();
		
		return $data;    	
    }
	
}
?>