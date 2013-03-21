<table class="exp-stats"> 

	 <tbody> 
	  <tr class="header"> 
	  <th >User</th>
	  <th >Factories</th>
	  <th >Reviews</th>
	  <th>Register Date </th> 
	  <th>--</th> 
	  </tr>  
	<?php 
	foreach ($members as $k=>$member){
		
	?>
	 <tr class="labels"> 
	 <td ><?php echo $member->first_name?> <?php echo $member->last_name?><br><span><?php echo $member->username?></span></td> 
	
	 <td><?php echo (UserOptions::model()->getValue($member->id,'factories_num') ? UserOptions::model()->getValue($member->id,'factories_num') : 0)?> factories</td>
	 <td><?php echo (UserOptions::model()->getValue($member->id,'reviews_num') ? UserOptions::model()->getValue($member->id,'reviews_num') : 0)?> reviews	</td>
	 <td></td>
	 <td>
	delete
	</td>
	 </tr>  
	<?php } ?>
	</tbody> </table>
	<div>
	<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
</div>