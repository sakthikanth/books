<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Welcome to Road Map</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/login_page.css">

        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

        <script type="text/javascript">
        var global_random ="";
             $(document).ready(function(){
                  //alert();
                  var fmdt = new FormData();
                  var random = Math.random();
                  global_random = random+"";

                  fmdt.append("test",1);


                  var url = "http://localhost:9000/get_login_sts/get_hash";
                  $.ajax({

                       url: url,
                       dataType: 'text',
                       cache: false,
                       crossDomain: true,
     			   xhrFields: {
     				  withCredentials: true
     			   },
                       contentType: false,
                       processData: false,
                       type: 'post',
                       data:fmdt,
                       success:function(r){
                            console.log(r);
                            set_session(r,random);
                       },
                       error:function(r){

                            alert("e :"+r);


                       }
                  });

             });


             function set_session(hash_key,rand){
                  if(global_random != rand)
                    {
                         global_random = "";
                         return;
                    }else{
                         var app_login_url = "/app_login/set_session";
                         var form_data = new FormData();
                         form_data.append('hash',hash_key);
                         form_data.append('random',rand);
                         $.ajax({

                              url: app_login_url,
                              dataType: 'text',
                              cache: false,
                              contentType: false,
                              processData: false,
                              data: form_data,
                              type: 'post',
                              success:function(r){
                                   if(r == "ok"){
                                             //window.location.href = '';
                                   }

                              },
                              error:function(r){
                                   //$('.login_resp').html(r.status);

                              }
                         });
                    }


             }

        </script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

   </head>
   <body class="">
        <div class="page_container">
                <div class="formHoldr">
                    <div class="Twims_title">
                        <div class="Twim_text"> Login </div>
                    </div>


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
                                        <div id="login_res">
                                            <?php echo validation_errors();
                                            if(isset($login_sts)){
                                                echo $login_sts;
                                            }
                                            ?>
                                        </div>
                                        <button id="subt_btn">Sign In</button>
                                    </div>
                                </div>

                                <div class="inP_container" style="color: red">
                                </div>
                                <div class="inP_container">
                                      <span style="color: crimson">  </span>
                                </div>
                                <div class="inP_container" id="signup_cont">
                                    <a href="<?= base_url(); ?>book/signup"> <div  style="display: inline-block;cursor: pointer">Sign Up</div></a>
                                </div>

                            </div>

                </div>
        </div>
        <script type="text/javascript">
             <?php if(isset($app_id)){

                  echo "var app_id = ".$app_id.";";

             } ?>
        </script>
       <script src="<?= base_url(); ?>js/login_page.js"></script>
       <script src="<?= base_url(); ?>js/hashes.js" charset="utf-8"></script>
       <script src="<?= base_url(); ?>js/auth_user.js" charset="utf-8"></script>
    </body>
</html>
