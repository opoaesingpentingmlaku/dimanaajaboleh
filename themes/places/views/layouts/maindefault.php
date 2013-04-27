<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kotak Jelajah</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.css" />
<?php
$cs = Yii::app()->clientScript;
$cs->scriptMap = array(
'jquery.js' => Yii::app()->request->baseUrl.'/js/jquery.js',
'jquery.ui.js' => Yii::app()->request->baseUrl.'/js/jquery.ui.js',
'jquery.yii.js' => Yii::getPathOfAlias('system.web.js.source')."/jquery.yii.js",
'jquery.nyroModal.js' => Yii::app()->request->baseUrl.'/js/jquery.nyroModal.js'
);
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCoreScript('jquery.yii');
$cs->registerCoreScript('jquery.nyroModal');
?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/tiny_mce/tiny_mce.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap-image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<!--script src="<?php //echo Yii::app()->baseUrl; ?>/js/main.js"></script-->
<script type="text/javascript" src="/kotakjelajah/js/jquery.nyroModal.js"></script>
<script language="javascript">
	$(document).ready(function(){
		$('#loginlink').nyroModal();
	});
</script>
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