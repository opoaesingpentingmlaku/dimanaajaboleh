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
				return;
			}
		}
		$this->render('factory',array('model'=>$model));
	}

	public function actionView($id)
	{
		$data->factory = Factory::model()->findByPk($id);
		$data->factoryReview 	= AdvisorFactoryReview::model()->find("factory_id ='".$id."'");
		$data->show_reviews 	= AdvisorReviews::model()->findAll("reference_code = '".$data->factoryReview->reference_code."'");
		$this->render('view',array('data'=>$data));
		
	}
	
	public function actionWrite($id)
	{	
		$factory = Factory::model()->findByPk($id);
		if ( isset($_POST['AdvisorReview']) ){
			
			$modelReview = new AdvisorReviews;
			$_POST['AdvisorReview']['reference_code'] = md5($id);
			$_POST['AdvisorReview']['user_id'] = Yii::app()->user->id;
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
			$factory = new Factory;
			$factory->attributes = $_POST['Factory'];
			if ( $factory->validate() ) {
				if ( !Yii::app()->user->isGuest ){
					$factory->user_created = Yii::app()->user->id;
					$factory->save();
					Yii::app()->user->setFlash('success','Your factory has been included');
					$this->redirect(Yii::app()->createUrl('advisor/factory/include'));					
				} else {
					$return['status'] = 'needlogin';
					echo json_encode($return);
				}
			} else {
				$return['status'] = 'error';
				$return['errors'] = $factory->getErrors();
				echo json_encode($return);
			}			
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