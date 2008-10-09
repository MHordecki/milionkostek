# Użytkownik <?=$user->username;?>

<?
$ret='';
$sum=0;
foreach($cats as $r)
{
	$ret.="\nUłożonych kostek ( $r->name )\n:  $r->solved  \n";
	$sum+=$r->solved;
}?>

Ułożonych kostek (suma)
:  <?=$sum;?>

<?=$ret;?>

Dołączył
:  <?=strftime('%a, %d %B %Y',strtotime($user->created));?>  

### Statystyki

  * [Wynik na przestrzeni czasu](/stats/chart_user_score/<?=$user->id;?>)
