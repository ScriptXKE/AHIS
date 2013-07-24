<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* This class contains methods for the dashboard
* @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
*/
class Incident extends CI_Controller {

    // num of records per page
    private $limit = 10;

    /**
* Constructor method
*
* This constructor checks if the user has a valid session before
* transferring control to the index() method to load the dashboard
*
* @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
*
*/
    public function __construct() {

        // Run parent controller
        parent::__construct();

        /**
* The auth model is already autoloaded and the session validated
* Check if the user is logged in
*/
        $this->auth_model->is_logged_in();

        // load library
        $this->load->library(array('table', 'form_validation'));

        // load helper
        $this->load->helper('url');

        // load model
        $this->load->model('incident_model', '', TRUE);
    }

// END: __construct()

    /**
* Default method for the Incident controller
*
* This method loads the dasboard without any fuss
* Session validation has already taken place in the constructor
*
*/
    function index($offset = 0) {
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $incidents = $this->incident_model->get_paged_list($this->limit, $offset)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['view'] = site_url('incident/index');
        $config['total_rows'] = $this->incident_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Incident No', 'Reporter Name', 'Animal Specie', 'Tags)', 'Location');
        $i = 0 + $offset;
        foreach ($incidents as $incident) {
            $this->table->add_row(++$i, $incident->incident_id, $incident->reporter_id, $incident->animaltype_id, $incident->tags, $incident->location_id,
                    anchor('incident/list' . $incident->id, 'list', array('class' => 'list')) . ' ' .
                    anchor('incident/edit' . $incident->id, 'edit', array('class' => 'edit')) . ' ' .
                    anchor('incident/delete' . $incident->id, 'delete', array('class' => 'delete', 'onclick' => "return confirm('Are you sure want to delete this incident?')"))
            );
        }
        $data['table'] = $this->table->generate();

        // load view
        //$this->load->view('incidentList', $data);
        /**
* Load the main template and pass it the incident view
*/
        $this->load->view('main_template', $data);
    }

// END: index()

    function add() {
        // set empty default form field values
        $this->_set_fields();
        // set validation properties
        $this->_set_rules();

        // set common properties
        $data['title'] = 'Add new incident';
        $data['message'] = '';
        $data['action'] = site_url('incident/new');
        $data['link_back'] = anchor('incident/index', 'Back to list of incidents', array('class' => 'back'));
        $data['view'] = 'incident/edit';

        // load view
        $this->load->view('main_template', $data);
    }

    function create() {
        // set common properties
        $data['title'] = 'Add new incident';
        $data['action'] = site_url('incident/new');
        $data['link_back'] = anchor('incident/index', 'Back to list of incidents', array('class' => 'back'));
        $data['view'] = 'incident/edit';

        // set empty default form field values
        $this->_set_fields();
        // set validation properties
        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            // save data
            /**
* Add data saving code here
*
*/
            $id = $this->incident_model->save($incident);

            // set user message
            $data['message'] = '<div class="success">add new incident success</div>';
        }

        // load view
        $this->load->view('main_template', $data);
    }

    function view($id) {
        // set common properties
        $data['title'] = 'Incident Details';
        $data['link_back'] = anchor('incident/index', 'Back to list of incidents', array('class' => 'back'));

        // get incident details
        $data['incident'] = $this->incident_model->get_by_id($id)->row();
        $data['view'] = 'incident/list';

        // load view
        $this->load->view('main_template', $data);
    }

    function update($id) {
        // set validation properties
        $this->_set_rules();

        // prefill form values
        $incident = $this->incident_model->get_by_id($id)->row();
        $this->form_data->id = $id;
        // save data
        /**
* Add form data here, user form_data
*
*/
        // set common properties
        $data['title'] = 'Update incident';
        $data['message'] = '';
        $data['action'] = site_url('incident/update_changes');
        $data['link_back'] = anchor('incident/index', 'Back to list of incidents', array('class' => 'back'));
        $data['view'] = 'incident/index';

        // load view
        $this->load->view('main_template', $data);
    }

    function update_changes() {
        // set common properties
        $data['title'] = 'Update incident';
        $data['action'] = site_url('incident/update_changes');
        $data['link_back'] = anchor('incident/index', 'Back to list of incidents', array('class' => 'back'));

        // set empty default form field values
        $this->_set_fields();
        // set validation properties
        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            // save data
            $id = $this->input->post('id');
            // save data
            /**
* Add form data here, user form_data
*
*/
            $this->incident_model->update($id, $incident);

            // set user message
            $data['message'] = '<div class="success">update incident success</div>';
        }

        // set the view
        $data['view'] = 'incident/index';

        // load view
        $this->load->view('main_template', $data);
    }

    function delete($id) {
        // delete incident
        $this->incident_model->delete($id);

        // redirect to incident list page
        redirect('incident/index', 'refresh');
    }

    // set empty default form field values
    function _set_fields() {
        $this->form_data->id = '';
        /**
* ...set form_date form data here, user form_data
*
*/
    }

    // validation rules
    function _set_rules() {
        // save data
        /**
* Add form validation here data here, e.g as below
* $this->form_validation->set_rules('specie', 'Animal Type', 'trim|required');
* $this->form_validation->set_rules('date', 'date', 'trim|required|callback_valid_date');
* $this->form_validation->set_message('required', '* required');
* $this->form_validation->set_message('isset', '* required');
* $this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
* $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
*/
    }

    // date_validation callback
    function valid_date($str) {
        //match the format of the date
        if (preg_match("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts)) {
            //check weather the date is valid of not
            if (checkdate($parts[2], $parts[1], $parts[3]))
                return true;
            else
                return false;
        }
        else
            return false;
    }

}
/* End of file incident.php */
/* Location: ./application/controllers/incident.php */
