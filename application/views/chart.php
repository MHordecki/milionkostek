<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Milion Kostek</title>
<?=html::script(array
(
    'media/jquery-1.2.3.min.js',
    'media/jquery.flot.pack.js'
), FALSE);?>
	
</head>
<body>
<center>
<?if(isset($back)):?>
<?=html::anchor($back,'Wróć')?>
<?endif;?>

<?if(isset($title)):?>
<h2><?=$title;?></h2>
<?endif;?>

<?if(isset($form)):?>
<?=$form;?>
<?endif;?>

<?=$chart?>
</center>
</body>
</html>
