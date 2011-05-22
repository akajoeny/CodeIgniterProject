<?php

class Login extends CI_Controller {

	var $third_party_auth_providers;
	var $userdata;
	
	public function __construct()
	{
		parent::__construct();
        
		//Enable Query Strings
		parse_str($_SERVER['QUERY_STRING'],$_GET);
		
		//Load necessary..
		$this->load->library(array('authentication', 'Lightopenid'));
		$this->load->helper(array('language'));
		$this->load->model(array('account_model', 'account_details_model'));
		
		$this->third_party_auth_providers = array('google', 'yahoo', 'openid');
		$this->userdata = array('Username', 'First name', 'Last name', 'Country', 'City');
		
    }
	
	
	public function index() 
	{	
		$data['third_party_auth_providers'] = $this->third_party_auth_providers;
		$data['show'] = false;
		$this->load->view('login_view', $data);
		
	}//End index
	
	public function openid_openid()
	{
		/**
		 * Load page for user to provide an openid
		 */
		$data['third_party_auth_providers'] = $this->third_party_auth_providers;
		$data['show'] = true;
		$this->load->view('login_view', $data);
		
	}//End openid_openid
	
	/**
	 * 
	 * New openid login
	 */
	public function openid()
	{	
				
		$this->load->library('form_validation');
		$this->form_validation->set_rules('connect_openid_url', 'trim|required|xss_clean');
		$openid_identifier = $this->input->post('connect_openid_url');
		
		$openid = new LightOpenID();
		
		if ($this->form_validation->run()) 
		{		
			try 
			{
				if(!($openid->mode))
				{
					if (isset($openid_identifier))
					{
						$openid->required = array('contact/email');
						$openid->optional = array('namePerson/friendly', 'namePerson','birthDate', 'person/gender', 
												  'contact/postalCode/home', 'contact/country/home', 'pref/language', 
												  'pref/timezone');
						
						$openid->identity = $openid_identifier;
						header('Location: ' . $openid->authUrl());	
					}	
				}
				elseif ($openid->mode == 'cancel')
				{
					echo 'User has canceled authentication!';
				}
				else
				{
					echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
				}
			}
			catch(ErrorException $e) 
			{
				echo $e->getMessage();
			}
		}
		$this->validate($openid);
	} // End openid_openid	
	
	public function openid_google()
	{
		try 
		{
			$openid = new LightOpenID();
			
			if(!($openid->mode))
			{
					$openid->required = array('contact/email');
						$openid->optional = array('namePerson/friendly', 'namePerson','birthDate', 'person/gender', 
												  'contact/postalCode/home', 'contact/country/home', 'pref/language', 
												  'pref/timezone');
					$openid->identity = 'https://www.google.com/accounts/o8/id';
					header('Location: ' . $openid->authUrl());		
			}
			elseif ($openid->mode == 'cancel')
			{
				echo 'User has canceled authentication!';
			}
			else
			{
				echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
			}
		}
		catch(ErrorException $e) 
		{
			echo $e->getMessage();
		}
		$this->validate($openid);
	}//End openid_google
	
	public function openid_yahoo()
	{
		try 
		{
			$openid = new LightOpenID();
			
			if(!($openid->mode))
			{
					$openid->required = array('contact/email');
					$openid->optional = array('namePerson/friendly', 'namePerson','birthDate', 'person/gender', 
											  'contact/postalCode/home', 'contact/country/home', 'pref/language', 
											  'pref/timezone');
					
					$openid->identity = 'http://yahoo.com/';
					header('Location: ' . $openid->authUrl());		
			}
			elseif ($openid->mode == 'cancel')
			{
				echo 'User has canceled authentication!';
			}
			else
			{
				echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
			}
		}
		catch(ErrorException $e) 
		{
			echo $e->getMessage();
		}
		
		$this->validate($openid);
		
	}//End openid_yahoo
	
	private function validate($openid)
	{
		if($openid->validate())
		{
			$data = Array();
			$data = $openid->getAttributes(); 
			$account_email = $data['contact/email'];
			$this->authentication->sign_in($account_email);
			
			if($this->account_model->get_by_email($account_email))
			{
				$this->account_model->update_last_signed_in_datetime($account_email);
				redirect('start');	
			}
			else
			{
				$data['userdata'] = $this->userdata;
				$this->load->view('create_view', $data);
			}
		}
		
	} //End Validate
	
	
	/**
	 * 
	 * Create User
	 */
	
	public function createuser()
	{
		$attributes['username'] = $this->input->post('Username');
		$attributes['email'] = $this->session->userdata['account_id'];
		$this->load->model('account_model');
		$account_id = $this->account_model->create($attributes['username'], $attributes['email']);
		
		$details['firstname'] = $this->input->post('Firstname');
		$details['lastname'] = $this->input->post('Lastname');
		$details['city'] = $this->input->post('City');
		$details['country'] = $this->input->post('Country');
		
		$this->account_details_model->update($account_id, $details);
		
		$this->account_model->update_last_signed_in_datetime($account_email);
		redirect('start');
		
		
	}
}
?>

