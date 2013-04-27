<div id="box-signup">
      	<div class="box-login-header">Change Password</div>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableAjaxValidation'=>true,
		)); ?>
          	<div class="row">
				<?php
				echo $form->labelEx($model,'oldpassword');
				echo $form->textField($model,'oldpassword');
				echo $form->error($model,'oldpassword');
				?>
			</div>
			
			<div class="row">
				<?php
				echo $form->labelEx($model,'newpassword');
				echo $form->textField($model,'newpassword');
				echo $form->error($model,'newpassword');
				?>
			</div>
			
			<div class="row">
				<?php
				echo $form->labelEx($model,'renewpassword');
				echo $form->textField($model,'renewpassword');
				echo $form->error($model,'renewpassword');
				?>
			</div>
			<input type="submit" value="SAVE" class="btnlogin" />
		
		<?php $this->endWidget(); ?>
      </div>

</div>