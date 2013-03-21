<?php

class FactoryController extends Controller
{
	
	public $layout='//layouts/main';
	
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
				'actions'=>array('index','lists','delete','setPublish'),
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
		$criteria = new CDbCriteria();
				
		$count = Factory::model()->count($criteria);
		
		$pages=new CPagination($count);

		// results per page
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		
		$dataFactories = Factory::model()->findAll($criteria);
		$this->render('factorylists',array('factories'=>$dataFactories,'pages'=>$pages));
	}

	public function actionDelete($id)
	{
		if ( !empty($id) && ( !Yii::app()->user->isGuest )  ) {
			
			$deleteFactory = Factory::model()->find("id = '".$id."' AND user_created = '".Yii::app()->user->id."'");
			
			if ( $deleteFactory ) {
				$AdvisorFactoryReview = AdvisorFactoryReview::model()->find("factory_id ='".$deleteFactory->id."'");
				if ( $AdvisorFactoryReview ) {
					$getReviews = AdvisorReviews::model()->findAll("reference_code = '".$AdvisorFactoryReview->reference_code."'");
					if ( $getReviews )	
					foreach ( $getReviews as $deleteReview ){
					
						$deleteReview->deletePhotos();
						AdvisorReviewrating::model()->deleteAllByReviewId($deleteReview->id);
						$deleteReview->delete();
					}
					$AdvisorFactoryReview->delete();	
				}	
				$deleteFactory->delete();	
				$newCalculate = Factory::model()->count("user_created = '".$owner."' AND `status` = 'published'");
				UserOptions::model()->setValue($owner,'factories_num',$newCalculate);
			}
			
		}
		
		echo $this->redirect(Yii::app()->createUrl('/advisor/factory'));
	}
	
	public function actionsetPublish($id)
	{
		
		if ( !empty($id) && ( !Yii::app()->user->isGuest )  ) {
			
			$publishFactory = Factory::model()->findByPk($id);
			
			if ( $publishFactory ) {
				$publishFactory->status = 'published';
				$publishFactory->save();
				$newCalculate = Factory::model()->count("user_created = '".$publishFactory->user_created."' AND `status` = 'published'");
				UserOptions::model()->setValue($publishFactory->user_created,'factories_num',$newCalculate);
				
			}
			
		}
		
		echo $this->redirect(Yii::app()->createUrl('/advisor/factory'));
		
	}
}