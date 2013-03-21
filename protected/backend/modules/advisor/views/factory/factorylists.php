<table class="exp-stats"> 

	 <tbody> 
	  <tr class="labels"> 
	  <td colspan="5">Factory</td>
	  <td colspan="5">Creator</td>

	  <td>Contact Person</td> 
	  <td>Post date </td> 
	  <td>Status</td> 
	   
	  <td>--</td> 
	  </tr>  
	<?php 
	foreach ($factories as $k=>$factory){
		
	?>
	 <tr class="labels"> <td colspan="5"><?php echo $factory->company_name?></td> 
	 <td colspan="5">
	 <?php $creator = $factory->getCreator();
	 echo ($creator ? $creator->username : '');
	 ?>
	
	 </td> 
	 <td><?php echo $factory->contact_person?></td>
	 <td><?php echo ($factory->date_created ? date('d M Y',$factory->date_created) : '-')?></td> 
	 <td><?php echo $factory->status?></td> 
	 <td>
	</td> 
	<td>
	<span class="label important deletefactory" data-id="<?php echo $factory->id?>" >
		<a href="<?php echo Yii::app()->createUrl('/admin/advisor/factory/delete/id/'.$factory->id);?>" onclick="return confirm ('Are you sure to delete ?');">Delete</a>
		<?php if ( $factory->status == 'pending' ) { ?>
		<a href="<?php echo Yii::app()->createUrl('/admin/advisor/factory/setpublish/id/'.$factory->id);?>" onclick="return confirm ('Are you sure to publish ?');">publish</a>
		<?php } ?>
	</span>
	</td>
	 </tr>  
	<?php } ?>
	</tbody> </table>
	<div>
	<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
</div>