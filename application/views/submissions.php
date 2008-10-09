<? foreach($subs as $s):?>
*  <?=html::anchor('/submissions/view/'.$s->id,$s->title); ?> (<?=strftime('%a, %m %B %Y, %H:%M',strtotime($s->created));?> przez <?=$s->username;?>) <?if($s->solved==1) {echo "(**OK**)";}?>   
<? endforeach;?>
