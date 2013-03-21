<div class="box-best">
	<h4 class="best">BEST SUPPLIER</h4>
 <!-- other review content -->
	<h2><a href="<?php echo Yii::app()->createUrl('advisor/factory/view/id/'.$best->factory_id)?>"><?php echo $best->relfactory->company_name?></a></h2>
	<div>

		<div style="float:left;font-size:10px;"><?php $this->widget('CStarRating',array('name'=>'AdvisorReview-total-widget','value'=>$best->averageRating(),'maxRating'=>5,'minRating'=>1,'readOnly'=>true));?></div>
		<div style="float:left;font-size:10px;margin-left:5px;">
		<?php echo $best->num_reviews ?> Reviews
		</div>
		<div style="clear:both;"></div>
	</div>
	<div class="summary_rating">
		<h4>Summary Rating</h4>
		<?php 
		$ret = AdvisorReviewrating::model()->getCalculate($best->reference_code);
		foreach ( AdvisorRating::model()->findAll() as $ratings) { 
		?>
			<div style="clear:both;float:left;width:150px;margin-bottom:2px;"><?php echo $ratings->title; ?></div>
			<div style="float:left;width:100px;background:#187257;margin:2px;">
				<div style="float:left;width:<?php echo (($ret[$ratings->id]->average_rating/5)*100) ?>px;background:#90C018;cursor:pointer;" title="<?php echo round($ret[$ratings->id]->average_rating,2)?>">&nbsp;</div>
			</div>
			<div style="float:left;width:10px;margin:2px 5px;;"><?php echo $ret[$ratings->id]->num_reviews;//echo $best->detilRating($ratingstar)?></div>
			
		<?php
		}
		?>
		<div style="clear:both;"></div>

	</div>
<!-- other review content end-->
</div>