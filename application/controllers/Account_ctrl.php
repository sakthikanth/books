<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_ctrl
 *
 * @author SakthiKanth J
 */
class Account_ctrl extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();


           // redirect ('./book');
        $this->encryption->initialize(
        array(
                'cipher' => 'aes-256',
                'mode'   => 'ctr',
                'key'    => '<a 16-character random string>'
        )
        );
    }
    public function index(){

         if(login_userid() != "")
          redirect('./book');

        $app_id = $this->uri->segment(2);
         $data['app_id'] = $app_id;
         
        $this->load->view('Login_view',$data);
    }
    // signup start
    public function signup(){
        $this->load->view('Signup_view');
    }

    public function validate_signup_input(){

         $this->form_validation->set_rules('personName', 'Name', 'required');
         $this->form_validation->set_rules('userName', 'Username',  'trim|required|min_length[3]|max_length[20]|is_unique[users.user_name]');
         $this->form_validation->set_rules('passWord','Password','required|min_length[3]|max_length[20]');
         $this->form_validation->set_rules('passWord','Password Confirmation','required|min_length[3]|max_length[20]|matches[passWord]');

         if($this->form_validation->run()==true){
             return true;
         }else{
             return false;
         }

    }

    public function signup_user(){

        if($this->validate_signup_input()==TRUE){

            $personName = $this->input->post('personName');
            $userName   = $this->input->post('userName');
            $password   = $this->input->post('passWord');

            $encoded_password = $this->encryption->encrypt($password);
            $randUserId       = rand(00000000, 99999999);

            $userId_Avlbl = TRUE;

            while ($userId_Avlbl == TRUE){
                $randUserId       = rand(00000000, 99999999);
                $userId_Avlbl = $this->Book_models->check_userId($randUserId);
            }

                $user_data  = array('userId'=>$randUserId,'pName'=>$personName,'uName'=>$userName,'pWord'=>$encoded_password);

                if($this->Book_models->signup_user($user_data)){

                    $ses_data = array('user_id'=>$randUserId,'user_name'=>$personName);
                    $this->session->set_userdata($ses_data);

                    $data['signUP_res'] = "Successfully Signed up";
                    $this->load->view('Signup_view',$data);
                }else{
                    $data['signUP_res'] = "Error in Inserting user";
                    $this->load->view('Signup_view',$data);
                }

        }else{
                $data['signUP_res'] = "";
                $this->load->view('Signup_view',$data);
        }
    }
    // signup end

    // login start
    public function validate_login_input(){

        $this->form_validation->set_rules('userName', 'Username',  'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('passWord','Password','required|min_length[3]|max_length[20]');

         if($this->form_validation->run()==true){
             return true;
         }else{
             return false;
         }
    }
    public function login_user() {

        if($this->validate_login_input()==TRUE){

            $uname  = $this->input->post('userName');
            $upass  = $this->input->post('passWord');

            $user_row=($this->Book_models->login_check($uname));

            if($user_row!=null){

                $user_id    = $user_row[0]->user_id;
                $pass_word  = $user_row[0]->pass_word;
                $personName = $user_row[0]->user_name;

                $decodedPassword = $this->encryption->decrypt($pass_word);

                if($decodedPassword == $upass){
                    $ses_data = array('user_id'=>$user_id,'user_name'=>$personName);
                    $this->session->set_userdata($ses_data);

                    if(login_userid() != NULL){
                        $data['login_sts'] = "Login Success";
                        redirect(base_url().'book/show_books','refresh');
                    }else{
                        $data['login_sts'] = "Empty Session";
                        $this->load->view('Login_view',$data);
                    }

                }else{
                    $data['login_sts'] = "Incorrect Password";
                    $this->load->view('Login_view',$data);
                }

            }else{
                $data['login_sts'] = "No Such user";
                $this->load->view('Login_view',$data);
            }

        }else{
            $data['login_sts'] = "";
            $this->load->view('Login_view',$data);
        }
    }

    public function logout() {

        $this->session->unset_userdata('user_id');
        if(login_userid()==NULL){
            redirect (base_url()."book/login",'refresh');
        }

    }

}
