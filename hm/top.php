<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $row['title'] ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo strtrunc(strip_tags($row['text']), 155) ?>"/>
<meta itemprop="name" content="<?php echo $row['title_tag'] ?>">
<meta itemprop="description" content="<?php echo strtrunc(strip_tags($row['text']), 155) ?>">

<!-- Facebook and Twitter integration -->
<meta property="og:title" content="<?php echo $row['title_tag'] ?>"/>
<meta property="og:url" content="<?php echo url(1) ?>"/>
<meta property="og:site_name" content="<?php echo constant("SITE_TITLE"); ?>"/>
<meta property="og:description" content="<?php echo strtrunc(strip_tags($row['text']), 155) ?>"/>
<?php
if (isset($row2['file'])) { ?>
    <meta name="og:image" content="<?php echo $row2['file'] ?>">
    <?php
} ?>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="<?php echo $row['title_tag'] ?>">
<meta name="twitter:description" content="<?php echo strtrunc(strip_tags($row['text']), 155) ?>">
<meta name="twitter:creator" content="@author_handle">
<?php
if (isset($row2['file'])) { ?>
    <meta name="twitter:image:src" content="<?php echo $row2['file'] ?>">
    <?php
} ?>

<link rel="icon" type="image/png" href="/templates/default/images/favicon.png">


<link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700" rel="stylesheet">

<!-- Animate.css -->
<link rel="stylesheet" href="css/animate.css">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="css/icomoon.css">
<!-- Bootstrap  -->
<link rel="stylesheet" href="css/bootstrap.css">
<!-- Flexslider  -->
<link rel="stylesheet" href="css/flexslider.css">
<!-- Owl Carousel  -->
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<!-- Theme style  -->
<link rel="stylesheet" href="css/style.css">

<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

<!-- 选择日期 -->
<link rel="stylesheet" href="css/rendezvous.css">
<script src="js/jquery.min.js"></script>