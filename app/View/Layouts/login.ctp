<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <?php 
        echo $this->Html->charset();

        if($title_for_layout == SITE_SLOGAN) {
            $title = SITE_NAME.' : '.$title_for_layout;
        }else {
            $title = $title_for_layout.' | '.SITE_NAME;
        }
        echo $this->Html->tag('title',$title,array('escape'=>false));

        echo $this->Html->meta(array('name'=>'keywords','content'=>@$keywords_for_layout));
        echo $this->Html->meta(array('name'=>'description','content'=>$this->Text->truncate(@$description_for_layout,100)));
        
        $rootDomainJS = 'var BASE_URL = "'.Router::url('/',true).'";';
        echo $this->Html->scriptBlock($rootDomainJS);

        echo $this->Html->meta('icon');
        echo $this->Html->css(
            array(
                'style_compressed_blue',
                'home_style',
#                CDN.'css/reset.css',
#                CDN.'css/default.css',
#                CDN.'css/addition.css'
            )
        );
        echo $this->Html->script(array('jquery-1.7.1.min'));
        echo $scripts_for_layout;
        
        $r = mt_rand(200,255);
        $g = mt_rand(200,255);
        $b = mt_rand(50,255);//color:rgb(245,100,56)
        $color = "rgb($r,$g,$b)";
    ?>
  </head>
  
  <!--<body style="background-color:rgb(236,208,61);">-->
  <body class="login-layout">
<div class="main-container">
    <section id="maincontainer">
        <div id="main">
            <div class="box">
                <div class="box-header" style="height:120px !important;">
                    <div class="inner-header" style="width:940px;margin:0 auto;">
                        <div class="top-container">
                            <div class="site-name" style="margin-top:10px;">
                                <a href="<?php echo Router::url('/',true) ?>" style="text-decoration:none">
                                    <h1 style="font-size:50px !important;">
                                        <?php echo $this->NoteFormater->logo('logo_v_2_black.png',array('width'=>145)); ?>
                                    </h1>
                                </a>
                                <p class="slogan"></p>
                            </div>
                            <div class="menus-container" style="padding:10px 0px 10px 10px;">
                                <?php echo $this->element('menus_block') ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>
        <div class="box-container">
            <div class="two-box-container">
                <?php echo $content_for_layout; ?>
                <div style="clear:both"></div>
            </div>
        </div>
      </div>
    </section>
    <div class="clear"></div>
    <footer class="login-footer home-footer">
        <?php echo $this->element('footer_menu') ?>
    </footer>
</div>
<script>
$(document).ready(function(){
    $('div.message, div.flash-error').bind('click',function(){
        $(this).slideUp();
    });
    
	if($(document).outerHeight() > $(window).height()) {
	    $('.login-footer').removeClass('home-footer');
	}else {
	    $('.login-footer').addClass('home-footer');
	}
});
</script>
</body>
</html>
