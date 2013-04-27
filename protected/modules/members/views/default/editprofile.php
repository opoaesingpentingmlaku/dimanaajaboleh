<div id="box-signup">
      	<div class="box-login-header">Edit Profile</div>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableAjaxValidation'=>true,
		)); ?>
          	<div class="row">
				<?php
				echo $form->labelEx($model,'fullname');
				echo $form->textField($model,'fullname');
				echo $form->error($model,'fullname');
				?>
			</div>
			<div class="row">			
				<?php
				echo $form->labelEx($model,'username');
				echo $form->textField($model,'username');
				echo $form->error($model,'username');
				?>
          	</div>
			<div class="row">			
				<?php
				echo $form->labelEx($model,'email');
				echo $form->textField($model,'email');
				echo $form->error($model,'email');
				?>
          	</div>
			
			<div class="row">
				<?php
				echo $form->labelEx($model,'birthdate');
				echo $form->textField($model,'birthdate');
				echo $form->error($model,'birthdate');
				?>
          	</div>
			<div class="row">
				<?php
				echo $form->labelEx($model,'company');
				echo $form->textField($model,'company');
				echo $form->error($model,'company');
				?>
          	</div>
			<div class="row">
				<?php
				echo $form->labelEx($model,'location');
				echo $form->textField($model,'location');
				echo $form->error($model,'location');
				?>
          	</div>
			
			<input type="submit" value="SAVE" class="btnlogin" />
		
		<?php $this->endWidget(); ?>
      </div>

</div>