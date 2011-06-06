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
	
	public function scrapper()
	{
		$this->load->view('jstest_view');
		
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

		// example 1: for everything with an id
		//$elements = $xpath->query("//*[@id]");

		// example 2: for node data in a selected id
		//$elements = $xpath->query("/html/body/div[@id='yourTagIdHere']");

		// example 3: same as above with wildcard
		$elements = $xpath->query("//*[@class='W']");
		
		if (!is_null($elements)) 
		{
			$length = $elements->length;
			
			//echo $length;
			foreach ($elements as $element) 
			{
	    		$string = $element->nodeValue;
	    		
	    		
	    		
	    		$firstdot = strpos($string, '.');
	    		if ($firstdot != null)
	    		{
		    		$headline = substr($string, 0, $firstdot);
		    		echo '<br>' . $headline;
		    	}
	    	
   			}
 		}		
	}	
}?>