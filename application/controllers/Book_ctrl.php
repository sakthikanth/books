<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_ctrl
 *
 * @author Sakthikanth J
 */
class Book_ctrl extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        
        if(login_userid() == NULL)
            redirect ('./book/login');
        
    }
    
    public function add_book_page() {
        $this->load->view('AddBook_view');
    }
    
    public function check_book_form() {
        
        $this->form_validation->set_rules('book_name','Book Name','trim|required|min_length[1]|max_length[300]');
        $this->form_validation->set_rules('auth_name','Author Name','trim|required|min_length[1]|max_length[300]');
        $this->form_validation->set_rules('book_amt','Book Amount Name','trim|required|min_length[1]|max_length[300]|numeric');
        $this->form_validation->set_rules('book_desc','Book Description','trim|required|min_length[1]|max_length[300]');
       // $this->form_validation->set_rules('book_image','Book Image','required');
        
        if($this->form_validation->run()==TRUE){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    public function add_book_item() {
        
        if($this->check_book_form()==TRUE){
            
            $bookName   = $this->input->post('book_name');
            $bookAuth   = $this->input->post('auth_name');
            $bookAmount = $this->input->post('book_amt');
            $bookDesc   = $this->input->post('book_desc');
         
            $config['upload_path']   = './uploads';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 10000;
            $config['max_width']     = 10024;
            $config['max_height']    = 1768;

            $this->load->library('upload', $config);
            if(login_userid()!=NULL){
             
                if ( ! $this->upload->do_upload('book_image')){
                        $error = array('error' => $this->upload->display_errors());
                        $data = array('upload_data' => array());
                        $form_data['upload_err'] = $error;
                        
                        $this->load->view('AddBook_view',$form_data);
                }
                else{
                        $data = array('upload_data' => $this->upload->data());
                        $book_data=array();
                        $book_data[0] = $bookName;
                        $book_data[1] = $bookAuth;
                        $book_data[2] = $bookAmount;
                        $book_data[3] = $bookDesc;
                        $book_data[4] =  "./".$data['upload_data']['file_name'];
                        $book_data[5] = login_userid();
                        
                        $param        = $book_data;
                        $books_array[]  = array(
                            'b_name'  => $param[0],
                            'b_author'=> $param[1],
                            'b_amount'=> $param[2],
                            'b_desc'  => $param[3],
                            'b_image' => $param[4]

                             );
                              
                        if($this->Book_models->add_books($book_data)){
                            
                            $filename ="json/books_json.json";
                            $mode     = 0777;
                            if( !is_dir("json")){
                                mkdir("json");
                            }
                            
                            $json_file  = file_get_contents(base_url()."".$filename);
                            if($json_file != ""):

                                $json_old_arr  = ($json_file != "") ? json_decode($json_file) : array();
                                $new_json_arr  = get_object_vars($json_old_arr);
                                $new_json_arr['all_books'][] = $books_array[0];
                                file_put_contents($filename, json_encode($new_json_arr));
                            else:
                                $new_json_arr = array('all_books' => $books_array);
                                file_put_contents($filename, json_encode($new_json_arr));
                            endif;
                               
                                $form_data['add_sts'] = "Added Successfuly";
                                $this->load->view('AddBook_view', $form_data);
                        }else{
                            $form_data['add_sts'] = "Error to Add Book";
                            $this->load->view('AddBook_view', $form_data);
                        }
                        
                }
                
            }else{
                 $form_data['add_sts'] = "No User id";
                 $this->load->view('AddBook_view', $form_data);
            }
            
        }else{
             $this->load->view('AddBook_view');
        }
    }
    
    public function show_books() {
        $book_row = $this->Book_models->get_all_books();
        $book_data['data'] = $book_row;
        $this->load->view('Showbook_view',$book_data);
    }
    
    public function search_book() {
        $srch_word = $this->uri->segment(3);
        $book_row  = $this->Book_models->search_book($srch_word);
      
        $data['data'] = $book_row;
        $this->load->view('Showbook_view',$data);
        
    }
    
    public function srch_sugg() {
        $srch_word = $this->input->post('srch_val');
        $book_row  = $this->Book_models->search_book(trim($srch_word));
        
        $data['data'] = $book_row;
        echo json_encode($data);
    }
    
    public function edit() {
        
        $book_id  = $this->uri->segment(3);
        $book_row = $this->Book_models->get_single_book($book_id);
        $json_id  = $this->uri->segment(4);
        $data['book_data'] = $book_row; 
        $data['json_id']   = $json_id;
        $this->load->view('Editbook_view',$data);
        
    }
    
    public function edit_book() {
        
        if($this->check_book_form() == TRUE){
            
            $bookName   = $this->input->post('book_name');
            $bookAuth   = $this->input->post('auth_name');
            $bookAmount = $this->input->post('book_amt');
            $bookDesc   = $this->input->post('book_desc');
            $book_id    = $this->uri->segment(3);
            $file_name  = (!empty($_FILES['book_image'])) ? $_FILES['book_image']['name'] : "";
            
            $json_id    = $this->uri->segment(4);
            
            if($file_name != ""){
                $config['upload_path']   = './uploads';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 10000;
                $config['max_width']     = 10024;
                $config['max_height']    = 1768;
            
            $this->load->library('upload', $config);
            $this->upload->do_upload('book_image');
            $data = array('upload_data' => $this->upload->data());
            }
           
            if(login_userid()!= NULL){
             
                        $single_book = $this->Book_models->get_single_book($book_id);
                        
                        $old_image  = $single_book[0]->b_image;
                        
                        $book_data    = array();
                        $book_data[0] = $bookName;
                        $book_data[1] = $bookAuth;
                        $book_data[2] = $bookAmount;
                        $book_data[3] = $bookDesc;
                        $book_data[4] = ($file_name != "") ? "./".$data['upload_data']['file_name'] : $old_image;
                        $book_data[5] = login_userid();
                        $book_data[6] = $book_id;
                        
                        if($this->Book_models->update_book($book_data)){
                            
                            $single_book     = $this->Book_models->get_single_book($book_id);
                            
                            $this->json_update($book_data,$json_id);
                            
                            $form_data['add_sts']   = "Updated Successfully";
                            $form_data['book_data'] = $single_book;
                            $form_data['json_id']   = $json_id;
                            $this->load->view('Editbook_view', $form_data);
                        }else{
                            
                            $data['add_sts']   = "Error to Add Book";
                            $data['book_data'] = $single_book;
                            $this->load->view('Editbook_view', $data);
                        }
                       
            }else{
                 $form_data['add_sts']   = "No User id";
                 $form_data['book_data'] = $single_book;
                 $form_data['json_id']   = $json_id;
                 $this->load->view('Editbook_view', $form_data);
            }
        }
    }
    
    public function delete_book(){
        
        $book_id = $this->uri->segment(3);
        $json_id = $this->uri->segment(4);
        $del     = $this->Book_models->delete_book($book_id);
        if($del){
            //json delete
            $filename      = "json/books_json.json";
            $json_file     = file_get_contents(base_url()."".$filename);
            $json_old_arr  = ($json_file != "") ? json_decode($json_file) : array();

            $new_json_arr  = get_object_vars($json_old_arr);
            unset($new_json_arr['all_books'][$json_id]);
            
            $new_arr = array();
            foreach ($new_json_arr['all_books'] as $key => $value) {
                $new_arr[] =$value;
            }
            $tot_arr['all_books'] = $new_arr;
            
            file_put_contents($filename, json_encode($tot_arr));   
            // end json delete
            redirect(base_url());
        }
    }
    
    public function json_update($Book_data,$json_id) {
        
            $param          = $Book_data;
            $books_array[]  = array(
                            'b_name'  => $param[0],
                            'b_author'=> $param[1],
                            'b_amount'=> $param[2],
                            'b_desc'  => $param[3],
                            'b_image' => $param[4]
                    
                             );
            $filename        = "json/books_json.json";
            $json_file       = file_get_contents(base_url()."".$filename);
            $json_old_arr    = ($json_file != "") ? json_decode($json_file) : array();

            $new_json_arr    = get_object_vars($json_old_arr);
            $new_json_arr['all_books'][$json_id] = $books_array[0];

            file_put_contents($filename, json_encode($new_json_arr));
            
    }
}
