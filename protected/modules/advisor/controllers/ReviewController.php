<?php

class ReviewController extends Controller
{
	
	public $layout='//layouts/maindefault';
	
	public function actionIndex()
	{
		$this->render('index',array('dotoc'=>'prefetch'));
	}
	
	public function actionSearchfactory()
	{
		$this->render('writereview');
		
	}
	
	public function actionWrite($id)
	{	
		$factory = Factory::model()->findByPk($id);
		
		if ( Yii::app()->request->getIsPostRequest() ){
			if ( Yii::app()->user->isGuest ) {
				$error = 'You must login';
			} else {
				if ( $this->savereview() ){
					$this->redirect(Yii::app()->createUrl('advisor/review/write'));
				}
			}	
		}
		
		$this->render('formwritereview',array('factory'=>$factory));
	}	
	
	/* search company by using ajax */
	public function actionSearchAjax()
	{
		if ( !empty($_POST['query']) ) {
			$criteria = new CDbCriteria;
			$criteria->compare('company_name',$_POST['query'],true);
			$searchQuery = Factory::model()->findAll($criteria);
		}
		
		echo $this->renderPartial('search_company',array('searchQuery'=>$searchQuery));
		
	}
	
	/* delete review by user owner*/
	/*public function actionDelete($id)
	{
		if ( !empty($id) && ( !Yii::app()->user->isGuest )  ) {
			
			$deleteReview = AdvisorReviews::model()->findByPk($id);
			
			if ( $deleteReview ) {
				if ( $deleteReview->user_id == Yii::app()->user->id ) {
					$deleteReview->deletePhotos();
					AdvisorReviewrating::model()->deleteAllByReviewId($id);
					$modelFactoryReview = AdvisorFactoryReview::model()->find('reference_code = :fid',array(':fid'=>$deleteReview->reference_code));
					if ( $modelFactoryReview){
						$modelFactoryReview->num_reviews--;
						
						$detil_rating = json_decode($modelFactoryReview->detil_rating,true);
							
						if ( !empty($detil_rating[$deleteReview->rating])) {
							$detil_rating[$deleteReview->rating]--;
							if ($detil_rating[$deleteReview->rating] == 0){
								unset($detil_rating[$deleteReview->rating]);
							}
						}
						$modelFactoryReview->detil_rating = json_encode($detil_rating);						
						$modelFactoryReview->average_value = $modelFactoryReview->averageRating();
						$modelFactoryReview->save();
					}	
					$deleteReview->delete();
				}
						
			}
			
		}
		
		echo $this->redirect(Yii::app()->createUrl('/members/reviews/'.Yii::app()->user->name));
		
	}*/
	
	private function validatePhotos(){
		if ( !empty( $_POST['AdvisorReview']['attrphoto']) ) {
			foreach ($_POST['AdvisorReview']['attrphoto'] as $idxFoto =>$namePhoto){
				if ( empty($_POST['AdvisorReview']['photocaption'][$idxFoto] )){
					$status['error'] = true;
					$status['errors']['photo_'.$idxFoto] = 'Caption cannot be blank';
				}
			}
		}
		return $status;
	}
	
	private function validateReview(){
		$id = $_POST['AdvisorReview']['factory_id'];	
		$modelReview = new AdvisorReviews;
		$_POST['AdvisorReview']['reference_code'] 	= md5($id);
		$_POST['AdvisorReview']['user_id'] 			= Yii::app()->user->id;
		$_POST['AdvisorReview']['create_date'] 		= time();
		
		$modelReview->attributes = $_POST['AdvisorReview'];
		$validatePhoto = $this->validatePhotos();
		
		if ( $modelReview->validate() && !$validatePhoto['error'] ){
			
			if ( !Yii::app()->user->isGuest ){
				
				/* check PHOTO */
				
				$return['status'] = 'readytosave';
				echo json_encode($return);
				
			}else{
				$return['status'] = 'needlogin';
				echo json_encode($return);
			}

		}else{
			
			$return['status'] = 'error';
			$return['errors'] = $modelReview->getErrors();
			foreach ( (array)$validatePhoto['errors'] as $field=>$info){
				$return['errors'][$field][] = $info;
			}
			echo json_encode($return);
		}
	}
	
	protected  function savereview(){
		$id = $_POST['AdvisorReview']['factory_id'];	
		$modelReview = new AdvisorReviews;
		$_POST['AdvisorReview']['reference_code'] 	= md5($id);
		$_POST['AdvisorReview']['user_id'] 			= Yii::app()->user->id;
		$_POST['AdvisorReview']['create_date'] 		= time();
		$_POST['AdvisorReview']['status'] 			= 'pending';
		
		$modelReview->attributes = $_POST['AdvisorReview'];
		
		if ( $modelReview->validate() ){
			if ( !Yii::app()->user->isGuest ){
			
				if ( $modelReview->save() ){
					
					$modelFactoryReview = AdvisorFactoryReview::model()->find('factory_id = :fid',array(':fid'=>$id));	
					if ( !$modelFactoryReview ) {
						$modelFactoryReview = new AdvisorFactoryReview;	
						$modelFactoryReview->factory_id = $id;
						$modelFactoryReview->reference_code = $modelReview->reference_code;
						$modelFactoryReview->num_reviews = 1;
						$detil_rating[$modelReview->rating] = 1;
						
					} else {
						if ( $modelFactoryReview->detil_rating ) {
							$detil_rating = json_decode($modelFactoryReview->detil_rating,true);
							
							if ( empty($detil_rating[$modelReview->rating])) {
								$detil_rating[$modelReview->rating] = 1;
							} else {
								$detil_rating[$modelReview->rating]++;
							}							
						}else{
							$detil_rating[$modelReview->rating] = 1;
						
						}
						$modelFactoryReview->num_reviews++;
					}
					
					$modelFactoryReview->detil_rating = json_encode($detil_rating);
					
					$modelFactoryReview->average_value = $modelFactoryReview->averageRating();
					$modelFactoryReview->save();
					//$modelFactoryReview->saveCounters(array('num_reviews'=>1));
					
					Yii::app()->user->setFlash('review_success','Your review has been saved');
					
					$return = true;
					
					
					/* save photos */
					if ( !empty( $_FILES['AdvisorReview']['name']['photo']) ) {
						foreach ($_FILES['AdvisorReview']['name']['photo'] as $idxFoto =>$namePhoto){
							if ( !empty($namePhoto)){
								$photo = new AdvisorReviewPhoto;
								$photo->filename	= CUploadedFile::getInstanceByName('AdvisorReview[photo]['.$idxFoto.']');
								$photo->review_id	=  $modelReview->id;
								$photo->reference_code	=  $modelReview->reference_code;
								$photo->caption	= $_POST['AdvisorReview']['photocaption'][$idxFoto];
								
								if ($photo->save()){
									$folderPath = Yii::app()->params['photofolder'] .'/review_'.$modelReview->id;
									if ( !is_dir($folderPath) )	// create directory
										@mkdir($folderPath);
								
									$photo->filename->saveAs($folderPath.'/'.$photo->filename);
									/* resize */
									Yii::app()->thumb->setThumbsDirectory('/'.$folderPath);
									Yii::app()->thumb->load($folderPath.'/'.$photo->filename)
												->resize(550,412)
												->save($photo->filename);
									
									/* create thumbnail */	
									$folderPathThumb = $folderPath.'/thumb/';
									if ( !is_dir($folderPathThumb) )	// create directory
										@mkdir($folderPathThumb);
										
									
									Yii::app()->thumb->setThumbsDirectory('/'.$folderPathThumb);
									
									Yii::app()->thumb->load($folderPath.'/'.$photo->filename)
												->resize(100,100)
												->crop(0,0,65,65)
												->save($photo->filename);
								}
							}
						}
					}
					
					/* save rating */
					if ( isset($_POST['AdvisorReviewrating']) ) {
						foreach ( $_POST['AdvisorReviewrating'] as $idRating => $valuePost ){
							$modelReviewRating = new AdvisorReviewrating;
							$modelReviewRating->review_id = $modelReview->id;
							$modelReviewRating->rating_id = $idRating;
							$modelReviewRating->value = $valuePost;
							$modelReviewRating->save();
							
						}	
					}
				}
				
				
			}else{
				return false;
			}

		}else{
			return false;
		}
	}
	
	public function actionSavereview(){
		//$this->savereview();
		if(Yii::app()->request->isPostRequest)
		{
			$this->validateReview();
			
			/*if ( $this->savereview()){
				
			}*/
		
		} else {
			$status['status'] == 'error';
			echo json_encode($status);
		}
		
	}
	
	/* search company by using ajax */
	public function actionSearch()
	{
		if ( !empty($_GET['query']) ) {
			$criteria = new CDbCriteria;
			$criteria->compare('company_name',$_GET['query'],true);
			$searchQuery = Factory::model()->findAll($criteria);
		}
		echo $this->render('search_company',array('searchQuery'=>$searchQuery));
		
	}
	
}