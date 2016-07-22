<?php
class NoteFormaterHelper extends AppHelper {
    var $helpers = array('Time','Session','Html');
    function currency($var=null) {
        $currencySettings = $this->Session->read('Settings.CurrencySetting');
        $rightSymbol = $currencySettings['decimal_precition'] == 0 ? ',-' : null ;
        return $currencySettings['symbol'].' '.number_format($var,$currencySettings['decimal_precition'],$currencySettings['decimal_separator'],$currencySettings['thousand_separator']).$rightSymbol;
    }
    
    function timeAgo($time=null) {
        if($this->Time->isToday($time)) {
            return $this->Time->timeAgoInWords($time);   
        }else {
            return date('d M',strtotime($time));
        }
    }

    function count_view_humanize($var=null) {
        switch(TRUE) {
            case $var >= 0 && $var <= 999:
                return '<span class="stat-superscript">&nbsp;</span>'.$var.'<span class="stat-superscript">&nbsp;</span>';
                break;
            case $var >= 1000 && $var <= 999999:
                return '<span class="stat-superscript">+</span>'.round($var/1000,1).'<span class="stat-superscript">k<span>';
                break;
            case $var >= 1000000 && $var <= 999999999:
                return '<span class="stat-superscript">+</span>'.round($var/1000000,1).'<span class="stat-superscript">m</span>';
                break;
            default:
                return '<span class="stat-superscript">+</span>1<span class="stat-superscript">b<span>';
                break;
        }
    }
    
    function numberHumanize($var=null) {
        switch(TRUE) {
            case $var >= 0 && $var <= 999:
                return $var;
                break;
            case $var >= 1000 && $var <= 999999:
                return round($var/1000,1).' k';
                break;
            case $var >= 1000000 && $var <= 999999999:
                return round($var/1000000,1).' m';
                break;
            default:
                return round($var/1000000000,1).' b';
#                return '+1 b';
                break;
        }
    }

    function visited($number=null,$isHumanize=true) {
        if($isHumanize) {
            $number = $this->numberHumanize($number);
        }else {
            $number = number_format($number,0,',','.');
        }
#        die($number);
#        return sprintf(__n(' %s time',' %s times',$number,true),$number);
        return $number.' kali';
    }
    
    function autoLinkedTags($str=null) {
        $tags = $this->findTags($str);
        
        $link = Router::url(array('member'=>false,'admin'=>false,'controller'=>'notes','action'=>'search'));
        
        $pats = $reps = null;
        foreach($tags as $tag) {
            $pats[] = '/'.$tag.'/';
            $reps[] = '<a href="'.$link.'?q='.urlencode($tag).'">'.$tag.'</a>';
        }
        return preg_replace($pats,$reps,$str);
    }
    
    function findTags($str=null) {
        $tags = null;
        if(preg_match_all('/\[(.*?)\]/',$str,$match)) {
            $tags = $match[1];
        }
        return $tags;   
    }
    
    function logo($file='logo_v_2_black.png',$options=array()) {
        $options = $options+array('alt'=>'Logo');
        return $this->Html->image(Router::url('/',true).'img/'.$file,$options);
    }
}
?>
