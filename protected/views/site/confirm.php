<?php
if ( Yii::app()->user->hasFlash('success_confirm') ) { 
?>
<div id="box-signup">
   <div class="box-login-header"><?php echo Yii::app()->user->getFlash('success_confirm_title')?></div>
   <p style="margin:10px;"><?php echo Yii::app()->user->getFlash('success_confirm')?></p>
</div>
<?php } ?>

