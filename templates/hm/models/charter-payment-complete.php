<?php

// 前台
require(SYSBASE."common/front.php");


require(getFromTemplate("common/header.php", false)); ?>

<section id="page">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content" class="pt30 pb30">
        <div class="container">

            <div class="alert alert-success"><?php echo $texts['CHECK_PAYMENT_COMPLETE_MSG']; ?></div>
        </div>
    </div>
</section>
