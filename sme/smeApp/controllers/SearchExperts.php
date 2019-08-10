<?php
/**
 * CONTROLLER FOR SUBJECT MATTER EXPERT FRONTEND PAGE
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchExperts extends CI_Controller {

	public function index()
	{   $url = base_url("experts");
        $data['ex'] = $this->connect_api($url);
        $this->load->view('header');
        $this->load->view('searchBoard',$data);
		$this->load->view('footer');
    }
    
    public function connect_api($url=NULL)
    {   $data = $_POST; 
        if(!$data){$data=NULL;}
        if(!$url){$url=$_GET['urlapi'];}
        //  print_r($url);
       //  print_r($data);exit;
        $curl = curl_init();
        $client_service = "frontend-client";
        $auth_key       = "smeRestapi";
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true, 
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "Client-Service:$client_service",
            "Auth-Key: $auth_key"
        ),
        ));

        $response = curl_exec($curl);
        
        $err = curl_error($curl); //if($err){print_r($err);}
        curl_close($curl);
        if($response)
        { 
            //  echo "<pre>";
            //  print_r($response);exit; 
            if(!$data){return json_decode($response, true);}
            else{ echo $response;}
        }else{
        return FALSE;
        }
    }

}
