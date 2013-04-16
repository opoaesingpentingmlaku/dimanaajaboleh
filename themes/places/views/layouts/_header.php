<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/nyroModal.css" />
 <div id="header">
  	
    <!-- logo -->
    <div class="logo" style="font-size:24px;">
    	<a href="<?php echo Yii::app()->baseUrl?>">
			<img src="<?php echo Yii::app()->baseUrl; ?>/images/logo.png" alt="logo" border="0" width="50" />
		</a>
    </div>
    <!-- logo end -->
    
    <!-- topmenu-->
    <div id="topright">
		<ul id="topmenu">
			<?php if ( !Yii::app()->user->isGuest ) { ?> <li>Hi, <a href="<?php echo Yii::app()->createUrl('/members/').'/'.Yii::app()->user->name?>" title="profile"	><b><?php echo Yii::app()->user->name ?></b></a></li><?php } ?>
			<li><a href="<?php echo Yii::app()->createUrl('/')?>">HOME</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('/site/page')?>">ABOUT US</a></li>
			<li class="signup"><?php if ( Yii::app()->user->isGuest ) { ?><a href="<?php echo Yii::app()->createUrl('/site/signup')?>">SIGN UP <span class="red">(FREE)</span></a><?php } else { ?><a href="<?php echo Yii::app()->createUrl('site/logout')?>">SIGN OUT </a><?php } ?></li>
			<?php if(!Yii::app()->user->id ){ ?><li><a id="loginlink" href="<?php echo Yii::app()->createUrl('/site/login')?>" class="nyroModal">Login</a></li><?php } ?>
		</ul>      
    </div>
    <div id="topright2">
    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/fb.png" alt="fb" border="0" /></a>
		<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/tw.png" alt="tw" border="0" /></a>
    </div>
    <!-- topmenu end-->
  </div>
  <!-- header end -->