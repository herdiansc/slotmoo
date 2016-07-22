<?php echo $this->Html->docType() ?>
<?php //echo $this->Facebook->html(); ?>
<html>
<head>
    <?php
        echo $this->Html->charset();
        
        if($title_for_layout == SITE_SLOGAN) {
            $title = SITE_NAME.' : '.$title_for_layout;
        }else {
            $title = $title_for_layout.' - '.SITE_NAME;
        }
        echo $this->Html->tag('title',$title,array('escape'=>false));
        
        echo $this->Html->meta(array('name'=>'keywords','content'=>@$keywords_for_layout));
        App::import('lib','Sanitize');
        echo $this->Html->meta(array('name'=>'description','content'=>$this->Text->truncate(@$description_for_layout,100)));
    
        $rootDomainJS = 'var BASE_URL = "'.Router::url('/',true).'";';
        echo $this->Html->scriptBlock($rootDomainJS);
        
        echo $this->Html->meta('icon');
        
        echo $this->Html->css(
            array(
                'style_compressed_blue',
                'home_style',
                '../js/jquery-ui-1.8.17.custom/css/black-tie/jquery-ui-1.8.17.custom',
#                CDN.'css/reset.css',
#                CDN.'css/default.css',
#                CDN.'css/addition.css'
            )
        );
        echo $this->Html->script(array(
            'jquery-1.7.1.min.js',
            'jquery-ui-1.8.17.custom/js/jquery-ui-1.8.17.custom.min.js',
            //CDN.'js/tiny_mce/tiny_mce.js'
            //'tiny_mce/tiny_mce'
            //CDN.'js/texteditor/tiny_mce.js'
            'texteditor/tiny_mce',
            'custom'
        ));
        echo $scripts_for_layout;
    ?>
  </head>
<body class="default-layout" style="overflow-x: hidden;">
<style>
</style>
<!--    <div class="header-overlay" style="width"></div>
-->
    <header class="header-overlay">
        <div class="top-container">
            <div class="left-description">
                <h1 class="top"><?php echo SITE_SLOGAN ?></h1>
                <div class="separator"></div>
                <p><?php echo SITE_DESC ?></p>
                <div class="nav-welcome-btn">
                    <a href="/ads/new" class="public-btn red">Pasang Iklan</a>
                    <span>Atau</span>
                    <a href="/ads/browse" class="public-btn blue">Cari Barang</a>
                </div>
            </div>
            <?php echo $this->element('home_banner') ?>
        </div>
    </header>

    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>    
    
    <section>
        <?php echo $content_for_layout; ?>
    </section>
    
    <footer class="home-footer">
        <?php echo $this->element('footer_menu') ?>
    </footer>
    
    <script>
    $(document).ready(function(){
        $('div.message, div.flash-error').bind('click',function(){
            $(this).slideUp();
        });
    });
    </script>
<?php //echo $this->Facebook->init(); ?>
</body>
</html>
