<footer id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="midd_10 col-sm-push-0 col-xs-push-0">
            <h3>关于我们</h3>
            <p>美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。<br>公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，</p>
            <p><a href="about.html" class="btn btn-primary btn-outline btn-sm">查看更多</a></p>
        </div>
        <div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <ul class="float">
                <h3>联系方式</h3>
                <span><?php echo constant("SITE_TITLE");?></span>
                <li><a href="#"><img src="/images/6_03.png"><?php echo constant("ADDRESS");?></a></li>
                <li><a href="#"><img src="/images/6_07.png"><?php echo constant("PHONE");?></a></li>
                <li><a href="#"><img src="/images/6_10.png"><?php echo constant("MOBILE");?></a></li>
                <li><a href="#"><img src="/images/6_13.png"><?php echo constant("FAX");?></a></li>
                <li><a href="#"><img src="/images/6_17.png"><?php echo constant("EMAIL");?></a></li>
            </ul>
            <div class="midd_65"><h3>微信公众号</h3><img src="<?php echo constant("OWNER");?>"></div>
        </div>
        <div class="clear"></div>
        <div class="midd_11">
            © <?php echo date('Y');?> <?php echo constant("SITE_TITLE");?> All rights reserved
        </div>
    </div>
</footer>

<!-- 返回顶部 -->
<div id="top"><img src="/images/top.png"></div>
<script>
    $('#top').click(function () {
        $('html,body').animate({scrollTop: '0px'}, 800);
        return false;
    });
</script>