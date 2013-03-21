<?php
	$js=Yii::app()->clientScript;
	$js->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-modal.js');
	$js->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-modal.js');
	$js->registerScript('savereview', '
	jQuery("#buttonsavefactory").click(function(){
		
		var datas = jQuery("#factory-factory-form").serialize();
		jQuery.ajax({
		  url: "'.Yii::app()->createUrl('advisor/factory/savefactory').'",
		  data : datas,
		  dataType : "json",
		  type : "post",
		  success: function(data) {
			
			if (data.status == "needlogin"){
				jQuery.ajax({
					url: "'.Yii::app()->createUrl('site/AjaxLogin?element=factory-factory-form').'",
					success: function(datas) {
							$("#modal-from-dom").find(".modal-body").html(datas);
							$("#modal-from-dom").modal({"show":true,"backdrop":"static"});
					}
					});
			} else if (data.status == "notallowed") {
				
				$("#modal-from-dom").find(".modal-body").html("'.Yii::t('notallowed','Your account does not allowed to modify this factory.').'");
				$("#modal-from-dom").find(".modal-header span").html("'.Yii::t('error','Error').'");
				$("#modal-from-dom").modal({"show":true,"backdrop":"static"});
				
			} else if (data.status == "error") {
				
				$.each(data.errors, function(index, value) { 
				  jQuery("#error-"+index).html(value[0]).show(); 
				});
				
			} else if (data.status == "success") {
					location.href = "'.Yii::app()->createUrl('advisor/factory/update/id/').'/"+data.param.id;
			}
		  }
		});
		});	
	');	
?>
 <div id="modal-from-dom" class="modal hide fade">
	<div class="modal-header">
	  <a href="#" class="close">&times;</a>
	  <span  style="font-weight:bold;"><?php echo Yii::t('label_signin','Sign in to complete.')?></span>
	</div>
	<div class="modal-body">
	</div>
</div>
<?php if ( Yii::app()->user->hasFlash("factorysuccess")){ ?>		
<div class="alert-message success">
<a href="#" class="close">×</a>
<p><strong>Well done!</strong> <?php echo Yii::app()->user->getFlash("factorysuccess")?></p>
</div>
<?php } ?>

<div id="box-includefactory" class="form">

<h1>Include Factory</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'factory-factory-form',
	'enableAjaxValidation'=>true,
)); ?>
	<?php echo $form->hiddenField($model,'id'); ?>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name'); ?>
		<?php echo $form->error($model,'company_name',array('id'=>'error-company_name')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'contact_person'); ?>
		<?php echo $form->textField($model,'contact_person'); ?>
		<?php echo $form->error($model,'contact_person'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textarea($model,'address'); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'telp_number'); ?>
		<?php echo $form->textField($model,'telp_number'); ?>
		<?php echo $form->error($model,'telp_number'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'distric'); ?>
		<?php echo $form->textField($model,'distric'); ?>
		<?php echo $form->error($model,'distric'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city'); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::Button('Save',array('class'=>'btnsubmit','type'=>'button','id'=>'buttonsavefactory')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->