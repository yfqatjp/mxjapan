    <?php 
    if (count($recommendCharters) > 0) {
    ?>
    <div class="midd_27">
      <div class="midd_46">推荐车导服务</div>
      
      <?php 
      foreach($recommendCharters as $index => $recommendCharter) {
      ?>
      <div class="midd_47" <?php if (($index+1)%5 == 0) { echo 'style="margin-right:0;"';}?>>
      	<a href="guidexx.html?id=<?php echo $recommendCharter['id'];?>">
      	  	<?php 
		  		if (empty($recommendCharter['image_url'])) {
		  	?>
		  		<img src="images/11_138.png">
		  	<?php } else {?>
		  		<img src="<?php echo $recommendCharter['image_url'];?>" alt="<?php echo $recommendCharter['image_label'];?>">
		  	<?php }?>
      		<span><?php echo $recommendCharter["title"];?></span>
      	</a>
      </div>
	<?php 
	}
	?>
      <div class="clear"></div>
    </div>
    
    <?php 
    }
    ?>