<!doctype html>
<html>
  <head>
    <title>Real Eats</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width = device-width, height = device-height, maximum-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="resources prefetch" href="<?php echo Yii::app()->request->getBaseUrl()?>/magazine/default/resources" />
	<link rel="contents <?php echo $this->dotoc?>" href="<?php echo Yii::app()->request->getBaseUrl()?>/magazine/default/toc" />
    <link rel="apple-touch-icon-precomposed" href="resources/apple-touch-icon-precomposed.png" />
    <link rel="shortcut icon" href="resources/favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
   
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/treesaver.js"></script>
	<link href="http://cloud.webtype.com/css/c0c3f7a2-9704-47ae-84ef-5fb316a279c9.css" rel="stylesheet" type="text/css" />
	
  </head>
  <body>
	<?php echo $content ?>
  </body>
</html>
