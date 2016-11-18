<?php debug_backtrace() || die ("Direct access not permitted"); ?>
<header class="page-header">
    <div id="position">
        <div class="container">
            <?php
            if($article_id == 0){
                $page_title = $page['title'];
                $page_subtitle = $page['subtitle'];
                $page_name = $page['name']; 
            }else{
                $page_name = $page_title; 
            }
            ?>
            <ul>
                <li>
                    <a href="<?php echo DOCBASE.LANG_ALIAS; ?>" title="<?php echo $homepage['title']; ?>"><?php echo $homepage['name']; ?></a>
                </li>
                <?php
                foreach($breadcrumbs as $id_parent){
                    if(isset($pages[$id_parent])){
                        $parent = $pages[$id_parent]; 
                ?>
                    <li>
                        <a href="<?php echo DOCBASE.$parent['alias']; ?>" title="<?php echo $parent['title']; ?>"><?php echo $parent['name']; ?></a>
                    </li>
                <?php
                    }
                }
                if($article_id > 0){ 
                ?>
                    <li>
                        <a href="<?php echo DOCBASE.$page['alias']; ?>" title="<?php echo $page['title']; ?>"><?php echo $page['name']; ?></a>
                    </li>
                <?php
                } ?>
                <li><?php echo $page_name; ?></li>
            </ul>
        </div>
    </div>
</header>
