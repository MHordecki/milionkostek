# Użytkownicy

<?foreach($users as $usr):?>
0.  <?=html::anchor('/users/view/'.$usr->id,$usr->username);?> (<?=strftime('%a, %m %B %Y',strtotime($usr->created));?>)  
<?endforeach;?>
