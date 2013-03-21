<?php
	$js=Yii::app()->clientScript;
	$js->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-modal.js');
	$js->registerScriptFile(Yii::app()->baseUrl.'/js/term.js');
	$js->registerScript('savereview', '
			    
			jQuery("#buttonsavereview").click(function(){
				$(".error").html("").hide();
				var error = false;
				if ( !jQuery("#agreePhoto").attr("checked")){
					error = true;
					jQuery("#error-agreePhoto").html("Please check this box to agree to this statement").show(); 
				}
				
				var datas = jQuery("#formreview").serialize();
				jQuery.ajax({
				  url: "'.Yii::app()->createUrl('advisor/review/savereview').'",
				  data : datas,
				  dataType : "json",
				  type : "post",
				  success: function(data) {
					if (data.status == "needlogin"){
						jQuery.ajax({
							url: "'.Yii::app()->createUrl('site/AjaxLogin?element=formreview').'",
							success: function(datas) {
									$("#modal-from-dom").find(".modal-body").html(datas);
									$("#modal-from-dom").modal({"show":true,"backdrop":"static"});
							}
							});
					}else if (data.status == "error") {
						
						$.each(data.errors, function(index, value) { 
						 if (jQuery("#"+index).attr("file") == 1 ){
								if ( jQuery("#"+index).val() ) {
									error = true;	
									jQuery("#error-"+index).html(value[0]).show(); 	
								}	
							 }else{					 
								error = true;
							   jQuery("#error-"+index).html(value[0]).show(); 
							 }
						});
						if ( !error )
							jQuery("#formreview").submit();
					}else if (data.status == "readytosave") {
						
						
						jQuery("#formreview").submit();
					}
				  }
				});
			
		});

		jQuery(".addphotos").click(function(){
			var html;
			var numphotoshow = jQuery(this).attr("numphotoshow");
			numphotoshow++;
			html = \'<div class="photo" style="margin-top:5px;font-weight:bold;padding:0px 0px 10px 0px;">Photo \'+(numphotoshow+1)+\'</div>\'+
				\'<div><input type="file" file="1" id="photo_1" name="AdvisorReview[photo][]" size="36"><input type="hidden" id="attrphoto_1" name="AdvisorReview[attrphoto][]" value="1"></div>\'+
				\'<div style="padding:0px 0px 10px 0px;"><i>*</i> Enter your caption here </div>\'+
				\'<div><input type="text" name="AdvisorReview[photocaption][]" ></div>\'+
				\'<div id="error-photo_\'+numphotoshow+\'"  class="alert-message error" style="display:none;"></div>\'
				;
			jQuery(".boxfoto").append(html);
			jQuery(this).attr("numphotoshow",(numphotoshow));
		});	
		
	');
?>
<div id="sendback"></div>

<!-- sample modal content -->
  <div id="modal-from-dom" class="modal hide fade">
	<div class="modal-header">
	  <a href="#" class="close">&times;</a>
	  <h3>Sign in to complete your review</h3>
	</div>
	<div class="modal-body">
		
	</div>
   
  </div>
  
<?php if (Yii::app()->user->hasFlash('review_success')){ ?>  
	<div class="alert-message success">
	<a href="#" class="close">×</a>
	<p><strong>Well done!</strong> <?php echo Yii::app()->user->getFlash('review_success')?></p>
	</div>
	 
<?php } ?>
<div id="box-recentreview">
	<form method="post" action="" id="formreview" enctype="multipart/form-data">
	<h1><?php echo $factory->company_name?><br>
		<span style="font-size:10px;"><?php echo $factory->address?></span>
		
	</h1>
	<input type="hidden" name="AdvisorReview[factory_id]" value="<?php echo $_GET['id']?>">
	<div  style="margin:10px 0px;font-weight:bold;"> 
			Your overall rating of this property
	<br/>
	<?php $this->widget('CStarRating',array('name'=>'AdvisorReview[rating]','value'=> Yii::app()->request->getPost('AdvisorReview[rating]') ,'maxRating'=>5,'minRating'=>1,'titles'=>Yii::app()->getModules('advisor')->rating));?>	
	</div>
	
	<div style="clear:both;padding:10px 0px;font-weight:bold;">Title of your review</div>
	<div id="error-title"  class="alert-message error" style="display:none;"></div>
	<div>
	<input type="text" style="width:500px;" name="AdvisorReview[title]" value="<?php echo Yii::app()->request->getPost('AdvisorReview[title]')?>">
	</div>
	
	<div  style="margin:10px 0px;font-weight:bold;"> 
			Your review
	</div>
	<div id="error-review"  class="alert-message error" style="display:none;"></div>
	<div>
	<textarea style="width:500px;height:150px;" name="AdvisorReview[review]"><?php echo Yii::app()->request->getPost('AdvisorReview[review]')?></textarea>
	</div>
	
	<div>
			<div  style="margin:10px 0px;"> 
			<h1>Could you say a little more about it?(optional)</h1>
			</div>
		
		<?php foreach (AdvisorRating::model()->findAll() as $adrating){ ?>
			<div style="padding-bottom:5px;">
				<div style="display:inline-block;margin-right:10px;width:160px;"><?php echo $adrating->title?></div>
				<div style="display:inline-block">
				<?php $this->widget('CStarRating',array('name'=>'AdvisorReviewrating['.$adrating->id.']','value'=>Yii::app()->request->getPost('AdvisorReviewrating['.$adrating->id.']'),'maxRating'=>5,'minRating'=>1,'titles'=>Yii::app()->getModules('advisor')->rating));?></div>
			</div>
		<?php } ?>
		
	</div>
	
	<div  style="margin:10px 0px;"> 
		<h1>Add a tip/advise</h1>
	</div>
	
	<div id="error-review"  class="alert-message error" style="display:none;"></div>
	<div>
	<textarea style="width:500px;height:60px;" name="AdvisorReview[advice]"><?php echo Yii::app()->request->getPost('AdvisorReview[advice]')?></textarea>
	</div>
	<div id="PHOTO_BLOCK"  style="margin-bottom:5px;">
		<div  style="margin:10px 0px;"> 
		<h1>Do you have photos to share?</h1>
		</div>
		<div id="PHOTOS">
			<div class="boxfoto"  style="margin:5px 0px;padding:0px 5px;">
				<div class="photo" style="font-weight:bold;padding:0px 0px 10px 0px;">
				Photo 1
				</div>
				<div>
				<input type="file" id="photo_0" file = "1" name="AdvisorReview[photo][]" size="36">
				<input type="hidden" id="attrphoto_0" name="AdvisorReview[attrphoto][]" value="1">
				</div>
				<div style="padding:0px 0px 10px 0px;">
				<i>*</i> Enter your caption here 
				</div>
				
				<div>
				<input type="text" name="AdvisorReview[photocaption][]" >
				</div>
				<div id="error-photo_0" class="alert-message error" style="display:none;"></div>
			</div>	
			<div style="margin-left:5px;margin-bottom:5px;" class="addphotos btn" numphotoshow="0">Add another photo</div>
			
		
		
		<!-- #TOGGLEME //-->
		<div class="terms" style="margin-bottom:5px;"><i>*</i> Please check this box to agree to this statement:</div> 
		<div class="chkSet" style="padding:0px 0px 5px 0px;">
			<div for="qid203"  style="margin-bottom:5px;">
			<input type="checkbox" class="" value="1" id="agreePhoto" name="AdvisorReview[checkphoto]"> 
			I am the owner of these photos, and my posting them on Bangladvisor does not infringe upon the rights of any third party. I accept Bangladvisor's 
			<a target="_blank" href="#" onclick="alertTerm();return false;">Terms of Use</a>.
			</div>
			<div id="error-agreePhoto" class="alert-message error" style="display:none;"></div>
		</div>
		</div>
	</div>
	<div style="margin-bottom:5px;">
		<input type="button" class="btn" id="buttonsavereview" value="Submit your review"> 
	
	</div>
	</form>
</div>