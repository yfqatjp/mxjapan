<div class="sehun"></div>
<header id="fh5co-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
            <nav role="navigation" class="navshow">
                <ul>
                    <?php
                    $rs = $pdo->query("SELECT * FROM `pm_page` WHERE `lang` = '2' AND `main` = 1 AND `id_parent` IS NULL ORDER BY rank");
                    while ($row = $rs->fetch()) {
                        ?>
                        <li<?php if ($navid == $row['id']) { ?> class="navs"<?php } ?>><a
                                href="<?php echo $row['url'] ?>"><?php echo $row['name'] ?></a></li>
                    <?php }
                    if($_SESSION['userid']==""){?>
                    <li class="cta"><a href="signin.html">登录</a></li>
                    <?php }else{?>
                        <li class="cta1"><a href="/user/">进入个人中心</a></li>
                    <?php }?>
                </ul>
            </nav>
        </div>
    </div>
</header>