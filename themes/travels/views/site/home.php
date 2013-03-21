<div id="box-recentreview">
	<h1>RECENT REVIEW</h1>
	<?php
	$no = 1;	
	foreach( AdvisorReviews::model()->RecentReview(5) as $review) {
	?>
		<div style="border-bottom:2px solid #e1e1e1;">
				<div style="float:left;padding:5px 10px;border:1px solid #ddd;margin-right:10px;"><?php echo $no?></div>
				
					<h1 style="margin-top:10px;"><a href="<?php echo Yii::app()->createUrl('advisor/factory/view/id/'.$review->getFactory()->relfactory->id)?>"><?php echo $review->getFactory()->relfactory->company_name;?></a><br>
					<span style="font-size:11px;"><?php echo $review->getFactory()->relfactory->address;?></span>
					</h1>
				
				
				<h2><a href="#"><?php echo $review->title?></a></h2>
				<div style="float:left;margin-right:10px;">
				<?php $this->widget('CStarRating',array('name'=>'AdvisorReview'.$review->id,'maxRating'=>5,'minRating'=>1,'readOnly'=>true,'value'=>$review->rating));?>
				</div>
				<span class="posted"> <?php echo date('M d, Y',$review->create_date) ?>
				| By: <a href="<?php echo Yii::app()->createUrl('/members/').'/'.User::model()->findByPk($review->user_id)->username?>"><?php echo User::model()->findByPk($review->user_id)->username?></a></span>
				
			<p>
			<?php echo $review->review ?><br>
			<?php 
				$a = $review->getPhotos();
				if ( !empty($a) ){ ?>
				<div class="photos">
					<div>
					<?php foreach ((array)$review->getPhotos() as $photo){ ?>
						<img src="<?php echo Yii::app()->baseUrl.'/photos/review_'.$review->id.'/thumb/'.$photo->filename?>" width="50">
					<?php } ?>
					</div>
					
				</div>
				<?php } ?>
			<a class="readmore" href="<?php echo Yii::app()->createUrl('advisor/factory/view/id/'.$review->getFactory()->relfactory->id)?>">Read full review</a><br>
			</p>
			<div style="clear:both;"></div>
		</div>
	<?php
	$no++;
	} ?>
</div>