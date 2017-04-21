<!-- header start -->
<script>base_url='<?php echo base_url() ?>';</script>
<link rel="stylesheet" href="<?php echo base_url() ?>css/header.css" />
<div class="page_header">
    <div class="header_inner">
        <div class="head_item">
            <a href="<?php echo base_url().'book/'; ?>show_books"> Browse Books  </a>
        </div>
        <div class="head_item">
            <input type="text" id="srch_val" placeholder="Search Book" />
            
            <span id="srch_btn">Search</span>
            <div class="srchHolder" style="display: none">
                <div class="shInner">
                </div>
            </div>
            
        </div>
        <div class="head_item">
            <a href="<?php echo base_url().'book/'; ?>add_book"> Add Book </a>
        </div>
        <div class="head_item">
            <?php if(login_username()!=NULL) echo login_username(); ?>
        </div>
        <a href="<?php echo base_url().'book/'; ?>logout">
            <div class="head_item">
            Logout
            </div>
        </a>
    </div>
</div>
<script src="<?php echo base_url().'js/header.js' ?>">
</script>
<!-- header over -->
