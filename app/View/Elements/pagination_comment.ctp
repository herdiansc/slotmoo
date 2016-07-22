<div class="next" style="margin-top:10px;">
    <?php
        $this->Paginator->options(array('url'=>array(@$this->passedArgs[0],'?'=>@$get)));
        if($this->Paginator->hasNext()) echo $this->Paginator->next('Selanjutnya',array('tag'=>'div')); 
    ?>
</div>
