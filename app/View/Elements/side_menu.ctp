<?php
    $menus = array(
        array('title'=>'separator','heading'=>'Activities','url'=>null),
        array(
            'title'=>'Transactions',
            'url'=>array('member'=>true,'controller'=>'transactions','action'=>'index')
        ),
        array(
            'title'=>'Transfers',
            'url'=>array('member'=>true,'controller'=>'transactions','action'=>'transfer')
        ),
        array('title'=>'separator','heading'=>'Data Settings','url'=>null),
        array(
            'title'=>'Accounts',
            'url'=>array('member'=>true,'controller'=>'accounts','action'=>'index')
        ),
        array('title'=>'separator','heading'=>'App Settings','url'=>null),
        array(
            'title'=>'General Settings',
            'url'=>array('member'=>true,'controller'=>'currency_settings','action'=>'index')
        ),
        array('title'=>'separator','heading'=>'&nbsp;','url'=>null),
        array(
            'title'=>'Logout',
            'url'=>array('member'=>false,'controller'=>'users','action'=>'logout')
        )
    );
?>

<ul>
    <li class="dashboard">
        <?php
            echo $html->link(
                'Dashboard',
                array('member'=>true,'controller'=>'users','action'=>'dashboard')
            );
        ?>
    </li>
<?php $curLink = array('member'=>$this->params['member'],'controller'=>$this->params['controller'],'action'=>preg_replace('/member_/','',$this->params['action'])); ?>
<?php foreach($menus as $menu){ ?>
<?php
    $class = $menu['url'] == $curLink ? 'active' : '' ;
?>
<?php if($menu['title'] == 'separator'){ ?>
    <li class="separator" style="border-bottom: 1px solid #DFDFDF;">
        <div class="menu-heading"><?php echo $menu['heading'] ?></div>
    </li>
<?php }else { ?>
    <li class="<?php echo $class ?>">
        <?php
            echo $html->link(
                $menu['title'],
                $menu['url']
            );
        ?>
    </li>
<?php } ?>
<?php } ?>
</ul>

<style>
.menu-heading {

text-transform: uppercase;
height: 30px;
line-height: 30px;
font-size: 15px;
margin-top: 20px;
border-radius: 7px 0px 0px 0px;
padding-left: 10px;

background-color: #497EAC;
background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(107, 160, 206)), to(rgb(73, 126, 172)));
background-image: -webkit-linear-gradient(top, rgb(107, 160, 206), rgb(73, 126, 172));
background-image: -moz-linear-gradient(top, rgb(107, 160, 206), rgb(73, 126, 172));
background-image: -o-linear-gradient(top, rgb(107, 160, 206), rgb(73, 126, 172));
background-image: -ms-linear-gradient(top, rgb(107, 160, 206), rgb(73, 126, 172));
background-image: linear-gradient(top, rgb(107, 160, 206), rgb(73, 126, 172));
filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#6ba0ce', EndColorStr='#497eac');
border-bottom: 1px solid #467CAD;
border-top: 1px solid #699FD0;
color: white;
text-shadow: 0 0px 5px #fff;
}

li.dashboard {
    border-radius:7px 0px 0px 7px;
}

li.dashboard a {border:0px !important;}
li.dashboard a:hover {
    border-radius:7px 0px 0px 7px;
}
</style>
