<?php

class FactoryController extends Controller
{
	
	public $layout='//layouts/maindefault';
	
	public function actionIndex()
	{
		$this->render('index',array('dotoc'=>'prefetch'));
	}
	
	public function actionInclude()
	{
		$model=new Factory;

		// uncomment the following code to enable ajax-based validation
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='factory-factory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		

		if(isset($_POST['Factory']))
		{
			$model->attributes=$_POST['Factory'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				$result = $this->saveFactory($model);
				if ($result['status'] == 'success' ) {
					Yii::app()->user->setFlash('factorysuccess','Your factory has been saved. <a href="'.Yii::app()->createUrl('advisor/factory/view/id/'.$factory->id).'">see it</a>');
					$this->redirect(Yii::app()->createUrl('advisor/factory/include'));
				}
			}
		}
		$this->render('factory',array('model'=>$model));
	}

	public function actionUpdate($id)
	{
		$model = Factory::model()->findByPk($id);

		// uncomment the following code to enable ajax-based validation
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='factory-factory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		

		if(isset($_POST['Factory']))
		{
			$model->attributes=$_POST['Factory'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('factory',array('model'=>$model));
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
			}
			
		}
		
		echo $this->redirect(Yii::app()->createUrl('/members/factories/'.Yii::app()->user->name));
	}
	
	public function actionView($id)
	{
		$data->factory = Factory::model()->findByPk($id);
		$data->factoryReview 	= AdvisorFactoryReview::model()->find("factory_id ='".$id."'");
		$criteria = new CDbCriteria();
		if ( $data->factoryReview->reference_code ){
			$criteria->compare("reference_code",$data->factoryReview->reference_code);
			$criteria->order = 'create_date desc';
		
			$count = AdvisorReviews::model()->count($criteria);
			$data->factoryReview->num_reviews = $count;
			$pages=new CPagination($count);

			// results per page
			$pages->pageSize=5;
			$pages->applyLimit($criteria);
		
			$data->show_reviews 	= AdvisorReviews::model()->findAll($criteria);
		}
		
		$this->render('view',array('data'=>$data,'pages'=>$pages));
		
	}
	
	public function actionWrite($id)
	{	
		$factory = Factory::model()->findByPk($id);
		if ( isset($_POST['AdvisorReview']) ){
			
			$modelReview = new AdvisorReviews;
			$_POST['AdvisorReview']['reference_code'] = md5($id);
			$_POST['AdvisorReview']['user_id'] = Yii::app()->user->id;
			$_POST['AdvisorReview']['status'] = 'pending';
			$modelReview->attributes = $_POST['AdvisorReview'];
			if ($modelReview->save()){
			}else{
				echo 'error';
			}
		}
		$this->render('formwritereview',array('factory'=>$factory));
	}	
	
	public function actionSavefactory(){
		if(Yii::app()->request->isPostRequest)
		{
			if (empty($_POST['Factory']['id'])){
				$factory = new Factory;
			
			}else {
			
				$factory = Factory::model()->find("id = '".$_POST['Factory']['id']."' AND user_created = '".Yii::app()->user->id."'");
				if ( !$factory ){
					$return['status'] = 'notallowed';
					echo json_encode($return);
					return;
				}
			}
			
			$result = $this->saveFactory($factory);
			
			if ( $result['status'] == 'success' ) {
				Yii::app()->user->setFlash('factorysuccess','Your factory has been saved. <a href="'.Yii::app()->createUrl('advisor/factory/view/id/'.$factory->id).'">see it</a>');
				echo json_encode($result);

			} else if ( $result['status'] == 'needlogin' ) { 
				
				echo json_encode($result);
			
			} else if ( $result['status'] == 'error' ) {
				echo json_encode($result);
			}			
		}
	}
	
	protected function Savefactory($factory){
		$factory->attributes = $_POST['Factory'];
		if ( $factory->validate() ) {
			if ( !Yii::app()->user->isGuest ){
				
				$factory->user_created = Yii::app()->user->id;
				$factory->status = 'pending';
				$factory->date_created = time();
				$factory->save();
				$return['status'] = 'success';
				
				$return['param']['id'] = $factory->id;
				
			} else {
				$return['status'] = 'needlogin';
				
			}
		} else {
			$return['status'] = 'error';
			$return['errors'] = $factory->getErrors();
				
		}
		return $return;		 
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