/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $('#srch_btn').click(function() {
        var inp = $('#srch_val').val();
        window.location.href = base_url+'book/search/'+inp;
      
    });
    
    $('#srch_val').keyup(function(e) {
        var inp = $('#srch_val').val().trim();
        var key = e.which || e.keyCode;
        
        if(key===13)
            $('#srch_btn').click();
        
        var urls  = base_url+'book/srch_sugg';
        urls      = base_url+'json/books_json.json';
        var fmdt  = new FormData();
        fmdt.append('srch_val',inp);
        
        if(inp !== "")
            $.ajax({
                        url: urls,  
                        dataType: 'text',  
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: fmdt,                         
                        type: 'post',
                        error:function() {
                              $('.srchHolder').fadeIn();
                              $('.shInner').html("error");
                        },
                        success:function (p) {
                            $('.shInner').html('');
                            $('.srchHolder').fadeIn();
                            var js_ob = JSON.parse(p);
                            no_res = 0;
                            $.each(js_ob.all_books, function(i, v) {
                                
                                tar_book_name= v.b_name.toLowerCase();
                                var tar_srch = new Array();
                                split_srch   = inp.split(" ");
                                c = -1;
                                for(i=0;i<split_srch.length;i++){
                                    
                                    sep_inp_text = split_srch[i];
                                    tar_srch[c++]  = v.b_name.toLowerCase().indexOf(sep_inp_text);
                                    tar_srch[c++]  = v.b_author.toLowerCase().indexOf(sep_inp_text);
                                    tar_srch[c++]  = v.b_amount.toLowerCase().indexOf(sep_inp_text);
                                    tar_srch[c++]  = v.b_desc.toLowerCase().indexOf(sep_inp_text);
                                    
                                }
                                
                                for(b in tar_srch){
                                    if(tar_srch[b]>-1){
                                        no_res = 1;
                                        html_cont = '<div class="sh_item">\
                                                        '+tar_book_name+'\
                                                     </div>';
                                        $('.shInner').append(html_cont);
                                        
                                        break;
                                    }
                                }
                                 
                                 return;
                            });
                                if(no_res === 0){
                                    html_cont = '<div class="sh_item" style="color:crimson">\
                                                    No Book\
                                                 </div>';
                                    $('.shInner').html(html_cont);
                                }
                
                        }
                     
        });
        else
            $('.srchHolder').fadeOut();
           
    });

    $('#srch_val').blur(function() {
        $('.srchHolder').fadeOut();
    });
      // search succrss func from db
      /*
        success: function(p){
                            $('.srchHolder').fadeIn();
                            var js_ob = JSON.parse(p);

                            $('.shInner').html('');
                            if(js_ob.data.length===0)
                                $('.shInner').html('<div class="sh_item" style="color:crimson">\
                                                                    No Books\
                                                                </div>');
                            else
                                 for(i=0;i<js_ob.data.length;i++){
                                     var b_names =  js_ob.data[i].b_name;
                                     html_cont = '<div class="sh_item">\
                                                                        '+b_names+'\
                                                                    </div>';
                                     $('.shInner').append(html_cont);
                                 }

                        }
       */