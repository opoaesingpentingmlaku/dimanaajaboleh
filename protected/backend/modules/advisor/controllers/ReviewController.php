<?php

class ReviewController extends Controller
{
	
	public $layout = '//layouts/main';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'userGroupsAccessControl', // perform access control for CRUD operations
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			
			array('allow',  // allow logged user to access the userlist page if the have admin rights on users or if the list is public
				'actions'=>array('lists','delete','setPublish'),
				//'expression'=>'UserGroupsConfiguration::findRule("public_user_list") || Yii::app()->user->pbac("userGroups.user.admin")',
				'users'=>array('@'),
			),
			
			array('allow', // allow user with admin permission to perform any action
				'pbac'=>array('admin', 'admin.admin'),
				'ajax'=>true,
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$this->render('index',array('dotoc'=>'prefetch'));
	}
		
	public function actionLists()
	{
		//$getUser = User::model()->find("username='".Yii::app()->request->getQuery('user')."'");
		
		$criteria = new CDbCriteria();
		
		//$criteria->compare("user_id",$getUser->id);
		$criteria->order = 'create_date desc';
		
		$count = AdvisorReviews::model()->count($criteria);
		
		$pages=new CPagination($count);

		// results per page
		$pages->pageSize=20;
		$pages->applyLimit($criteria);
		
		
		$reviews = AdvisorReviews::model()->findAll($criteria);
		
		$this->render('lists',array('reviews'=>$reviews,'pages'=>$pages,'total_reviews'=>$count));
		
	}
	
	public function actionDelete($id)
	{
		
		if ( !empty($id) && ( !Yii::app()->user->isGuest )  ) {
			
			$deleteReview = AdvisorReviews::model()->findByPk($id);
			
			if ( $deleteReview ) {
				
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
				$owner = $deleteReview->user_id;		
				$deleteReview->delete();
				$newCalculate = AdvisorReviews::model()->count("user_id = '".$owner."' AND `status` = 'published'");
				
				UserOptions::model()->setValue($owner,'reviews_num',$newCalculate);
			}
			
		}
		
		echo $this->redirect(Yii::app()->createUrl('/advisor/review/lists'));
		
	}
	
	public function actionsetPublish($id)
	{
		
		if ( !empty($id) && ( !Yii::app()->user->isGuest )  ) {
			
			$publishReview = AdvisorReviews::model()->findByPk($id);
			
			if ( $publishReview ) {
				$publishReview->status = 'published';
				$publishReview->save();
				$newCalculate = AdvisorReviews::model()->count("user_id = '".$publishReview->user_id."' AND `status` = 'published'");
				
				UserOptions::model()->setValue($publishReview->user_id,'reviews_num',$newCalculate);
				
				$modelFactoryReview = AdvisorFactoryReview::model()->find('reference_code = :fid',array(':fid'=>$publishReview->reference_code));
				if ( $modelFactoryReview){
					$modelFactoryReview->num_reviews++;
					
					$detil_rating = json_decode($modelFactoryReview->detil_rating,true);
						
					if ( !empty($detil_rating[$publishReview->rating])) {
						$detil_rating[$publishReview->rating]++;
						if ($detil_rating[$publishReview->rating] == 0){
							unset($detil_rating[$publishReview->rating]);
						}
					}
					$modelFactoryReview->detil_rating = json_encode($detil_rating);						
					$modelFactoryReview->average_value = $modelFactoryReview->averageRating();
					$modelFactoryReview->save();
				}	
			}
			
		}
		
		echo $this->redirect(Yii::app()->createUrl('/advisor/review/lists'));
		
	}
}