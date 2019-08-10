<?php
/**
 * RESfulAPI 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Sme extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SmeModel');
	}
/******************** Getting all data****************/
	public function index()
	{  
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			
			$check_auth_client = $this->SmeModel->check_auth_client();
			
			if($check_auth_client == true){
				
				$respStatus = 200;
				$resp['experts'] = $this->SmeModel->get_experts_data();
				$resp['country'] = $this->SmeModel->get_country();
				$resp['sector'] = $this->SmeModel->get_sector();
				$resp['name'] = $this->SmeModel->get_name();
			//print_r($resp);exit;
				json_output($respStatus,$resp);
			}
		}
	}

	/******************** Getting filtered data****************/
	public function get_experts()
	{  
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			
			$check_auth_client = $this->SmeModel->check_auth_client();
			
			if($check_auth_client == true){
				/* getting all input data for search and filter */
				//$params = json_decode(file_get_contents('php://input'), TRUE);
				$params = $_POST;
				if(!$params){
					$params = NULL;
				}
				$respStatus = 200;
				$resp = $this->SmeModel->get_experts_data($params);

				json_output($respStatus,$resp);
			}
		}
	}
	
	/******************** submit request for quote****************/
	public function submit_request_for_quote()
	{  
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			
			$check_auth_client = $this->SmeModel->check_auth_client();
			
			if($check_auth_client == true){
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('detail', 'Project details', 'required');
				$this->form_validation->set_rules('id', 'Expert id', 'required');
				if ($this->form_validation->run() == FALSE)
				{
					$msg = validation_errors();
					$respStatus = 400;
					json_output($respStatus,$msg);
				}
				else
				{  
					/* getting all input data*/
					$params = $this->input->post();
					if(!$params){
						$params = NULL;
					}
					$respStatus = 200;
					$resp = $this->SmeModel->submit_quote_request($params);

					json_output($respStatus,$resp);
				}  
			}
		}
	}
	
}
