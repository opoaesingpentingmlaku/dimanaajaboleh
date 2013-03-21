<?php

class SiteController extends Controller
{
	public $layout='mainlogin';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	public function actionIndex()
	{
		//echo 'asdasd';
		//print_R(AdvisorReviews::model()->RecentReview(5));
		$this->render('home');
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='mainlogin';
		
		$model=new AdminloginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// collect user input data
		if(isset($_POST['AdminloginForm']))
		{
			$model->attributes=$_POST['AdminloginForm'];
			// validate user input and redirect to the previous page if valid
					
			if( $model->validate() && $model->login()){
				
				$this->redirect(Yii::app()->createUrl('site/home'));
			}else{
				print_r($model->getErrors());
			}			
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionAjaxLogin()
	{
		$model=new LoginForm;
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				echo 'success';
				return;
			} else {
			//print_r($model->getErrors());	
				echo 'errror';
				return;
			}
		}
		
		echo $this->renderPartial('ajaxlogin',array('model'=>$model,'element'=>'#formreview','action'=>'submit'),true,true,true);
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}