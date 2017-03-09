
<aside id="fh5co-hero" class="js-fullheight">
    <div class="flexslider js-fullheight">
        <ul class="slides">
            <?php
            $rs = $pdo->query("SELECT * FROM pm_slide WHERE lang = 2 and checked = 1 and id_page =".$navid);
            $i = 1;
            while ($row = $rs->fetch()) {
                ?>
                <li style="background: url(<?php
                    $rs1 = $pdo->query("SELECT * FROM pm_slide_file WHERE id_item = " . $row['id']." order by id asc");
                    $row1 = $rs1->fetch();
                    //if (!is_file($_SERVER['DOCUMENT_ROOT']."/images/" . $row1['file'])) {
                    //    echo "/images/" . $row1['file'];
                   // } else {
                        echo "/medias/slide/big/" . $row1['id'] . "/" . $row1['file'];
                    //} 
                    ?>) no-repeat; background-position:center center;-moz-background-size:100% 100%;background-size:100% 100%;" >
                    <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
                                <div class="slider-text-inner midd_230ss">
                                    <h2><?php echo $row['legend'] ?></h2>
                                    <?php 
                                    if (!empty($row['more'])) {
                                    ?>
                                    <p><a href="<?php echo $row['more'] ?>" class="btn btn-primary btn-lg">了解更多</a></p>
                                     <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                </li>
                <?php $i++;
            } ?>
        </ul>
    </div>
</aside>