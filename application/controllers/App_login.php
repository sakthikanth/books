<?php



defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Origin: http://localhost:9000");

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, *");

class App_login extends CI_Controller {

	function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation','session'));
        $this->load->helper(array('form'));

	  $this->load->model('jwt_model');
    }
    function set_session(){

         $hash = $this->input->post('hash');
         $random = $this->input->post('random');


         $user_details = $this->jwt_model->decode_jwt_hash($hash);

	//     if($random == $user_details['rand_key']){
	// 	    //session_start();
	//
         //
	//     }
         $user_id = $user_details['user_id'];
        $this->session->set_userdata('user_id',$user_id);
        $this->session->set_userdata('username_admin','admin');
        echo "ok";



    }


}
