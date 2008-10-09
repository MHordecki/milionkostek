# Przeglądanie stron statycznych  

<? foreach($pages as $key => $val):?>
0.  <?=html::anchor('/admin/page/'.$key,substr($val,strpos($val,'static')));?>  
<?endforeach;?>
