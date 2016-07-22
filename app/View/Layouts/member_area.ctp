<?php echo $this->Html->docType() ?>
<html>
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
    <?php //echo $this->element('sql_dump'); ?>
</body>
</html>
