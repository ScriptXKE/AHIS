<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class contains methods for the dashboard
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 */
class Dashboards extends CI_Controller 
{
	public function __construct() 
	{

		// Run parent controller
		parent::__construct();
		$this->auth_model->is_logged_in();

		/**
		 * The auth model is already autoloaded and the session validated
		 * Check if the user is logged in
		 */


		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('ahis_CRUD');	

	}	// END: __construct()


	function _dashboard_output($output = null)
	{
		$this->load->view('main_template.php',$output);	
	}


	/**
	 * Default method for the Dashboard controller
	 * 
	 * This method loads the dasboard without any fuss
	 * Session validation has already taken place in the constructor
	 *
	 */
	public function index() 
	{

		/**
		 * Create the output array
		 */
		$output = array(
				'view' => 'dashboard/index'
			);

		/**
		 * Load the main template and pass it the dashboard view
		 */
		//$this->load->view('main_template', $data);
		$this->_dashboard_output($output);
		
	}	// END: index()


	function animaltypes_management()
	{
		try{
			$crud = new ahis_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('animaltype');
			$crud->set_subject('Animal');
			$crud->required_fields('Type');
			$crud->columns('Type');
			
			$output = $crud->render();
			
			$this->_dashboard_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	function cases_management()
	{
		try{
			$crud = new ahis_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('case');
			$crud->set_subject('Case');
			$crud->required_fields('CaseID', 'CaseNumber', 'CaseNotes');
			$crud->columns('AnimalType_ID','Sms_ID','Reporter_ID','User_ID','Location_ID');
			
			$output = $crud->render();
			
			$this->_dashboard_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	function offices_management()
	{
		try{
			$crud = new ahis_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');
			
			$output = $crud->render();
			
			$this->_dashboard_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}



	function diseases_management()
	{
		try{
			$crud = new ahis_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('diseases');
			$crud->set_subject('Disease');
			$crud->required_fields('Disease');
			$crud->columns('Disease');
			
			$output = $crud->render();
			
			$this->_dashboard_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function employees_management()
	{
			$crud = new ahis_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');
			
			$crud->required_fields('lastName');
			
			$crud->set_field_upload('file_url','assets/uploads/files');
			
			$output = $crud->render();

			$this->_dashboard_output($output);
	}
	
	function customers_management()
	{
			$crud = new ahis_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');
			
			$output = $crud->render();
			
			$this->_dashboard_output($output);
	}	
	
	function orders_management()
	{
			$crud = new ahis_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->_dashboard_output($output);
	}
	
	function products_management()
	{
			$crud = new ahis_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));
			
			$output = $crud->render();
			
			$this->_dashboard_output($output);
	}	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	
	function film_management()
	{
		$crud = new ahis_CRUD();
		
		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');
		
		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
		
		$output = $crud->render();
		
		$this->_dashboard_output($output);
	}
	
}


/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */