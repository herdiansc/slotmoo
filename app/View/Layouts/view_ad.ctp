<?php echo $this->Html->docType() ?>
<html lang="ID">
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
        App::import('lib','Sanitize');
        echo $this->Html->meta(array('name'=>'description','content'=>$this->Text->truncate(@$description_for_layout,100)));

        echo '<meta property="og:url" content="http://slotmoo.com'. $this->here .'" />';
        echo '<meta property="og:title" content="'. @$title .'" />';
        echo '<meta property="og:description" content="'. @$description_for_layout .'" />';
		echo '<meta property="og:site_name" content="'. SITE_NAME .'" />';
		echo '<meta property="og:type" content="website" />';
		echo '<meta property="fb:admins" content="1466636228" />';
        if($this->here == null || $this->here == '/' ) {
            echo '<meta property="og:image" content="'.Router::url('/',true).'img/slotmoo_thumbnail_fb.png"/>';
        }else if( isset($listing['ImageListing'][0]['filename']) && $listing['ImageListing'][0]['filename'] != null ) {
			echo '<meta property="og:image" content="'. $listing['ImageListing'][0]['image_server'] .'uploads/'. $listing['ImageListing'][0]['filename']. '"/>';
		}else {
		    echo '<meta property="og:image" content="'.Router::url('/',true).'img/slotmoo_thumbnail_fb.png"/>';
		}
        //<meta name="viewport" content="width=device-width, initial-scale=1"> 
        echo $this->Html->meta(array('name'=>'viewport','content'=>'width=device-width, initial-scale=1'));
        
        $rootDomainJS = 'var BASE_URL = "'.Router::url('/',true).'";';
        $rootDomainJS .= 'var CDN = "'.CDN.'";';
        echo $this->Html->scriptBlock($rootDomainJS);
        
        echo $this->Html->meta('icon');
/*
 * BEGIN: A1 BLOCK
 * Asset on SAME SERVER Version
 * Comment this block when all webroot folders has been moved to ASSET_CDN server
 *
**/        
        echo $this->Html->css(
            array(
                'style_compressed_blue',
                'home_style',
                '../js/jquery-ui-1.8.17.custom/css/black-tie/jquery-ui-1.8.17.custom.css'
            )
        );
        echo $this->Html->script(array(
            'jquery-1.7.1.min.js',
            'jquery-ui-1.8.17.custom/js/jquery-ui-1.8.17.custom.min.js',
            'custom',
            'jquery.hovercard',
            'jquery.slimScroll'
        ));
// BEGIN: A2 BLOCK
/*
 * BEGIN: A2 BLOCK
 * Asset on CDN Version
 * Uncomment this block when all webroot folders has been moved to ASSET_CDN server
 *
**/
#        echo $this->Html->css(
#            array(
#                ASSET_CDN.'css/style_compressed.css',
#                ASSET_CDN.'css/home_style.css',
#                ASSET_CDN.'js/jquery-ui-1.8.17.custom/css/black-tie/jquery-ui-1.8.17.custom.css'
#            )
#        );
#        echo $this->Html->script(array(
#            ASSET_CDN.'js/jquery-1.7.1.min.js',
#            ASSET_CDN.'js/jquery-ui-1.8.17.custom/js/jquery-ui-1.8.17.custom.min.js',
#            ASSET_CDN.'js/custom.js',
#            ASSET_CDN.'js/jquery.hovercard.js',
#            ASSET_CDN.'js/jquery.slimScroll.js'
#        ));
// BEGIN: A2 BLOCK
        echo $scripts_for_layout;
    ?>
    <style>body > section { height: auto; min-height: 84%; }
	</style>

  </head>
<body class="member-area-layout">
    <header>
        <div class="top-container">
            <div class="site-name" style="margin-top:d0px;">
                <a href="<?php echo Router::url('/',true) ?>" style="text-decoration:none">
                    <h1 class="header-logo small-logo">
                        <?php echo $this->NoteFormater->logo('logo_v_2_black.png',array('width'=>145)); ?>
                    </h1>
                </a>
            </div>
            
            <div class="menus-container" style="padding-right:0px">
                <?php echo $this->element('menus_block') ?>
            </div>
            <div class="clear"></div>
        </div>
    </header>
    
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>    
    
    <section class="main-section">
        <div id="ajaxed-content"></div>
        <?php echo $content_for_layout; ?>
        <div class="clear"></div>
    </section>
    <div class="clear"></div>
    <footer class="member-area-footer home-footer">
        <?php echo $this->element('footer_menu') ?>
    </footer>
    <div class="ajax-loading" style="display:none" title="Loading...">Loading...</div>
    <script>
    $(document).ready(function(){
        $('div.message, div.flash-error').bind('click',function(){
            $(this).slideUp();
        });

		$(document).ajaxStart(function() {
			$( ".ajax-loading" ).html( $( ".ajax-loading" ).attr('title') ).show();
		});
		
		$(document).ajaxComplete(function() {
			$( ".ajax-loading" ).hide();
		});
		if($(document).outerHeight() > $(window).height()) {
		    $('.member-area-footer').removeClass('home-footer');
		    $('.main-section').removeClass('padding-bottom');
		}else {
		    $('.member-area-footer').addClass('home-footer');
		    $('.main-section').addClass('padding-bottom');
		}
    });
    </script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42483215-1', 'slotmoo.com');
  ga('send', 'pageview');

</script>
    <div debugging style="display:none">
    <?php
#        echo $this->element('sql_dump');
    ?>
    </div>
</body>
</html>
