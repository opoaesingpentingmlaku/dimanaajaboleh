<div style="display: block; height:345px" class="detil">
	<div style="float:left;">
		<img src="../../images/blur.jpg" />
	</div>
	<div id="userinfo">
		<?php
			$pathimg = '../../images/';
			$pathimg .= ($user->avatar) ? $user->avatar : 'avatar_default_male.jpg';
		?>
		<div align="center" class="avatar">
			<img src='<?=$pathimg?>' width="100" />
			<?php
				if(!Yii::app()->user->isGuest && Yii::app()->user->name == $user->username){
			?>
			<div class="btnchange" style="width: 100px"><a id="changeava" href="user/changeavatar" >Change</a></div>
			<?php } ?>
		</div>
		<div style="clear:both"></div>
		<div align="center"><?=$user->fullname?></div>
		<div align="center"><?=$user->location?></div>
		<div align="center">
			<span id="follow">
			<?php
				$user_id = 0;
				if(!Yii::app()->user->isGuest){
					$user_id = Yii::app()->user->id;
				}
				if($followed == true){
			?>
			<input type="button" name="unfollow" value="Unfollow" class="btnact" onclick="unfollow(<?=$user_id?>, <?=$user->id?>)" />
			<?php
				}else{
			?>
			<input type="button" name="follow" value="Follow" class="btnact" onclick="follow(<?=$user_id?>, <?=$user->id?>)" />
			<?php } ?>
			</span>
			<input type="button" name="message" value="Send Message" class="btnact" />
		</div>
	</div>
	
	<div class="block-info">
		<ul align="center">
			<li>
				<div>Followings</div>
				<div id="followings"><?=$user->followings?></div>
			</li>
			<li>
				<div>Followers</div>
				<div id="followers"><?=$user->followers?></div>
			</li>
		</ul>
	</div>
	
	<div class="block-info">
		<ul align="center">
			<li>
				<div>POST</div>
				<div><?=$user->posts?></div>
			</li>
			<li>
				<div>Contribution</div>
				<div><?=$user->contributions?></div>
			</li>
			<li>
				<div>Grade</div>
				<div><?=$user->grade?></div>
			</li>
		</ul>
	</div>
</div>

<script language="javascript">
	$(document).ready(function(){
		$('#changeava').nyroModal();
	});

	function follow(fans_id, user_id){
		if(fans_id == 0){
			alert("Who Are You");
		}else{
			$.ajax({
				type: "POST",
				url: 'user/follow',
				data: {fans_id: fans_id, user_id: user_id},
				success: function(data){
					if(data == "success"){
						$('#follow').html('<input type="button" name="unfollow" value="Unfollow" class="btnact" onclick="unfollow('+fans_id+', '+user_id+')" />');
						$('#followers').html(int($('#followers').text) + 1);
					}
				}
			});
		}
	}
	
	function unfollow(fans_id, user_id){
		$.ajax({
			type: "POST",
			url: 'user/unfollow',
			data: {fans_id: fans_id, user_id: user_id},
			success: function(data){
				if(data == "success"){
					$('#follow').html('<input type="button" name="follow" value="Follow" class="btnact" onclick="follow('+fans_id+', '+user_id+')" />');
					$('#followers').html(int($('#followers').text) - 1);
				}
			}
		});
	}
</script>