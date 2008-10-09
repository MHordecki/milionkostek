<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Milion Kostek</title>
	<?=html::stylesheet('media/style.css');?>
<?=html::script(array
(
    'media/jquery-1.2.3.min.js',
    'media/jquery.flot.pack.js'
), FALSE);?>
	
</head>
<body>

<div id="page">
<div id="header">

	<h1><?=html::anchor('','Milion Kostek');?></h1>
	<p id="blog_description">Milion kostek Rubika w jeden rok!</p>
	
</div>
<hr class="hrhide" />

	<div id="content" class="narrowcolumn">
<?=Message::Draw();?>
<br/>
<?=$content;?>
	<!--		
						
			<div class="post">
				<h2 id="post-9"><a href="http://themes.wordpress.net/testrun/?p=9" rel="bookmark" title="Permanent Link to An image in a post">An image in a post</a></h2>
				<small>October 24th, 2005 </small>
				
				<div class="entry">
					<p><img src="http://s.themes.wordpress.net/images/spectacles.gif" alt="an image" />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Quisque sed felis. Aliquam sit amet felis. Mauris semper, velit semper laoreet dictum, quam diam dictum urna, nec placerat elit nisl in quam. Etiam augue pede, molestie eget, rhoncus at, convallis ut, eros. Aliquam pharetra. Nulla in tellus eget odio sagittis blandit. Maecenas at nisl. Nullam lorem mi, eleifend a, fringilla vel, semper at, ligula. Mauris eu wisi. Ut ante dui, aliquet nec, congue non, accumsan sit amet, lectus. Mauris et mauris. Duis sed massa id mauris pretium venenatis. Suspendisse cursus velit vel ligula. Mauris elit. Donec neque. Phasellus nec sapien quis pede facilisis suscipit. Aenean quis risus sit amet eros volutpat ullamcorper. Ut a mi. Etiam nulla. Mauris interdum.</p>
				</div>
		
				<p class="postmetadata">Posted in <a href="http://themes.wordpress.net/testrun/?cat=1" title="View all posts in Uncategorized" rel="category tag">Uncategorized</a> <strong>|</strong> <a href="http://themes.wordpress.net/testrun/?p=9#comments" title="Comment on An image in a post">5 Comments &#187;</a></p> 
				<hr />
			</div>-->
	
		
<!--		<div class="navigation">
			<div class="alignleft"><a href="http://themes.wordpress.net/testrun/index.php?paged=2">&laquo; Previous Entries</a></div>
			<div class="alignright"><a href="http://themes.wordpress.net/testrun/index.php?paged=2"></a></div>
		</div>
	-->	
	
	</div>

	<div id="sidebar">
		<ul>
<li class="pagenav"><h2>Menu</h2><ul>
<li class="page_item"><?=html::anchor('','Strona Główna');?></li>
<li class="page_item"><?=html::anchor('/stats/ranking','Ranking');?></li>
<li class="page_item"><?=html::anchor('/stats','Statystyki');?></li>
<li class="page_item"><?=html::anchor('/index/page/about','O Projekcie');?></li>
</ul></li>
<? if($auth):?>
<li class="pagenav"><h2>Meta</h2><ul>
<li class="page_item"><?=html::anchor('/account','Moje konto');?></li>
<li class="page_item"><?=html::anchor('/account/submit','Wyślij zgłoszenie');?></li>
<li class="page_item"><?=html::anchor('/stats/user/'.$userid,'Moje statystyki');?></li>
<li class="page_item"><?=html::anchor('/auth/logout','Wyloguj się');?></li>
</ul></li>
<? else:?>
<li class="pagenav"><h2>Zaloguj się</h2><br/>
<form action="<?=url::base(TRUE);?>auth/login" method="post">
<input type="text" name="username" value="Użytkownik"/><br/>
<input type="password" name="password" value="XXX"/><br/>
<input type="submit" value="Zaloguj się"/><br /><br />
<?=html::anchor('/auth/create','Załóż konto');?><br /><br />
</form>
</ul></li>
<? endif;?>

<br /><br /><br />
<ul>
<li class="page_item"><?=html::anchor('/admin','Panel Administracyjny');?></li>
</ul>


					
		</ul>
	</div>


<div id="footer">
Milion Kostek. Oryginalny pomysł i wykonanie: Grzegorz 'Goater' Łuczyna. Akutalne wykonanie: Michał Hordecki. Layout: <a href="http://www.azeemazeez.com/stuff/themes/" title="White as Milk theme for Wordpress">White as Milk Theme</a> designed by <a href="http://www.azeemazeez.com">Azeem Azeez</a>.<br />

</div>
</div>

</body>
</html>
