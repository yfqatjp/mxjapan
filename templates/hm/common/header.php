<?php debug_backtrace() || die ("Direct access not permitted"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title><?php echo $title_tag; ?></title>

    <?php
    if (isset($article)) $meta_descr = strtrunc(strip_tags($article['text']), 155);
    elseif ($page['descr'] != "") $meta_descr = $page['descr'];
    else $meta_descr = strtrunc(strip_tags($page['text']), 155); ?>

    <meta name="description" content="<?php echo $meta_descr; ?>">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo $title_tag; ?>">
    <meta itemprop="description" content="<?php echo $meta_descr; ?>">
    <?php
    if (isset($page_img)) { ?>
        <meta itemprop="image" content="<?php echo $page_img; ?>">
        <?php
    } ?>

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo $title_tag; ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo getUrl(); ?>">
    <?php
    if (isset($page_img)) { ?>
        <meta property="og:image" content="<?php echo $page_img; ?>">
        <?php
    } ?>
    <meta property="og:description" content="<?php echo $meta_descr; ?>">
    <meta property="og:site_name" content="<?php echo SITE_TITLE; ?>">
    <?php
    if (isset($publish_date) && isset($edit_date)) { ?>
        <meta property="article:published_time" content="<?php echo date("c", $publish_date); ?>">
        <meta property="article:modified_time" content="<?php echo date("c", $edit_date); ?>">
        <?php
    } ?>
    <?php
    if ($article_id > 0) { ?>
        <meta property="article:section" content="<?php echo $page['title']; ?>">
        <?php
    } ?>
    <?php
    if (isset($article_tags) && $article_tags != "") { ?>
        <meta property="article:tag" content="<?php echo $article_tags; ?>">
        <?php
    } ?>
    <meta property="article:author" content="<?php echo OWNER; ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo $title_tag; ?>">
    <meta name="twitter:description" content="<?php echo $meta_descr; ?>">
    <meta name="twitter:creator" content="@author_handle">
    <?php
    if (isset($page_img)) { ?>
        <meta name="twitter:image:src" content="<?php echo $page_img; ?>">
        <?php
    } ?>

    <meta name="robots" content="<?php if ($page['robots'] != "") echo $page['robots']; else echo "index, follow"; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/images/favicon.png">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?php
    if (RTL_DIR) { ?>
        <link rel="stylesheet"
              href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">
        <?php
    } ?>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700">

    <?php
    //CSS required by the current model
    if (isset($stylesheets)) {
        foreach ($stylesheets as $stylesheet) { ?>
            <link rel="stylesheet" href="<?php echo $stylesheet['file']; ?>"
                  media="<?php echo $stylesheet['media']; ?>">
            <?php
        }
    } ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/js/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/css/shortcodes.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/js/plugins/wow/animate.min.css"/>
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/js/plugins/prettyPhoto/prettyPhoto.css"/>
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/layout.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/colors.css"); ?>" id="colors">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/main.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/custom-meixi.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/elegant-icon-meixi.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/style-meixi.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/fontello-codes.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/font-awesome.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/icomoon.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/animate.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/flexslider.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/owl.carousel.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/owl.theme.default.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/rendezvous.css"); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate("css/hm.css"); ?>">
    <!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">-->

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
    <script src="<?php echo DOCBASE; ?>common/js/modernizr-2.6.1.min.js"></script>
    <script src="<?php echo DOCBASE; ?>common/js/plugins/wow/wow.min.js"></script>
    <script src="<?php echo DOCBASE; ?>js/fotorama.js"></script>
    <script src="<?php echo getFromTemplate("js/modernizr-2.6.2.min.js"); ?>"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="<?php echo getFromTemplate("js/respond.min.js");?>"></script>
    <![endif]-->



    <script src="<?php echo DOCBASE; ?>common/js/plugins/prettyPhoto/jquery.prettyPhoto.init.min.js"></script>
    <script src="<?php echo DOCBASE; ?>common/js/plugins/prettyPhoto/jquery.prettyPhoto.js"></script>


    <script>
        Modernizr.load({
            load: [
                '<?php echo DOCBASE; ?>js/bootstrap.js',
                '<?php echo DOCBASE; ?>js/bootstrap-datepicker.js',
                '<?php echo DOCBASE; ?>js/bootstrap-select.js',
                '<?php echo DOCBASE; ?>js/bootstrap-timepicker.js',
//                '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
                '<?php echo DOCBASE; ?>js/plugins/respond/respond.min.js',
                '//code.jquery.com/ui/1.11.4/jquery-ui.js',
                <?php if(LANG_TAG != "en") : ?>'//rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-<?php echo LANG_TAG; ?>.js',<?php endif; ?>
                '<?php echo DOCBASE; ?>js/plugins/jquery-cookie/jquery-cookie.js',
                '<?php echo DOCBASE; ?>js/plugins/strftime/strftime.min.js',
                '<?php echo DOCBASE; ?>js/plugins/easing/jquery.easing.1.3.min.js',
                '<?php echo DOCBASE; ?>common/js/plugins/magnific-popup/jquery.magnific-popup.min.js',
                //Javascripts required by the current model
                <?php if (isset($javascripts)) foreach ($javascripts as $javascript) echo "'" . $javascript . "',\n"; ?>

                '//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js',
                '<?php echo DOCBASE; ?>js/plugins/imagefill/js/jquery-imagefill.js',
                '<?php echo DOCBASE; ?>js/plugins/toucheeffect/toucheffects.js',
                '<?php echo DOCBASE; ?>common/js/waypoints.min.js',

            ],
            complete: function () {
                Modernizr.load('<?php echo DOCBASE; ?>common/js/custom.js');
                Modernizr.load('<?php echo DOCBASE; ?>js/custom.js');
            }
        });

        $(function () {
            <?php
            if(isset($msg_error) && $msg_error != ""){ ?>
            var msg_error = '<?php echo preg_replace("/(\r\n|\n|\r)/", "", nl2br(addslashes($msg_error))); ?>';
            if (msg_error != '') $('.alert-danger').html(msg_error).slideDown();
            <?php
            }
            if(isset($msg_success) && $msg_success != ""){ ?>
            var msg_success = '<?php echo preg_replace("/(\r\n|\n|\r)/", "", nl2br(addslashes($msg_success))); ?>';
            if (msg_success != '') $('.alert-success').html(msg_success).slideDown();
            <?php
            }
            if (isset($field_notice) && !empty($field_notice))
                foreach ($field_notice as $field => $notice) echo "$('.field-notice[rel=\"" . $field . "\"]').html('" . $notice . "').fadeIn('slow').parent().addClass('alert alert-danger');\n"; ?>
        });

        <?php echo stripslashes(ANALYTICS_CODE); ?>

        function show_hide_row(row) {
            $("#" + row).toggle();
        }
    </script>

    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700" rel="stylesheet">

    <!-- Modernizr JS -->
    <script src="/hm/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="/hm/js/respond.min.js"></script>
    <![endif]-->

    <!-- 选择日期 -->
    <link rel="stylesheet" href="/hm/css/rendezvous.css">
    <!-- 选择地区 -->
    <script src="/hm/js/common.js"></script>

</head>
<body id="page-<?php echo $page_id; ?>" itemscope
      itemtype="http://schema.org/WebPage"<?php if (RTL_DIR) echo " dir=\"rtl\""; ?>>
<?php
if (ENABLE_COOKIES_NOTICE == 1 && !isset($_COOKIE['cookies_enabled'])) { ?>
    <div id="cookies-notice">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $texts['COOKIES_NOTICE']; ?>
                    <button class="btn btn-success btn-xs">OK</button>
                </div>
            </div>
        </div>
    </div>
    <?php
} ?>
<div class="sehun"></div>

<header id="fh5co-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <div class="logo"><a href="/"><img src="/hm/images/logo.png"></a></div>
            <nav role="navigation" class="navshow">
                <ul>
                    <?php
                    $nb_pages = count($pages);
                    foreach ($pages as $page_id_nav => $page_nav) {
                        if ($page_nav['checked'] == 1) {
                            $id_parent = $page_nav['id_parent'];
                            if ($page_nav['main'] == 1 && ($id_parent == 0 || $id_parent == $homepage['id'])) {
                                ?>
                                <li class="<?php if ($page_nav['id'] == $page_id) echo " navs"; ?>"><?php
                                    if ($page_nav['home'] == 1) {
                                        ?><a href="<?php echo DOCBASE . LANG_ALIAS; ?>"
                                             title="<?php echo $page_nav['title']; ?>"><?php echo $page_nav['name']; ?></a><?php
                                    } else {
                                        $nb_subpages = (isset($parents[$page_id_nav])) ? count($parents[$page_id_nav]) : 0;
                                        ?><a href="<?php echo DOCBASE . $page_nav['alias']; ?>"
                                             title="<?php echo $page_nav['title']; ?>"><?php echo $page_nav['name']; ?></a><?php if ($nb_subpages > 0 && $page_nav['system'] != 1) subMenu($parents[$page_id_nav]);
                                    } ?></li>
                                <?php
                            }
                        }
                    } ?>
                    <li class="cta"><?php
                        if (isset($_SESSION['user'])) { ?>
                            <form method="post" action="<?php echo DOCBASE . $page['alias']; ?>" class="ajax-form">
                                <div class="dropdown">
                                    <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-user"></i>
                                        <span class="hidden-sm hidden-md">
                                            <?php
                                            if ($_SESSION['user']['login'] != "") echo $_SESSION['user']['login'];
                                            else echo $_SESSION['user']['email']; ?>
                                        </span>
                                        <span class="fa fa-caret-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" id="user-menu">
                                        <?php
                                        if ($_SESSION['user']['type'] == "registered") { ?>
                                            <li><a href="<?php echo DOCBASE . $sys_pages['account']['alias']; ?>"><i
                                                        class="fa fa-user"></i> <?php echo $sys_pages['account']['name']; ?>
                                                </a></li>
                                            <?php
                                        } ?>
                                        <li><a href="#" class="sendAjaxForm"
                                               data-action="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/common/register/logout.php"
                                               data-refresh="true"><i
                                                    class="fa fa-power-off"></i> <?php echo $texts['LOG_OUT']; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                            <?php
                        } else { ?>
                            <a href="signin.html">登录</a>
                            <?php
                        } ?></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
