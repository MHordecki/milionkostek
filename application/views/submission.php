# Rozwiązanie do zadania
Zadanie: <?=html::anchor('/problems/view/'.$sub->problem_id,$sub->title);?>   
Zbiór: <?=$sub->problemset;?>    
Wysłał: <?=$sub->username;?>  

## Szczegóły

Status rozwiązania: **<?=$status;?>**
<? if(isset($details)):?>

## Testy
<? foreach($details as $t):?>
0.  <?=$t[0];?> (czas: <?=$t[1];?>s) 
<? endforeach;?>

<? endif; ?>	

