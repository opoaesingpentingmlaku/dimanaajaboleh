<?php
	$js=Yii::app()->clientScript;
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
				}else if (data.status == "error") {
					
					$.each(data.errors, function(index, value) { 
						alert(index);
					  jQuery("#error-"+index).html(value[0]).show(); 
					});
					//data.errors.each(function(i,n){alert(i+" "+n);});
				}
			  }
			});
			
		});	
	');	
?>
 <div id="modal-from-dom" class="modal hide fade">
	<div class="modal-header">
	  <a href="#" class="close">&times;</a>
	  <h3>Sign in to complete your review</h3>
	</div>
	<div class="modal-body">
		
	</div>
	<?php /*<div class="modal-footer">
	  <a href="#" class="btn primary">Primary</a>
	  <a href="#" class="btn secondary">Secondary</a>
	</div>
	*/?>
	</div>		
<div id="box-includefactory" class="form">
<h1>Include Factory</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'factory-factory-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php //echo $form->errorSummary($model); ?>

	
	<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'pre_contact'); ?>
		<?php echo $form->textField($model,'pre_contact'); ?>
		<?php echo $form->error($model,'pre_contact'); ?>
	</div>
	*/ ?>
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
	<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile'); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax'); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	*/?>
	
	
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
		<?php echo CHtml::Button('Sign Up',array('class'=>'btnsubmit','type'=>'button','id'=>'buttonsavefactory')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->