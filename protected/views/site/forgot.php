

<div id="box-signup">
   <div class="box-login-header">Forgot your password?</div>
   <?php if ( Yii::app()->user->hasFlash('error') ){ ?>
   <div class="errorMessage" style="margin:10px;">
   <?php echo Yii::app()->user->getFlash('error')?>
   </div>
   <?php } ?>
	<div class="padLRT">
	<div class="ovrVw"  style="margin:10px;">
	We'll send you an e-mail to reset it. </div>
	<form name="MemberSignIn" method="post">
		<input type="hidden" value="FORGOT_PASS" name="action">
		<div style="width:194px;" id="regErrorBlock">
		</div>
		<div class="fldSet ">
			<label for="email">E-mail address</label>
			<input type="text" tabindex="1" value="" name="email" id="email" class="text">
		</div>
		<div class="withBtn">
			
			<div >
				<input type="submit" class="allbtn" value="Submit" tabindex="2">
			</div>
		</div>
	</form>
	</div> 
</div>