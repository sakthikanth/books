<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Welcome to Book Store</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php b_url() ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php b_url() ?>css/login_page.css">
        <link rel="stylesheet" href="<?php b_url() ?>css/add_bok.css">
        <link rel="stylesheet" href="<?php b_url() ?>css/show_book.css">
        
        <script src="<?php b_url() ?>js/jquery.min.js"></script>
        <script src="<?php b_url() ?>js/bootstrap.min.js"></script>
      
    </head>
   <body class="">
        <div class="page_container">
            <?php
            $this->load->view('header_view');
            ?>
            <div class="books_holder">
                <div class="bh_inner">
                    <?php
                    $n=-1;
                     foreach ($data as $key ) {
                         $n++;
                         ?>
                    
                    <div class="bh_item">
                        <div class="bhi_inn">
                            <div class="bhi_desc bhi_img_hold">
                                <img src="<?php b_url() ?>/uploads/<?php echo $key->b_image; ?>" alt="no image" class="bht_img"/>
                            </div>
                            <div class="bht_desc">
                                <?php echo $key->b_name;  ?>
                            </div>
                            <div class="bht_desc">
                                <span>Author  : </span>  <?php echo $key->b_author;  ?>
                            </div>
                            <div class="bht_desc">
                                <span>Amount  : Rs. </span>  <?php  echo $key->b_amount;  ?> /-
                            </div>
                            <div class="bht_desc">
                                <span>About    : </span> <?php  echo $key->b_desc;  ?>
                            </div>
                            <?php
                            if($key->user_id == login_userid() )
                            {
                            ?>
                           
                                <div class="bht_desc">
                                    <a href="<?= b_url(); ?>book/edit/<?php echo $key->book_id ?>/<?php echo $n; ?>"> <span> Edit  </span> </a>
                                    <a href="<?= b_url(); ?>book/delete/<?php echo $key->book_id ?>/<?php echo $n; ?>"> <span> Delete </span> </a>
                                </div>
                            
                            <?php
                            } ?>
                            
                        </div>
                    </div>
                        <?php
                     }
           
                    ?>
                    
                </div>
            </div>
            
        </div>    
          
       <script src="<?php b_url() ?>js/login_page.js"></script>
    </body>  
</html>