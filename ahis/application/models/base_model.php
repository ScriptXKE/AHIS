<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This model contains generic methods that are not necessarily module / functionality
 * specific but are applicable throughout the AHIS
 *
 * This model is autoloaded in the ./application/config/autoload.php file
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 * 
 */

class Base_model extends CI_Model {


	/**
	 * Constructor method
	 */
	public function __construct() {

		/**
		 * Constructor the class ... right now it does nothing
		 */
		parent::__construct();

	}


	/**
	 * Clears the cache to remove any traces of a previous session
	 *
	 * This method clears the cache completely to avoid instances where you've logged out but when you go back
	 * in the browser, the previously loaded page (one that you've logged out already) is loaded as if you haven't
	 * logged out yet; this method totally clears the cache and enables redirecting to the login page
	 * 
	 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
	 * 
	 */
    public function clear_cache()
    {

    	/**
    	 * Run the code to completely clear the cache
    	 */
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

    }	// END: clear_cache()
	


}


/* End of file base_model.php */
/* Location: ./application/models/base_model.php */