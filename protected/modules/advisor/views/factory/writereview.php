<?php /* jquery request */
Yii::app()->clientScript->registerScript('writereview', '
	jQuery("#searchsubmit").click(function(){
		var data =  jQuery("#search-form").serialize();
		jQuery.ajax({
		  url: "'.Yii::app()->createUrl('advisor/review/SearchAjax').'",
		  data : data,
		  type : "post",
		  success: function(data) {
			jQuery("#box-resultwritereview").html(data);
			
		  }
		});
		return false;
	});	
');
?>
<div id="box-recentreview">
	<h1>Write a Review</h1>
	<h2>What would you like to review?</h2>
	<form method="get" id="search-form">
	<div class="row"><input type="text" id="query" name="query" class="textsearch"></div>
	<div class="row">
	<input type="submit" id="searchsubmit" class="orig" value="Search …">
	</div>
	</form>
</div>
<div id="box-resultwritereview" style="margin-top:10px;">
	
</div>