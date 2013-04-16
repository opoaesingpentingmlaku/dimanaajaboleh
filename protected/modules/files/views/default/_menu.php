<?php
var_dump($user_request->username);
die();
?>
<!--div class="box-best">
<div class="box-photo-profile" style="margin-bottom:10px;">
	<div class="mbrIcn" style="float:left;margin-right:10px;">
	<a href="/MemberProfile-cpa-a_uid.A4904A71825EA2C09B6287E749BDEA35" title="Add Photo" rel="nofollow">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/images/logo.png', $user_request->username, array('width' => 75)); ?>
	</a>
	</div>
	<div >
		<a href="<?php echo Yii::app()->createUrl('members').'/'.$user_request->username?>" rel="nofollow" class="mbrName"><?php echo $user_request->username ?></a>
		, from <?=$user_request->location?>
	</div>
	<div>
		<input type="button" name="follow" value="Follow" style="background: #BAFAFA;border:0px;color:#666" />
		<input type="button" name="message" value="Send Message" style="background: #BAFAFA;border:0px;color:#666" />
	</div>
	<div style="clear:both;"></div>
</div>
<div class="box-menu-member">
	<ul>
		<li class="firstItem mark" style="color:#666"><?=$user_request->followings?> Followings</li>
		<li class="firstItem mark" style="color:#666"><?=$user_request->followers?> Followers</li>
		<li class="firstItem mark" style="color:#666"><?=0?> Contributions</li>
		<li class="firstItem mark" style="color:#666"><?=0?> Posts</li>
		<li class="firstItem mark" style="color:#666"><?=0?> Notes</li>
		<li class="firstItem mark" style="color:#666"><?=$user_request->grade?> Grade</li>
	</ul>
</div>
</div>