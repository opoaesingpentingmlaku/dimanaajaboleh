<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div id="box-login">
      	<div class="box-login-header">LOGIN FORM</div>
		<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableAjaxValidation'=>true,
				'stateful'=>true, 'htmlOptions'=>array('enctype' => 'multipart/form-data'),
				'clientOptions'=>array(
					'validateOnType'=>true,
				)
			));
		?>
			<?php
				echo $form->labelEx($model,'username');
				echo $form->textField($model,'username');
				echo $form->error($model,'username');
			?>
			<?php
				echo $form->labelEx($model,'password');
				echo $form->textField($model,'password');
				echo $form->error($model,'password');
			?>
          <input type="submit" value=" LOGIN" class="btnlogin" /><a href="#">Forgot your password ?</a>
		
		<?php $this->endWidget(); ?>
      </div>

</div><!-- form -->
