<?php
$this->pageTitle=Yii::app()->name . ' - Peta';
$this->breadcrumbs=array(
	'Peta',
);
?>

<script type="text/javascript" src="http://extjs.cachefly.net/ext-3.2.1/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="http://extjs.cachefly.net/ext-3.2.1/ext-all.js"></script>
<link rel="stylesheet" type="text/css" href="http://extjs.cachefly.net/ext-3.2.1/resources/css/ext-all.css" />
<?php /* <link rel="stylesheet" type="text/css" href="http://extjs.cachefly.net/ext-3.2.1/examples/shared/examples.css" />*/ ?>
<script src="http://www.openlayers.org/api/2.10/OpenLayers.js"></script>
<script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAjpkAC9ePGem0lIq5XcMiuhR_wWLPFku8Ix9i2SXYRVK3e45q1BQUd_beF8dtzKET_EteAjPdGDwqpQ'></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/script/GeoExt.js"></script>
<script type="text/javascript" src="http://demo.opengeo.org/geoserver/pdf/info.json?var=printCapabilities"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/versi3.js"></script>

<div id="peta"></div>
<div id="desc"></div>
<div id="view"></div>