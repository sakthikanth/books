<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('login_userid')){
   function login_userid(){
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('user_id');
    if (!isset($user)) { return NULL; } else { return $user; }
   }
}

if ( ! function_exists('login_username')){
   function login_username(){
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('user_name');
    if (!isset($user)) { return NULL; } else { return $user; }
   }
}

if( !function_exists('b_url')){
    function b_url() {
        echo base_url();
    }
}
