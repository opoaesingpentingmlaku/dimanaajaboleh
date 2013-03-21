<table class="exp-stats"> 

	 <tbody> 
	  <tr class="labels"> 
	  <th >No</th>
	  <th width="500" >Review</th>
	  <th >Review Creator</th>
	  <th >Factory</th>

	  <th>Rate</th> 
	  <th>Post date </th> 
	  <th>Status</th> 
	   <th>Photo</th> 
	  <td>--</td> 
	  </tr>  
	<?php 
	foreach ($reviews as $k=>$review){
		$a = $review->getPhotos();

	?>
	 <tr class="labels">
	 <td ><?php echo $pages->getCurrentPage()+($k+1);?></td> 
	 <td ><h4><?php echo $review->title?></h4>
	 <?php echo nl2br($review->review) ?>
	 
	 </td> 
	 <td ><?php echo $review->user->username?></td> 
	 <td >
	 
	 <?php $factory = $review->getFactory();?>
	 <?php echo $factory['relfactory']['company_name']?>
	 
	 </td> 
	 <td><div><?php $this->widget('CStarRating',array('name'=>'AdvisorReview'.$review->id,'maxRating'=>5,'minRating'=>1,'readOnly'=>true,'value'=>$review->rating));?></div>
	 <div style="clear:both;"></div>
	 <div style="margin-top:10px;border:1px solid #aaa;padding:5px;">
	 
	<?php foreach ( (Array) $review->RatingReview() as $ratingreview){ ?>
		<div style="padding-bottom:5px;">
			<div style="display:inline-block;margin-right:10px;width:160px;"><?php echo $ratingreview->relrating->title?></div>
			<div style="display:inline-block">
			<?php 
			
			$this->widget('CStarRating',array('name'=>'AdvisorReviewrating-'.$review->id.'['.$ratingreview->rating_id.']','value'=>$ratingreview->value,'maxRating'=>5,'minRating'=>1,'readOnly'=>true,'titles'=>Yii::app()->getModules('advisor')->rating));?></div>
		</div>
	<?php } ?>
	
	</div>
		<div style="clear:both;"></div>
	 </div>
	 </td>
	 <td><?php echo date('d M Y',$review->create_date)?></td> 
	 <td><?php echo $review->status?></td> 
	 <td><?php if ( !empty($a) ){ ?>
		<div class="photos">
			<img src="<?php echo Yii::app()->baseUrl.'/photos/review_'.$a[0]->review_id.'/'.$a[0]->filename?>" width="50">
		</div>
	<?php } ?>
	</td> 
	<td>
	<span class="label important deletefactory" data-id="<?php echo $review->id?>" >
		<a href="<?php echo Yii::app()->createUrl('/admin/advisor/review/delete/id/'.$review->id);?>" onclick="return confirm ('Are you sure to delete ?');">Delete</a>
		<?php if ( $review->status == 'pending' ) { ?>
		<a href="<?php echo Yii::app()->createUrl('/admin/advisor/review/setpublish/id/'.$review->id);?>" onclick="return confirm ('Are you sure to publish ?');">publish</a>
		<?php } ?>
	</span>
	</td>
	 </tr>  
	<?php } ?>
	</tbody> </table>
	<div>
	
	<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
	
	
</div>