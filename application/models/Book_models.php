<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book_models
 *
 * @author SakthiKanthan J
 */
class Book_models extends CI_Model{
    //put your code here
    public $user_table="users";
    public $books_table="books";
            
    
    function __construct() {
        parent::__construct();
    }
    public function signup_user($param) {
        $user_data=array(
                    'user_id'   => $param['userId'],
                    'p_name'    => $param['pName'],
                    'user_name' => $param['uName'],
                    'pass_word' => $param['pWord']
                   );
        $tbl = $this->user_table;
        if($this->db->insert($tbl,$user_data)==TRUE){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    public function login_check($u) {
        $tbl = $this->user_table;
        $q="select * from users where user_name='$u'";
        $query = $this->db->query($q);
        if($query->num_rows()>0){
            $row=$query->result();
            return $row;
        }else{
            return null;
        }
    }
    public function add_books($param) {
        
        $data=array(
            'b_name'  => $param[0],
            'b_author'=> $param[1],
            'b_amount'=> $param[2],
            'b_desc'  => $param[3],
            'b_image' => $param[4],
            'user_id' => $param[5]
            
             );
        $tbl = $this->books_table;
        
        if($this->db->insert($tbl,$data)){
            return TRUE;
        }else{
            return FALSE;
        }
                     
    }
    
    public function get_all_books() {
        $q = $this->db->get($this->books_table);
        return $q->result();
    }
    
    public function search_book($srch_word) {
        $srch_query = "select * from books where b_name regexp '$srch_word'";
         
        $q = $this->db->query($srch_query);
        if($q->num_rows()>0){
            return $q->result();
        }else{
            return array();
        }
                
    }
    
    public function get_single_book($book_id) {
        
        $q  = "select * from books where book_id = '$book_id'";
        $qn = $this->db->query($q);
        if($qn->num_rows()>0){
            return $qn->result();
        }else{
            return NULL;
        } 
    }
    
    public function check_userId($id) {
        
        $user_tbl = $this->user_table;
        $user_id  = array('user_id'=>$id);
       
        $query = $this->db->get_where($user_tbl,$user_id);
        if($query->num_rows($query)>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function update_book($param) {
        
        $data=array(
            'b_name'  => $param[0],
            'b_author'=> $param[1],
            'b_amount'=> $param[2],
            'b_desc'  => $param[3],
            'b_image' => $param[4],
            'user_id' => $param[5],
            'book_id' => $param[6],
            'last_upt_time' => ''
            
             );
        $book_tbl = $this->books_table;
        $book_id  = $param[6];   
        
        $this->db->set($data); 
        $this->db->where( array('book_id' => $book_id) ); 
        
        if($this->db->update($book_tbl, $data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function delete_book($book_id) {
        $book_tbl = $this->books_table;
        $where_id = array('book_id' => $book_id);
        if($this->db->delete($book_tbl,$where_id)==TRUE){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
