<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This class contains methods for adding persons
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 02 August 2013
 */
class Persons extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->firstname = " ";
        $this->surname = " ";
        $this->othernames = " ";
        $this->gender = " ";
        $this->birthdate = " ";
        $this->telephone = " ";
        $this->email = " ";
        $this->biodata = " ";
        $this->avatar = " ";
        // Check if the user is logged in because all incident operations require login
        $this->auth_model->is_logged_in();

        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'ahis_helper'));

        // Load the persons model
        $this->load->model(array('persons_model', 'base_model'), TRUE);
    }

    function index() {
        $this->manage();
    }

    function manage() {
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = base_url() . 'persons/manage/';
        $config['total_rows'] = $this->persons_model->count();
        $config['per_page'] = 15;
        $this->pagination->initialize($config);

        // Prepare the data for the page
        $this->data['title'] = 'Persons: Basic Details';
        $this->data['results'] = $this->persons_model->get('', $config['per_page'], $this->uri->segment(3));
        $this->data['view'] = 'persons/list';
        //$this->data['msg'] = 'I am Listing all persons ...';
        // Load the view
        $this->load->view('main_template', $this->data);
    }

    function add() {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $msg = "<p>The following notice(s) / error(s) were noted:-</p><ul>";
            $the_person_id = "";
            /*             * ************** BASIC PERSON DETAILS *************************** */
            // Let's set form validation config file for the person details
            $person_details_validation_config = array(
                array(
                    'field' => 'u_firstname',
                    'label' => 'First Name',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'u_surname',
                    'label' => 'Surname',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'u_othernames',
                    'label' => 'Other Name(s)',
                    'rules' => 'trim'
                ),
                array(
                    'field' => 'u_email',
                    'label' => 'Email',
                    'rules' => 'trim|valid_email|callback_email_check'
                ),
                array(
                    'field' => 'u_telephone',
                    'label' => 'Telephone',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'u_biodata',
                    'label' => 'Biodata',
                    'rules' => 'trim'
                )
            );
            // Load the form validation library
            $this->load->library('form_validation');

            // Set the validation delimiters
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            // Load the validation configuration
            $this->form_validation->set_rules($person_details_validation_config);

            if ($this->form_validation->run() == false) {
                // Return the error(s) encountered
                $msg.= (validation_errors() ? validation_errors() : false);
                $this->data['result'] = new Persons();
            } else {
                $data = array(
                    'firstname' => $this->input->post('u_firstname'),
                    'surname' => $this->input->post('u_surname'),
                    'othernames' => $this->input->post('u_othernames'),
                    'birthdate' => $this->input->post('u_birthdate'),
                    'gender' => $this->input->post('u_gender'),
                    'email' => $this->input->post('u_email'),
                    'telephone' => $this->input->post('u_telephone'),
                    'biodata' => $this->input->post('u_biodata'),
                    'avatar' => $this->input->post('u_avatar')
                );
                if ($this->persons_model->is_unique('email', $data['email'])) {

                    $the_person_id = $this->persons_model->add($data);
                    $this->data['result'] = $this->persons_model->get('id = ' . $the_person_id, 1);
                    // Update the $msg variable

                    $msg .= "<li>The profile details were added successfully.</li>";
                } else {
                    // Update the $msg variable
                    $msg .= 'An Error Occured';
                    $msg .= "<li>The email address specified is already in use in the system.</li>";
                    //return maching information to the user to allow the user to fill/modify his inputs
                    $this->data['result'] = $this->persons_model->get('email = "' . $data['email'] . '"', 1);
                }
            }
            $msg .= "</ul>";
            // Prepare the data for the page
            $this->data['title'] = 'Add a Personal Profile';
            $this->data['view'] = 'persons/edit';
            $this->data['msg'] = $msg;


            // Load the view
            $this->load->view('main_template', $this->data);
        } else {
            $this->data['title'] = 'Add a Personal Profile';
            $this->data['view'] = 'persons/add';
            $this->data['msg'] = "<p>Please add the below information to add a new personal profile:-</p><ul>";
            ;

            //create new instance of person...enforce code reuse of the view

            $this->data['result'] = new Persons();
            // Load the view
            $this->load->view('main_template', $this->data);
        }
    }

    function edit() {

        /*         * ************** BASIC PERSON DETAILS *************************** */
        // Let's set form validation config file for the person details
        $person_details_validation_config = array(
            array(
                'field' => 'u_firstname',
                'label' => 'First Name',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'u_surname',
                'label' => 'Surname',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'u_othernames',
                'label' => 'Other Name(s)',
                'rules' => 'trim'
            ),
            array(
                'field' => 'u_email',
                'label' => 'Email',
                'rules' => 'trim|valid_email|callback_email_check'
            ),
            array(
                'field' => 'u_telephone',
                'label' => 'Telephone',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'u_biodata',
                'label' => 'Biodata',
                'rules' => 'trim'
            )
        );
        // Load the form validation library
        $this->load->library('form_validation');

        // Set the validation delimiters
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        // Load the validation configuration
        $this->form_validation->set_rules($person_details_validation_config);

        if ($this->form_validation->run() == false) {
            // Return the error(s) encountered
            $msg = "<p>The following notice(s) / error(s) were noted:-</p><ul>";
            $msg.= (validation_errors() ? validation_errors() : false);
        } else {
            $data = array(
                'firstname' => $this->input->post('u_firstname'),
                'surname' => $this->input->post('u_surname'),
                'othernames' => $this->input->post('u_othernames'),
                'birthdate' => $this->input->post('u_birthdate'),
                'gender' => $this->input->post('u_gender'),
                'email' => $this->input->post('u_email'),
                'telephone' => $this->input->post('u_telephone'),
                'biodata' => $this->input->post('u_biodata'),
                'avatar' => $this->input->post('u_avatar')
            );

            if ($this->persons_model->edit($data, 'id', $this->input->post('id')) == TRUE) {
                // Update the $msg variable
                $msg .= "<li>Your profile details were updated successfully.</li>";
                redirect(base_url() . 'persons/manage/');
            } else {
                $msg .= 'An Error Occured';
            }
        }
        $msg .= "</ul>";
        // Prepare the data for the page
        $this->data['title'] = 'Edit a Personal Profile';
        $this->data['view'] = 'persons/edit';
        $this->data['msg'] = is_null($msg) ? $msg : $msg = "";

        $this->data['result'] = $this->persons_model->get('id = ' . $this->uri->segment(3), 1);
        //$this->data['result'] = $this->persons_model->get('id = ' . $the_person_id, 1, 0, true);
        // Load the view
        $this->load->view('main_template', $this->data);
    }

    function view() {
        /*         * ************** BASIC PERSON DETAILS *************************** */

        // Prepare the data for the page
        $this->data['title'] = 'view a Personal Profile';
        $this->data['view'] = 'persons/view';

        $this->data['result'] = $this->persons_model->get('id = ' . $this->uri->segment(3), 1);
        // Load the view
        $this->load->view('main_template', $this->data);
    }

    function delete() {
        $ID = $this->uri->segment(3);
        $this->persons_model->delete('id', $ID);
        redirect(base_url() . 'persons/manage/');
    }

}

/* End of file persons.php */
/* Location: ./system/application/controllers/persons.php */