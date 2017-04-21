<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Welcome to Road Map</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/login_page.css">
       
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
   
   </head>
   <body class="">
        <div class="page_container">
                <div class="formHoldr">
                    <div class="Twims_title">
                        <div class="Twim_text"> Login </div>
                    </div>
                    <form action="<?php echo base_url(); ?>book/login_user" method="post">
                            <div class="login_container">

                                <div class="inP_container">
                                    <div class="place_holder" id="user_nm_ph" style="display: none;">
                                        Email ID
                                    </div>
                                    <div class="inp_holder">
                                        <input type="text" name="userName" id="user_name" class="inp_txt_form" placeholder="Enter Email ID" value="">
                                    </div>
                                </div>
                                <div class="inP_container">
                                    <div class="place_holder" id="pass_wd_ph" style="display: none;">
                                        Password
                                    </div>
                                    <div class="inp_holder">
                                        <input type="password" name="passWord" id="pass_word" class="inp_txt_form" placeholder="Password" value="">
                                    </div>

                                </div>

                                <?php
                                 $sts_cls='class="err_sts"';
                             if(validation_errors()==""){
                                 $sts_cls="class='hide_result'";
                             }
                             if(isset($login_sts)){
                                 if($login_sts!="Login Success"){
                                    $sts_cls='class="err_sts"';

                                 }
                             }

                                ?>
                                <div class="inP_container">
                                    <div class="sign_in_holder">
                                        <div id="signup_result" <?php  echo $sts_cls;?>>
                                            <?php echo validation_errors();
                                            if(isset($login_sts)){
                                                echo $login_sts;
                                            }
                                            ?>
                                        </div>
                                        <button>Sign In</button>
                                    </div>
                                </div>

                                <div class="inP_container" style="color: red">
                                </div>
                                <div class="inP_container">
                                      <span style="color: crimson">  </span>
                                </div>
                                <div class="inP_container" id="signup_cont">
                                    <a href="./signup"> <div style="display: inline-block;cursor: pointer">Sign Up</div></a>
                                </div>

                            </div>
                    </form>
                </div>
        </div>    
       <script src="<?= base_url(); ?>js/login_page.js"></script>
    </body>  
</html>