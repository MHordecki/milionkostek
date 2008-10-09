# Ranking

Aktualnie : <?=$actual_cat;?>

<?=$form;?>


<?foreach($ranking as $usr):?>
0.  <?=html::anchor('/stats/user/'.$usr->id,$usr->username);?> (<?=$usr->solved;?>)
<?endforeach;?>
