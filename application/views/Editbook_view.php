<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Welcome to Book Store</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/login_page.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/add_bok.css">
        
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        
    </head>
   <body class="">
        <div class="page_container">
            <?php
            $this->load->view('header_view');
            ?>
            <div class="formHoldr">
                <div class="img_holder">
                    <div class="ih_inner">
                        <img src="<?php echo base_url().'uploads/'.$book_data[0]->b_image; ?>" alt="no image" id="book_img" />
                    </div>
                </div>
                <form action="<?php echo base_url().'book/' ?>edit_book/<?php echo $book_data[0]->book_id; ?>/<?php echo $json_id; ?>" method="post" enctype="multipart/form-data">
                    <div class="addBookHolder">
                        <div class="ab_ttl_text">
                            <div>
                                Edit Book
                            </div>
                        </div>
                        <div class="ab_Inner">
                            <div class="ab_item">
                                <div>
                                Book Name
                                </div>    
                                <div>
                                    <input type="text" name="book_name" placeholder="Enter Book Name" value="<?php echo $book_data[0]->b_name; ?>"/>
                                </div>
                            
                            </div>
                       
                            <div class="ab_item">
                                <div>
                                    Author Name
                                </div>    
                                <div>
                                    <input type="text"  name="auth_name"  placeholder="Enter Author Name" value="<?php echo $book_data[0]->b_author; ?>"/>
                                </div>
                            
                            </div>
                     
                            <div class="ab_item">
                                <div>
                                    Amount
                                </div>    
                                <div>
                                    <input type="text" name="book_amt"  placeholder="Enter Book Amount" value="<?php echo $book_data[0]->b_amount; ?>"/>
                                </div>
                            
                            </div>
                        
                        
                            <div class="ab_item">
                                <div>
                                     Description
                                </div>    
                                <div>
                                    <input type="text" name="book_desc"  placeholder="Enter Book Description" value="<?php echo $book_data[0]->b_desc; ?>"/>
                                </div>
                            
                            </div>
                       
                            <div class="ab_item">
                                <div>
                                Upload Cover Photo
                                </div>    
                                <div>
                                    <input type="file" name="book_image"  />
                                </div>
                            
                            </div>
                            <?php
                            
                            $sts_cls = "err_sts";
                            
                            if(validation_errors()=="" && isset($add_sts) && $add_sts=="Updated Successfully"){
                                $sts_cls = "succ_sts";
                            }
                            
                            ?>
                            <div class="result_div <?php echo $sts_cls; ?>">
                                <?php 
                                echo validation_errors();
                                if(isset($upload_err)){
                                    foreach ($upload_err as $key => $value) {
                                        echo $value;
                                    }
                                }
                                if(isset($add_sts)){
                                    echo $add_sts;
                                }
                                
                                ?>
                            </div>
                    
                            <div class="ab_submit">
                                <div>
                                    <button>Submit</button>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            
        </div>    
        <script src="<?php echo base_url() ?>js/login_page.js"></script>
   </body>  


</html>