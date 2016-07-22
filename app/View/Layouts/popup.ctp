<div style="margin:20px 10px;">
<style>
.keyword-suggestion {width:500px;margin:0 auto;background:white;padding:20px;position: relative;}
.keyword-suggestion h4.popup-header {margin-bottom:20px;}
.search_keyword {height:20px !important;width:200px !important;margin:10px 0px 20px 0px;}
ul.keywords_list {
padding: 5px 20px;
background-color: #FAFEFF;
height:308px;
overflow-y: hidden;
}
ul.keywords_list li {margin:20px 0;}
ul.keywords_list li a.keyword {float:left;line-height:26px;}
ul.keywords_list li a.keyword-follow {float:right}
.clear{clear:both}
</style>
<div class="keyword-suggestion">
<?php echo $this->fetch('content'); ?>
</div>
</div>
