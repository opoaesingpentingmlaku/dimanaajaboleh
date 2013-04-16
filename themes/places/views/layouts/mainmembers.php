<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bangladvisor</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css" />
</head>
<body>
<!-- wrapper start -->
<div id="wrapper">
	
  <!-- header start -->
  <?php 
	include('_header.php');
  ?>
  <!-- form end -->
    
  <!-- container start -->
  <div id="container">
    <?php echo $content; ?>
  </div>
  <!-- container end -->
</div>
<!-- wrapper end -->
</body>
</html>