<?php
Yii::app()->clientScript->scriptMap=array(
	'jquery.min.js'=>Yii::app()->baseUrl.'/js/jquery.min.js',
 );
 
//Yii::app()->clientScript->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-modal.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/lib/jquery.jcarousel.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/lib/slide.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/lib/skins/ie7/skin.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/lib/gallery/css/elastislide.css');
Yii::app()->clientScript->registerScript('factory', '
	jQuery(".showme").click(function(){
		jQuery(".bigphotos").find("img").attr("src",jQuery(this).attr("href"));
	});
	
	jQuery("#mycarousel").jcarousel({
        scroll: 1,
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null
    });
	
	jQuery("#mycarouselx").jcarousel({
		scroll:3,
		
    });
	
	jQuery(".clickphoto").click(function(){
		var idphoto = jQuery(this).attr("idphoto");
		jQuery("#photo_"+idphoto).attr("index");
		Gallery.setOpt({"optcur":jQuery("#photo_"+idphoto).attr("index")});
		$("#modal-from-dom").modal({"show":true,"backdrop":"static"});
	});
	
	jQuery(".seephotos").click(function(){
		
		$("#modal-from-dom").modal({"show":true,"backdrop":"static"});
	});
');

$a = $data->factory->getPhotos(); 
?>

<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
	<div class="rg-image-wrapper">
		{{if itemsCount > 1}}
			<div class="rg-image-nav">
				<a href="#" class="rg-image-nav-prev">Previous Image</a>
				<a href="#" class="rg-image-nav-next">Next Image</a>
			</div>
		{{/if}}
		<div class="rg-image"></div>
		<div class="rg-loading"></div>
		<div class="rg-caption-wrapper">
			<div class="rg-caption" style="display:none;">
				<p></p>
			</div>
		</div>
	</div>
</script>

<!-- sample modal content -->
<div id="modal-from-dom" class="modal hide fade">
	<div class="modal-header">
	  <a href="#" class="close">&times;</a>
	  <span style="font-weight:bold;">All photos of <?php echo $data->factory->company_name?></span>
	</div>
	<div class="modal-body">
		<div id="rg-gallery" class="rg-gallery">
		<div class="rg-thumbs">
			<!-- Elastislide Carousel Thumbnail Viewer -->
			<div class="es-carousel-wrapper">
				<div class="es-nav">
					<span class="es-nav-prev">Previous</span>
					<span class="es-nav-next">Next</span>
				</div>
				<div class="es-carousel">
				<ul>
					<?php if ( $a ) {  ?>
					<?php foreach ((array)$a as $idx => $photo){ ?>
						<li><a href="#" ><img src="<?php echo Yii::app()->baseUrl.'/photos/review_'.$photo->review_id.'/thumb/'.$photo->filename?>" width="65" height="65" index="<?php echo $idx?>" id="photo_<?php echo $photo->id?>" data-large="<?php echo Yii::app()->baseUrl.'/photos/review_'.$photo->review_id.'/'.$photo->filename?>" alt="image24" data-description="<?php echo $photo->caption?>" /></a></li>
					<?php } 
					}?>
				</ul>
				</div>
			</div>
			</div>
		</div>
	</div>

</div>

<div class="detil">
	<h1><?php echo $data->factory->company_name?><br>
		<span style="float:left;font-size:10px;"><?php echo $data->factory->address?></span>
		<span style="float:right;font-size:10px;margin-left:5px;">
		<?php echo $data->factoryReview->num_reviews ?> Reviews
		</span>
		<?php if ( $data->factoryReview->num_reviews > 0 ) {?>
		<span style="float:right;font-size:10px;">
		<?php $this->widget('CStarRating',array('name'=>'AdvisorReview-total','value'=>$data->factoryReview->averageRating(),'maxRating'=>5,'minRating'=>1,'readOnly'=>true));?>
		</span>
		<?php } ?>
		<div style="clear:both;"></div>
		
	</h1>
	<div id="content-factory">
		<?php 
		
		if ( $a ) { 
		
		?>
		
		<div class="photos" style="float:left;width:170px;">
			<?php 
			if ( !empty($a) ){ ?>
			<div class="bigphotos">
				
			  
				<img src="<?php echo Yii::app()->baseUrl.'/photos/review_'.$a[0]->review_id.'/'.$a[0]->filename?>" width="150">
			</div>
			
			<?php } ?>
			 <a href="#" id="mycarousel-prev">&laquo; Prev</a>
			<ul id="mycarousel" class="jcarousel-skin-ie7">
				<?php foreach ((array)$a as $photo){ ?>
				<!-- The content will be dynamically loaded in here -->
				<li><a href="<?php echo Yii::app()->baseUrl.'/photos/review_'.$photo->review_id.'/'.$photo->filename?>" class="showme" title="" onclick="return false;">
					<img src="<?php echo Yii::app()->baseUrl.'/photos/review_'.$photo->review_id.'/'.$photo->filename?>" width="50" height="50" border="0" />
				</a>
				</li>
				<?php } ?>
				
			</ul>
			 <a href="#" id="mycarousel-next">Next &raquo;</a>
			 <a href="#" class="seephotos">See All Photos</a>
		</div>
		<?php } ?>
		<div style="float:left;width:350px;">
			<div class="row">
			<span>Address : </span>
			<span><?php echo $data->factory->address?></span>
			</div>
			<div class="row">
			<span>City : </span>
			<span><?php echo $data->factory->city?></span>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	
	<h1 style="padding:10px 0px;font-weight:bold;"><div style="float:left;color:green;">Reviews from our community</div>
	<div style="float:right;" class="button"><a href="<?php echo Yii::app()->createUrl('advisor/review/write/id/'.$data->factory->id);?>">Write Review</a></div><div style="clear:both;"></div></h1>
	<div class="summary_rating">
		<h4>Summary Rating</h4>
		<?php 
		$ret = AdvisorReviewrating::model()->getCalculate($data->factoryReview->reference_code);
		foreach ( AdvisorRating::model()->findAll() as $ratings) { 
		?>
			<div style="clear:both;float:left;width:150px;margin-bottom:2px;"><?php echo $ratings->title; ?></div>
			<div style="float:left;width:100px;background:#187257;margin:2px;">
				<div style="float:left;width:<?php echo (($ret[$ratings->id]->average_rating/5)*100) ?>px;background:#90C018;cursor:pointer;" title="<?php echo round($ret[$ratings->id]->average_rating,2)?>">&nbsp;</div>
			</div>
			<div style="float:left;width:10px;margin:2px 5px;;"><?php echo $ret[$ratings->id]->num_reviews;?></div>
		<?php
		}
		?>
		<div style="clear:both;"></div>

	</div>
	<div style="clear:both"></div>
	<!-- review listing -->
	<div id="reviews-list" style="margin-top:10px;">
		<div id="rewiews-list-header" style="border-top:1px solid #eee;border-bottom:1px solid #eee;padding:5px 0px;">
			<div style="float:left;"><?php echo Yii::t('Reviews','{num} Reviews',array('{num}'=>$data->factoryReview->num_reviews));?></div>
			<div style="float:right;font-weight:bold;"><?php echo ($pages->offset+1).' - '.(($pages->offset)+count($data->show_reviews));?> Reviews</div>
			<div style="clear:both"></div>
		</div>
		<div id="show-reviews">
			<?php
			foreach( (array)$data->show_reviews as $review) {
			
			?>
			<div>
			<div style="float:left;padding:10px;" class="user-reviews">
			<div style="border:1px solid #aaa;width:74px;height:74px;">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/no_user_photo.gif'); ?>
			<div><a href="<?php echo Yii::app()->createUrl('members').'/'.User::model()->findByPk($review->user_id)->username?>"><?php echo User::model()->findByPk($review->user_id)->username?></a></div>		
			</div>
			</div>
			<div style="float:left;width:400px;">
				<h2><a href="#"><?php echo $review->title?></a></h2>
				<div style="float:left;margin-right:10px;">
				<?php $this->widget('CStarRating',array('name'=>'AdvisorReview-'.$review->id.'[rating]','value'=>$review->rating,'maxRating'=>5,'minRating'=>1,'readOnly'=>true));?>
				
				</div>
				<span class="posted">  <?php echo date('M d, Y',$review->create_date)?> 
				| By: <a href="<?php echo Yii::app()->createUrl('members').'/'.User::model()->findByPk($review->user_id)->username?>"><?php echo User::model()->findByPk($review->user_id)->username?></a></span>
				
				<div style="clear:both;">
				<?php echo nl2br($review->review) ?>
				</div>
				<?php 
				$a = $review->getPhotos();
				if ( !empty($a) ){ ?>
				<div class="photos">
					<?php foreach ((array)$review->getPhotos() as $photo){ ?>
						<img src="<?php echo Yii::app()->baseUrl.'/photos/review_'.$review->id.'/thumb/'.$photo->filename?>" width="50" class="clickphoto" idphoto="<?php echo $photo->id?>">
					<?php } ?>
					
				</div>
				<?php } ?>
				<div style="margin-top:10px;font-size:12px;">
				<?php foreach ( (Array) $review->RatingReview() as $ratingreview){ ?>
					<div style="padding-bottom:5px;">
						<div style="display:inline-block;margin-right:10px;width:160px;"><?php echo $ratingreview->relrating->title?></div>
						<div style="display:inline-block">
						<?php 
						
						$this->widget('CStarRating',array('name'=>'AdvisorReviewrating-'.$review->id.'['.$ratingreview->rating_id.']','value'=>$ratingreview->value,'maxRating'=>5,'minRating'=>1,'readOnly'=>true,'titles'=>Yii::app()->getModules('advisor')->rating));?></div>
					</div>
				<?php } ?>
				
				</div>
			</div>
			<div class="clear" style="clear:both;"></div>
			</div>
			<?php } ?>
		</div>
	</div>
	
	<div>
	<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
	</div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/js/lib/gallery/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/js/lib/gallery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/js/lib/gallery/jquery.elastislide.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/js/lib/gallery/gallery.js"></script>