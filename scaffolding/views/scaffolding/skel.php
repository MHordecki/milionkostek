<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Scaffolding module</title>
<?=html::stylesheet('scaffolding/media/style.css');?>
</head>
<body>
<div id="header">
<h1 class="blogtitle"><?=html::anchor('scaffolding','Scaffolding Module');?></h1>
<p class="desc">version 0.3</p>
</div>
<div id="ddnav">
<div id="nav">
<ul class="nav">
<li class="page_item"><?=html::anchor('scaffolding/index','Home');?></li>
<li class="page_item"><?=html::anchor('scaffolding/manual','Manual');?></li>
<li class="page_item"><?=html::anchor('scaffolding/about','About');?></li>
</ul>
</div>
</div>
<div id="top"></div>
<div id="main">
	<div id="content">
<? if(count(Message::$messages)>0): ?>
<div class="entry">
<?=Message::Draw();?>
</div>
<? endif;?>
		<div class="entry">
<?=$content;?>
</div>
	</div>

<div id="sidebar">
<div class="rsidebar">
<ul>
<? if(isset($models)):?>
    <li><h2>Models</h2>
<ul>
<? foreach($models as $model): ?>
<li><?=html::anchor('/scaffolding/model/'.$model,$model);?></li>
<? endforeach; ?>
</ul></li>
<? endif;?>
		 
				</ul>
</div>		
</div>




</div>
<div id="footer"></div>
<div id="footerbox">
<div class="footer">Scaffolding module by MHordecki. Licensed under <a href="http://creativecommons.org/licenses/BSD/" target="_blank"> BSD License</a>. Theme by <a href="http://www.blogohblog.com">Bob</a>	</div></div>
</body>
</html>
