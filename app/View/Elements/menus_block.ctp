<?php
    $browse_label = 'Browse Iklan';
    if($this->Session->read('Auth.User.id')){
        $browse_label = 'Browse';
    }
    echo $this->Html->link('<span class="icon home">&nbsp;</span>'.$browse_label,
        '/ads/browse',
        array('class'=>'public-btn black browse-btn','escape'=>false)
    );
    if($this->Session->read('Auth.User.id')){
        echo $this->Html->link('<span class="icon new">&nbsp;</span>Pasang iklan',
            '/ads/new',
            array('class'=>'public-btn black ad-new-ad','escape'=>false)
        );
        echo $this->Html->link('<span class="icon profile">&nbsp;</span>Profil',
            '/'.$this->Session->read('Auth.User.username').'/profile',
            array('class'=>'public-btn black','escape'=>false)
        );
        echo $this->Html->link('<span class="icon logout">&nbsp;</span>Logout',
            '/users/logout',
            array('class'=>'public-btn black','escape'=>false)
        );
    }
    

    echo $this->Form->create(null,array('url'=>'/listings/search','type'=>'get','style'=>'float:left !important;'));
    echo '<input name="string" placeholder="Cari iklan" class="search" type="text" id="User" value="'.@$_GET['string'].'">';
    //echo $this->Form->input(null,array('name'=>'string','type'=>'text','label'=>false,'div'=>false,'placeholder'=>'Cari iklan','class'=>'search','value'=>@$_GET['string']));
    echo $this->Form->end();
?>
<div style="clear:both"></div>

<script>
$(function(){
/*
    $('#ajaxed-page-design-anchor').bind('click',function(e){
        $.get(BASE_URL+'member/settings/design',function(data){
            $('#ajaxed-content').html(data);
        });
        return false;
    });
*/
})
</script>
