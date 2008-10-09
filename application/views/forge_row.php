<?=$open;?>
<table class="<?php echo $class ?>">
<tr>
<?php
foreach($inputs as $input):

?>
<td><?=$input->render()?>
<?
if ($message = $input->message()):
?>
<p class="message"><?php echo $message ?></p>
<?php
endif;
foreach ($input->error_messages() as $error):
?>
<p class="error"><?php echo $error ?></p>
<?php
endforeach;
?>
</td>
<?php

endforeach;
?>
</tr></table>
<?=$close;?>
