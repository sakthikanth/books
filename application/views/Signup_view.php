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
                    <div class="Twim_text"> Sign Up </div>
                </div>

                        <div class="login_container">
                            <div class="inP_container">
                                <div class="place_holder" id="pers_nm_ph" style="display: none;">
                                    Name
                                </div>
                                <div class="inp_holder">
                                    <input type="text" name="personName" id="pers_name" class="inp_txt_form" placeholder="Enter your name" value="">
                                </div>
                            </div>
                            <div class="inP_container">
                                <div class="place_holder" id="user_nm_ph" style="display: none;">
                                    Email ID
                                </div>
                                <div class="inp_holder">
                                    <input type="text" name="userName" id="email_id" class="inp_txt_form" placeholder="Enter Email ID" value="">
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
                            <div class="inP_container">
                                <div class="place_holder" id="pass_wd_ph" style="display: none;">
                                    Confirm Password
                                </div>
                                <div class="inp_holder">
                                    <input type="password" name="passWordConfirm" id="pass_word_confirm" class="inp_txt_form" placeholder="Confirm Password" value="">
                                </div>
                                   <input type="hidden" id="c_code" value="IND" name="country_code" />

                            </div>
                            <?php
                             $sts_cls="";
                             $redir_url="";
                            if(isset($signUP_res)){
                                if(($signUP_res)=='Successfully Signed up'){
                                    $sts_cls="class='succ_sts'";
                                    $redir_url="<script>window.location.href='./show_books';</script>";
                                }else{
                                    if(validation_errors()!=""){
                                    $sts_cls="class='err_sts'";
                                    }
                                }
                            }
                            if($sts_cls=="" && validation_errors()==""){
                               $sts_cls="class='hide_result'";
                            }

                            ?>
                            <div class="inP_container">
                                <div class="sign_in_holder">
                                    <div id="signup_result" <?php echo $sts_cls; ?>>
                                        <?php echo validation_errors();
                                        if(isset($signUP_res)){
                                            echo $signUP_res;
                                        }
                                        ?>
                                    </div>
                                    <button id="subt_btn">Sign Up</button>
                                </div>
                            </div>

                            <div class="inP_container" style="color: red">
                            </div>
                            <div class="inP_container">
                                  <span style="color: crimson">  </span>
                            </div>
                            <div class="inP_container" id="signup_cont">
                                <a href="./login"> <div style="display: inline-block;cursor: pointer" >Login</div></a>
                            </div>

                        </div>

            </div>

        </div>
           <?php echo $redir_url; ?>
           <script src="<?php echo base_url(); ?>js/login_page.js"></script>
           <script src="<?php echo base_url(); ?>js/auth_user.js"></script>

    </body>
</html>
