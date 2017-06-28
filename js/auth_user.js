

     function signup_sso() {

          var fullname = $('#pers_name').val();
          var password = $('#pass_word').val();
          var confirm_password = $('#pass_word_confirm').val();
          var email_id = $('#email_id').val();
          var country_code =$('#c_code').val();


          var formdata = new FormData();
          formdata.append('fullname',fullname);
          formdata.append('pass_word',password);
          formdata.append('pass_word_confirm',confirm_password);
          formdata.append('email_id',email_id);
          formdata.append('country_code',country_code);


               var app_login_url = "http://localhost:9000/sso_signup/signup_user";

               $.ajax({

                    url: app_login_url,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    type: 'post',
                    success:function(r){
                         $('#signup_result').html('');
                         console.log(r);
                         if( r.signUP_res == "Successfully Signed up"){
                              $('#signup_result').html(r.signUP_res).css('color','green');

                         }else{
                              $('#signup_result').html(r.signUP_res).css('color','crimson');

                         }


                    },
                    error:function(r){
                         $('.login_resp').html(r.status);

                    }
               });

     }

     $('#subt_btn').click(function() {

          signup_sso();
     });
