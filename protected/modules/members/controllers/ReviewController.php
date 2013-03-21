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
				$this->savereview();
				
			}	
		}
		
		$this->render('formwritereview',array('factory'=>$factory));
	}	
	
	private function savereview(){
		$id = $_POST['AdvisorReview']['factory_id'];	
		$modelReview = new AdvisorReviews;
		$_POST['AdvisorReview']['reference_code'] 	= md5($id);
		$_POST['AdvisorReview']['user_id'] 			= Yii::app()->user->id;
		$_POST['AdvisorReview']['create_date'] 		= time();
		
		$modelReview->attributes = $_POST['AdvisorReview'];
		
		if ( $modelReview->validate() ){
			if ( !Yii::app()->user->isGuest ){
				if ($modelReview->save() ){
					
					$modelFactoryReview = AdvisorFactoryReview::model()->find('factory_id = :fid',array(':fid'=>$id));	
					if ( !$modelFactoryReview ) {
						$modelFactoryReview = new AdvisorFactoryReview;	
						$modelFactoryReview->factory_id = $id;
						$modelFactoryReview->reference_code = $modelReview->reference_code;
						$modelFactoryReview->num_reviews = 1;
						$modelFactoryReview->save();
					} else {
						if ( $modelFactoryReview->detil_rating ) {
							$detil_rating = json_decode($modelFactoryReview->detil_rating,true);
							
							//print_r($modelReview);	
							if ( empty($detil_rating[$modelReview->rating])) {
								$detil_rating[$modelReview->rating] = 1;
							} else {
								$detil_rating[$modelReview->rating]++;
							}							
						}else{
							$detil_rating[$modelReview->rating] = 1;
						
						}
						
						$modelFactoryReview->detil_rating = json_encode($detil_rating);
						$modelFactoryReview->average_value = $modelFactoryReview->averageRating();
						$modelFactoryReview->save();
						$modelFactoryReview->saveCounters(array('num_reviews'=>1));
						/*Yii::app()->user->setFlash('success','Your factory has been included');
						$this->redirect(Yii::app()->createUrl('advisor/review/write/id/'.$id));	
						*/		
						//$modelFactoryReview->average_value = ;
						$return['status'] = 'success';
							echo json_encode($return);
						
					}
					
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
				$return['status'] = 'needlogin';
				echo json_encode($return);
			}

		}else{
			$return['status'] = 'error';
			$return['errors'] = $modelReview->getErrors();
			echo json_encode($return);
		}
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
	
	public function actionSavereview(){
		//$this->savereview();
		if(Yii::app()->request->isPostRequest)
		{
			if ( $this->savereview()){
				
			}
		
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