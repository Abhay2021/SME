<?php
/**
 * API MODEL
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class SmeModel extends CI_Model {
    private $client_service = "frontend-client";
    private $auth_key       = "smeRestapi";
    
   public function __construct(){
		parent::__construct();
		$this->load->database();	
	}

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function get_experts_data($data=NULL)
    {   
        /* select all details related to experts */
        $this->db->select('*');
        $this->db->from('experts');
        /*getting details of particular expert */
        if(isset($data['id']))
        {
          return  $this->db->where('id', $data['id'])->get()->row(0);
        }
        else 
        {
            /*matching Search word with name and sector*/  
            if(isset($data['search']) && $data['search']!='')
            { 
                $this->db->like('name', $data['search']);
                $this->db->or_like('sector', $data['search']);
            }

            /*filter for sector */
            if(isset($data['sector']) && $data['sector']!='')
            {
                $this->db->where('sector', $data['sector']);
            }

            /*filter for availability */
            if(isset($data['availability']) && $data['availability']!='')
            {
                $this->db->where('availability', $data['availability']);
            }

            /*filter for industry or academia */
            if(isset($data['industry_academia']) && $data['industry_academia']!='')
            {
                $this->db->where('industry_academia', $data['industry_academia']);
            }

            /*filter for Location */
            if(isset($data['country']) && $data['country']!='')
            {
                $this->db->where('country', $data['country']);
            }
               
            /*Limit data for 15 rows at one time */
            if(isset($data['limit']) && $data['limit']!='')
                { $return['start']=$data['limit']+1;
                $query = $this->db->limit(15,$data['limit'])->get();
                }else{ $return['start'] = 1;
                    $query = $this->db->limit(15,0)->get();
                }

                $return['data'] = $query->result();
                $return['result_count'] = $query->num_rows();
                
            /* Remove limit from above query to get total number of results*/ 
            $query0 = $this->db->last_query();
            $query0 = preg_replace('/LIMIT(.*)15/','',$query0);
            $qu = $this->db->query($query0);
            $return['total'] = $qu->num_rows();
            /* Total number of results in query */
            return $return;
        }

    }

    /* Fetching all country name  */
    public function get_country(){
        $res = $this->db->distinct()->select('country')->get('experts')->result_array();
       return array_column($res,"country");
    }

    /* Fetching all sector name  */
    public function get_sector(){
        $res = $this->db->distinct()->select('sector')->get('experts')->result_array();
        return array_column($res,"sector");
    }

    /* Fetching all experts name  */
    public function get_name(){
        $res = $this->db->select('name')->get('experts')->result_array();
        return array_column($res,"name");
    }

    public function submit_quote_request($data=NULL){
        
            $expert_id = $data['id'];
            $name = $data['name'];
            $email = $data['email'];
            $detail = $data['detail'];

            $quote = array(
                            'table'=>'quote_request',
                            'val'=>array(
                                    'expert_id'=>$expert_id,
                                    'client_name'=>$name,
                                    'email'=>$email,
                                    'project_details'=>$detail
                            ));
            $this->db->insert($quote['table'],$quote['val']);
            $id= $this->db->insert_id();

            if($id){
                $msg= "Request submitted successfully";
            }else{
                $msg= "Oops! something went wrong. Please try again";
            }
        
        return $msg;
    }

}
