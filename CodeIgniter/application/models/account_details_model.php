<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_details_model extends CI_Model {
	
	/**
	 * Count number of users
	 *
	 * @access public
	 * @param 
	 * @return int
	 */
	function count_all()
	{
		return $this->db->count_all('a3m_account_details');
	}
	
	/**
	 * Get account details by account_id
	 *
	 * @access public
	 * @param string $account_id
	 * @return object account details object
	 */
	function get_by_account_id($account_id)
	{
		return $this->db->get_where('a3m_account_details', array('account_id' => $account_id))->row();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get Country details by account_id
	 *
	 * @access public
	 * @param string $account_id
	 * @return object account details object
	 */
	function get_country($account_id)
	{
		$account_array = Array();
		$account_array = $this->db->get_where('a3m_account_details', array('account_id' => $account_id))->row_array();
		return $account_array['country']; 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get City details by account_id
	 *
	 * @access public
	 * @param string $account_id
	 * @return object account details object
	 */
	function get_city($account_id)
	{
		$account_array = Array();
		$account_array = $this->db->get_where('a3m_account_details', array('account_id' => $account_id))->row_array();
		return $account_array['city']; 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update account details
	 *
	 * @access public
	 * @param int $account_id
	 * @param array $attributes
	 * @return void
	 */
	function update($account_id, $attributes = array())
	{
		if (isset($attributes['fullname'])) if (strlen($attributes['fullname']) > 160) $attributes['fullname'] = substr($attributes['fullname'], 0, 160);
		if (isset($attributes['firstname'])) if (strlen($attributes['firstname']) > 80) $attributes['firstname'] = substr($attributes['firstname'], 0, 80);
		if (isset($attributes['lastname'])) if (strlen($attributes['lastname']) > 80) $attributes['lastname'] = substr($attributes['lastname'], 0, 80);
		if (isset($attributes['dateofbirth'])) 
		{
			$this->load->helper('date');
			$attributes['dateofbirth'] = mdate('%Y-%m-%d', strtotime($attributes['dateofbirth']));
		}
		if (isset($attributes['country']))
		{
			$attributes['country'] = $attributes['country'];
		}
		else
		{
			$attributes['country'] = '';
		}
		
		if (isset($attributes['gender'])) 
		{
			switch(strtolower($attributes['gender']))
			{
				case 'f': case 'female': $attributes['gender'] = 'f'; break;
				case 'm': case 'male': $attributes['gender'] = 'm'; break;
			}
		}
		if (isset($attributes['postalcode'])) if (strlen($attributes['postalcode']) > 40) $attributes['postalcode'] = substr($attributes['postalcode'], 0, 40);
		// Check that it's a recognized language (see http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes)
		if (isset($attributes['language'])) 
		{
			$language = preg_split('/[_-]/', $attributes['language']);
			// Check for valid language
			if (isset($language[0]))
			{
				$this->load->model('account/ref_language_model');
				$language = $this->ref_language_model->get($language[0]);
				$language ? $attributes['language'] = $language->one : NULL;
			}
		}
		// Check that it's a recognized timezone (tz database, see http://en.wikipedia.org/wiki/Zoneinfo)
		if (isset($attributes['timezone'])) 
		{
			$this->load->model('account/ref_zoneinfo_model');
			$timezone = $this->ref_zoneinfo_model->get_by_zoneinfo($attributes['timezone']);
			$timezone ? $attributes['timezone'] = $timezone->zoneinfo : NULL;
			
		}
		
		// Update
		if ($this->get_by_account_id($account_id))
		{
			$this->db->where('account_id', $account_id);
			$this->db->update('a3m_account_details', $attributes);
		}
		// Insert
		else
		{
			$attributes['account_id'] = $account_id;
			$this->db->insert('a3m_account_details', $attributes);
		}
	}
	
}

/* End of file account_details_model.php */
/* Location: ./application/modules/account/models/account_details_model.php */