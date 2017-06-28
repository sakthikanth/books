/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
 
  chng=0;
    $('#user_name').keyup(function(){
                     $('#user_name').css('border-bottom','1px solid #8e24aa');

       var inP_txt=$('#user_name').val();
       if(inP_txt.length>0 && chng===0){
           chng=1;
        $('#user_nm_ph').css('width','0px').fadeIn().animate({width: "+=130px"},250,function (){
                console.log("chnaging");
        });   
       }else{
           if(inP_txt.length===0){
                      $('#user_nm_ph').fadeOut();
                       $('#user_name').css('border-bottom','1px solid red');

    chng=0;
           }
       }
        
        
    });
    $('#user_name').focusout(function(){
        chng=0;
       
        
    });
   
  $('#pers_name').keyup(function(){
                     $('#pers_name').css('border-bottom','1px solid #8e24aa');

       var inP_txt=$('#pers_name').val();
       if(inP_txt.length>0 && chng===0){
           chng=1;
        $('#pers_nm_ph').css('width','0px').fadeIn().animate({width: "+=130px"},250,function (){
                console.log("chnaging");
        });   
       }else{
           if(inP_txt.length===0){
                      $('#pers_nm_ph').fadeOut();
                       $('#pers_name').css('border-bottom','1px solid red');

    chng=0;
           }
       }
        
        
    });
    $('#pers_name').focusout(function(){
        chng=0;
       
        
    });
   
        $('#pass_word').keyup(function(){
                         $('#pass_word').css('border-bottom','1px solid #8e24aa');

         var inP_txt=$('#pass_word').val();
       if(inP_txt.length>0 && chng===0){
           chng=1;
        $('#pass_wd_ph').css('width','0px').fadeIn().animate({width: "+=130px"},250,function (){
                console.log("chnaging");
        });
           
       }else{
           if(inP_txt.length===0){
                      $('#pass_wd_ph').fadeOut();
                                             $('#pass_word').css('border-bottom','1px solid red');

    chng=0;
           }
       }
        
    });
     $('#pass_word').focusout(function(){
         chng=0;
        
    });
    $('#mail_id').keyup(function(e){
        var key=e.which || e.keyCode;
        if(key===13){
             $('#fp_subt_btn').click();
        }
    });
    
    
   
 $(":file").change(function () {
            
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
           });
    
});

    function imageIsLoaded(e) {
        
        var dfgh=e.target.result.indexOf("image");
        
         $('#book_img').attr('src', e.target.result);
    }
