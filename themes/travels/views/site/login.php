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
		)); ?>
          	<label>Name:</label><input type="text" name="LoginForm[username]" value="<?php echo (!empty($_POST['LoginForm']['username']) ? $_POST['LoginForm']['username'] : '' ); ?>" /><br />
          <label>Password</label><input type="password" name="LoginForm[password]"/><br />
		  <?php echo $form->error($model,'password'); ?>
          <input type="submit" value=" LOGIN" class="btnlogin" /><a href="#">Forgot your password?</a>
		
		<?php $this->endWidget(); ?>
      </div>

</div><!-- form -->
