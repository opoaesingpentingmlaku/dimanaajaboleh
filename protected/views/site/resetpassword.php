
<div id="box-signup">
      	<div class="box-login-header">Reset Bangladvisor Password (<?php echo $userexists->email?>)</div>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'resetpassword-form',
			'enableAjaxValidation'=>false,
		)); 
			echo $form->hiddenField($model,'email',array('value'=>$userexists->email));
		
		?>
		
          	<div class="row">
				<?php
				echo $form->labelEx($model,'password');
				echo $form->textField($model,'password');
				echo $form->error($model,'password');
				?>
			</div>
			<div class="row">
				<?php
				echo $form->labelEx($model,'repassword');
				echo $form->textField($model,'repassword');
				echo $form->error($model,'repassword');
				?>
			</div>
			
			
			<input type="submit" value=" Reset" class="allbtn" />
		
		<?php $this->endWidget(); ?>
      </div>

</div>

