<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title><?php echo $title_tag; ?></title>
    
    <meta name="description" content="<?php echo $page['descr']; ?>">
    <meta name="robots" content="<?php if($page['robots'] != "") echo $page['robots']; else echo "index, follow"; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/images/favicon.png">
    
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/bootstrap/css/bootstrap.min.css">
    <?php
    if(RTL_DIR){ ?>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">
        <?php
    } ?>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    
    <?php
    //CSS required by the current model
    if(isset($stylesheets)){
        foreach($stylesheets as $stylesheet){ ?>
            <link rel="stylesheet" href="<?php echo $stylesheet['file']; ?>" media="<?php echo $stylesheet['media']; ?>">
            <?php
        }
    } ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/js/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/css/shortcodes.css">
	<link rel="stylesheet" href="<?php echo DOCBASE; ?>common/js/plugins/wow/animate.min.css"/>    
	<link rel="stylesheet" href="<?php echo DOCBASE; ?>common/js/plugins/prettyPhoto/prettyPhoto.css"/>    
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/css/layout.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/css/colors.css" id="colors">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/css/custom.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/css/custom-meixi.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/css/elegant-icon-meixi.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/css/style-meixi.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
    <script src="<?php echo DOCBASE; ?>common/js/modernizr-2.6.1.min.js"></script>
    <script src="<?php echo DOCBASE; ?>common/js/plugins/wow/wow.min.js"></script>    
    <script src="<?php echo DOCBASE; ?>common/js/plugins/prettyPhoto/jquery.prettyPhoto.init.min.js"></script>    
    <script src="<?php echo DOCBASE; ?>common/js/plugins/prettyPhoto/jquery.prettyPhoto.js"></script>    
    


        
    <script>
        Modernizr.load({
            load : [
                '<?php echo DOCBASE; ?>common/bootstrap/js/bootstrap.min.js',

                '<?php echo DOCBASE; ?>js/plugins/respond/respond.min.js',
                '//code.jquery.com/ui/1.11.4/jquery-ui.js',
                <?php if(LANG_TAG != "en") : ?>'//rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-<?php echo LANG_TAG; ?>.js',<?php endif; ?>
                '<?php echo DOCBASE; ?>js/plugins/jquery-cookie/jquery-cookie.js',
                '<?php echo DOCBASE; ?>js/plugins/strftime/strftime.min.js',
                '<?php echo DOCBASE; ?>js/plugins/easing/jquery.easing.1.3.min.js',
                '<?php echo DOCBASE; ?>common/js/plugins/magnific-popup/jquery.magnific-popup.min.js',
                //Javascripts required by the current model
                <?php if(isset($javascripts)) foreach($javascripts as $javascript) echo "'".$javascript."',\n"; ?>
                
                '//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js',
				'<?php echo DOCBASE; ?>js/plugins/imagefill/js/jquery-imagefill.js',
                '<?php echo DOCBASE; ?>js/plugins/toucheeffect/toucheffects.js',
                '<?php echo DOCBASE; ?>common/js/waypoints.min.js',
                   
            ],
            complete : function(){
                Modernizr.load('<?php echo DOCBASE; ?>common/js/custom.js');
                Modernizr.load('<?php echo DOCBASE; ?>js/custom.js');
            }
        });
        
        $(function(){
            <?php
            if(isset($msg_error) && $msg_error != ""){ ?>
                var msg_error = '<?php echo preg_replace("/(\r\n|\n|\r)/","",nl2br(addslashes($msg_error))); ?>';
                if(msg_error != '') $('.alert-danger').html(msg_error).slideDown();
                <?php
            }
            if(isset($msg_success) && $msg_success != ""){ ?>
                var msg_success = '<?php echo preg_replace("/(\r\n|\n|\r)/","",nl2br(addslashes($msg_success))); ?>';
                if(msg_success != '') $('.alert-success').html(msg_success).slideDown();
                <?php
            }
            if(isset($field_notice) && !empty($field_notice))
                foreach($field_notice as $field => $notice) echo "$('.field-notice[rel=\"".$field."\"]').html('".$notice."').fadeIn('slow').parent().addClass('alert alert-danger');\n"; ?>
        });
        
        /* ==============================================
         * PLACE ANALYTICS CODE HERE
         * ==============================================
         */
         var _gaq = _gaq || [];



                
    </script>
</head>
<body id="page-<?php echo $page_id; ?>" itemscope itemtype="http://schema.org/WebPage"<?php if(RTL_DIR) echo " dir=\"rtl\""; ?>>
<?php
if(ENABLE_COOKIES_NOTICE == 1 && !isset($_COOKIE['cookies_enabled'])){ ?>
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
<header class="navbar-fixed-top" role="banner">
    <div id="mainHeader">
        <div class="container">
            <div id="mainMenu" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
                    function subMenu($subpages)
                    {
                        global $parents;
                        global $pages; ?>
                        <ul class="subMenu">
                            <?php
                            foreach($subpages as $id_subpage){
                                $subpage = $pages[$id_subpage]; ?>
                                <li>
                                    <?php
                                    $nb_subpages = (isset($parents[$id_subpage])) ? count($parents[$id_subpage]) : 0; ?>
                                    <a class="<?php if($nb_subpages > 0) echo " hasSubMenu"; ?>" href="<?php echo DOCBASE.$subpage['alias']; ?>" title="<?php echo $subpage['title']; ?>"><?php echo $subpage['name']; ?></a>
                                    <?php if($nb_subpages > 0) subMenu($parents[$id_subpage]); ?>
                                </li>
                                <?php
                            } ?>
                        </ul>
                        <?php
                    }
                    $nb_pages = count($pages);
                    foreach($pages as $page_id_nav => $page_nav){
                        if($page_nav['checked'] == 1){
                            $id_parent = $page_nav['id_parent'];
                            if($page_nav['main'] == 1 && ($id_parent == 0 || $id_parent == $homepage['id'])){ ?>
                            
                                <li class="primary nav-<?php echo $page_nav['id']; ?>">
                                    <?php
                                    if($page_nav['home'] == 1){ ?>
                                        <a class="firstLevel<?php if($ishome) echo " active"; ?>" href="<?php echo DOCBASE.LANG_ALIAS; ?>" title="<?php echo $page_nav['title']; ?>"><?php echo $page_nav['name']; ?></a>
                                        <?php
                                    }else{
                                        $nb_subpages = (isset($parents[$page_id_nav])) ? count($parents[$page_id_nav]) : 0; ?>
                                        <a class="dropdown-toggle disabled firstLevel<?php if($nb_subpages > 0 && $page_nav['system'] != 1) echo " hasSubMenu"; if($page_nav['id'] == $page_id) echo " active"; ?>" href="<?php echo DOCBASE.$page_nav['alias']; ?>" title="<?php echo $page_nav['title']; ?>"><?php echo $page_nav['name']; ?></a>
                                        <?php if($nb_subpages > 0 && $page_nav['system'] != 1) subMenu($parents[$page_id_nav]);
                                    } ?>
                                </li>
                                <?php
                            }
                        }
                    } ?>
                    
                    
                    <li class="primary">
                        <?php
                        if(isset($_SESSION['user'])){ ?>
                            <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                <div class="dropdown">
                                    <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-lock"></i>
                                        <?php
                                        if($_SESSION['user']['login'] != "") echo $_SESSION['user']['login'];
                                        else echo $_SESSION['user']['email']; ?>
                                        <span class="fa fa-caret-down"></span>
                                    </a>
                                    <ul id="user-menu" class="dropdown-menu" role="menu">
                                        <?php
                                        if($_SESSION['user']['type'] == "registered"){ ?>
                                            <li><a href="<?php echo DOCBASE.$sys_pages['account']['alias']; ?>"><i class="fa fa-user"></i> <?php echo $sys_pages['account']['name']; ?></a></li>
                                            <?php
                                        } ?>
                                        <li><a href="#" class="sendAjaxForm" data-action="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/common/register/logout.php" data-refresh="true"><i class="fa fa-power-off"></i> <?php echo $texts['LOG_OUT']; ?></a></li>
                                    </ul>
                                </div>
                            </form>
                            <?php
                        }else{ ?>
                            <a class="popup-modal firstLevel" href="#user-popup">
                                <i class="fa fa-power-off"></i>
                            </a>
                            <?php
                        } ?>
                    </li> 
                </ul>
                <div id="user-popup" class="white-popup-block mfp-hide">
                    <div class="fluid-container">
                        <div class="row">
                            <div class="col-xs-12 mb20 text-center">
                                <a class="btn fblogin" href="#"><i class="fa fa-facebook"></i> <?php echo $texts['LOG_IN_WITH_FACEBOOK']; ?></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 mb20 text-center">
                                - <?php echo $texts['OR']; ?> -
                            </div>
                        </div>
                   
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="login-form">
                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                        <div class="alert alert-success" style="display:none;"></div>
                                        <div class="alert alert-danger" style="display:none;"></div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" class="form-control" name="user" value="" placeholder="<?php echo $texts['USERNAME']." ".strtolower($texts['OR'])." ".$texts['EMAIL']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="user"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                                <input type="password" class="form-control" name="password" value="" placeholder="<?php echo $texts['PASSWORD']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="pass"></div>
                                        </div>
                                        <div class="row mb10">
                                            <div class="col-sm-7 text-left">
                                                <a class="open-pass-form" href="#"><?php echo $texts['FORGOTTEN_PASSWORD']; ?></a><br>
                                                <a class="open-signup-form" href="#"><?php echo $texts['I_SIGN_UP']; ?></a>
                                            </div>
                                            <div class="col-sm-5 text-right">
                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/common/register/login.php" data-refresh="true"><i class="fa fa-power-off"></i> <?php echo $texts['LOG_IN']; ?></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="signup-form">
                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                        <div class="alert alert-success" style="display:none;"></div>
                                        <div class="alert alert-danger" style="display:none;"></div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" class="form-control" name="name" value="" placeholder="<?php echo $texts['FULLNAME']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="name"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" class="form-control" name="username" value="" placeholder="<?php echo $texts['USERNAME']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="username"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                <input type="text" class="form-control" name="email" value="" placeholder="<?php echo $texts['EMAIL']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="email"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                                <input type="password" class="form-control" name="password" value="" placeholder="<?php echo $texts['PASSWORD']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="password"></div>
                                        </div>
                                        <div class="row mb10">
                                            <div class="col-sm-7 text-left">
                                                <a class="open-login-form" href="#"><?php echo $texts['ALREADY_HAVE_ACCOUNT']; ?></a>
                                            </div>
                                            <div class="col-sm-5 text-right">
                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/common/register/signup.php" data-refresh="true"><i class="fa fa-power-off"></i> <?php echo $texts['SIGN_UP']; ?></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="pass-form">
                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                        <div class="alert alert-success" style="display:none;"></div>
                                        <div class="alert alert-danger" style="display:none;"></div>
                                        <p><?php echo $texts['NEW_PASSWORD_NOTICE']; ?></p>
                                            
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                <input type="text" class="form-control" name="email" value="" placeholder="<?php echo $texts['EMAIL']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="email"></div>
                                        </div>
                                        <div class="row mb10">
                                            <div class="col-sm-7 text-left">
                                                <a class="open-login-form" href="#"><?php echo $texts['LOG_IN']; ?></a><br>
                                                <a class="open-signup-form" href="#"><?php echo $texts['I_SIGN_UP']; ?></a>
                                            </div>
                                            <div class="col-sm-5 text-right">
                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/common/register/reset.php" data-refresh="false"><i class="fa fa-power-off"></i> <?php echo $texts['NEW_PASSWORD']; ?></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo DOCBASE.LANG_ALIAS; ?>" title="<?php echo $homepage['title']; ?>"><img src="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/images/logo.png" alt="<?php echo SITE_TITLE; ?>"></a>
                </div>
            </div>
        </div>
    </div>
</header>
