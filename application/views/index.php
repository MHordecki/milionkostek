<?$v=new View('static/welcome');
echo Markdown($v->render());?>

<? 
$solved = 0;
$db = new Database();

foreach($db -> query("SELECT `solved` FROM `milion_submissions`;") as $row)
$solved += $row -> solved;
$rest = 1000000 - $solved;
echo '<div id="seksowny_div"><span id="licznik">Do tej pory ułożyliśmy <span id="bold">'.$solved.'</span> kostek. <br /><br />Do miliona brakuje jeszcze <span id="bold">'.$rest.'</span> kostek.<br /></span></div>';
?>

<br />
<h2 id="specialheader">Aktualności</h2><br/>

<? foreach($news as $n):?>
<div class="post">
<h2 id="post-9"><?=html::anchor('',$n->title);?></h2>
<small><?=strftime('%A, %d %B %Y',strtotime($n->created));?></small>
<div class="entry">
<?=Markdown($n->content);?>
</div>
		
	<p class="postmetadata">Wysłane przez <?=$n->author;?></p> 
				<hr />
			</div>
<?endforeach;?>

