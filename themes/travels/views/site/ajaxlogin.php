<?php 
	$js=Yii::app()->clientScript;
	$js->registerScript('ajaxlogin', '
		jQuery("#login").click(function(){
			var datas = jQuery("#formloginajax").serialize();
			jQuery.ajax({
				url: "'.Yii::app()->createUrl('site/AjaxLogin').'",
				  data : datas,
				  type : "post",
				  success: function(data) {
					if (data == "success") {
						jQuery("'.$element.'").'.$action.'();
					}else{
						jQuery(".alert-message p").html("Your username is not valid");
						jQuery(".alert-message").show();
					}
				  }
				
			});
			
		});	
	
	');
?>	
<div style="">
	<h4>Sign in to your Bangladvisor account. </h4>
	<form name="form" method="post" id="formloginajax" action="<?php echo Yii::app()->createUrl('site/login')?>">
	<div class="alert-message error" style="display:none;">
	<a href="#" class="close">×</a>
	<p><strong>Well done!</strong> <?php echo Yii::app()->user->getFlash("factorysuccess")?></p>
	</div>
	<div class="row">
	<label>Username:</label>
	
	<input type="text" name="LoginForm[username]" value="<?php echo (!empty($_POST['LoginForm']['username']) ? $_POST['LoginForm']['username'] : '' ); ?>" />
	
	</div>
	<div id="error-username"></div>
	<div class="row">
	<label>Password</label><input type="password" name="LoginForm[password]"/>
	</div>
	<div class="row">
	<label></label>
	<input type="button" id="login" value="LOGIN" class="btnlogin" /> <a href="<?php echo Yii::app()->createUrl('site/forgot');?>" target="blank">Forgot your password?</a>
	</div>
	<div id="error-password"></div>
	</form>
</div>
<div class="modal-footer">
 Don't have a BanglAdvisor account ? <a href="<?php echo Yii::app()->createUrl('site/signup');?>" target="blank">Register</a>
</div>
<div style="clear:both;"></div>