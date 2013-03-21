<?php

class SiteController extends Controller
{
	public $layout='maindefault';

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

		$this->render('home');
	}
	
	public function actionTermCondition()
	{
		if ( $_GET['ajax'] == 1){
			echo $this->renderpartial('term_condition');
		}else{
			$this->render('term_condition');
		}
	}
	
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='mainfull';
		
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
			if( $model->validate() && $model->login()){
				$this->redirect(Yii::app()->user->returnUrl);
			}else{
				//print_r($model->getErrors());
			}			
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Displays the forget password page
	 */
	public function actionForgot()
	{
		$this->layout='mainfull';
		if ( isset($_POST['email']) ){
			$userExists = User::model()->findByAttributes(array('email'=>$_POST['email']));
			if ( !$userExists ){
				Yii::app()->user->setFlash('error','Your email is not valid.');
			}else{
				$now 	= time();
				$rpwd 	= md5($userExists->email.$now);
				$reset = ResetPassword::model()->findByAttributes(array('user_id'=>$userExists->id));
				if ( !$reset ) {
					
					$reset 	= new ResetPassword;
					$reset->user_id 	= $userExists->id;
					$reset->temp_forget_password = $rpwd;
					$reset->start_time 	= $now;
					$reset->end_time 	= $now+(24*60*60);
					$reset->save();
				} else {
					$reset->temp_forget_password = $rpwd;
					$reset->start_time 	= $now;
					$reset->end_time 	= $now+(24*60*60);
					$reset->save();
				}
				
				$resetlink = 'http://'. Yii::app()->request->getServerName().Yii::app()->baseUrl.'/site/resetpassword?rpwd='.$rpwd;
				$resetlink = '<a href="'.$resetlink.'">'.$resetlink.'</a>';
				
				$message = new YiiMailMessage();
				$message->view = 'resetpassword';
		 
				$message->setTo(
				array($_POST['email']=>$userExists->first_name.' '.$userExists->last_name));
				$message->setFrom(array(Yii::app()->params['adminEmail']=>"BanglAdvisor"));
				$message->setSubject('Reset Bangladvisor Password');
				$message->setBody(array('resetlink'=>$resetlink,'email'=>$_POST['email']), 'text/html','utf-8');
				$numsent = Yii::app()->mail->send($message);
				Yii::app()->user->setFlash('success_confirm','Your Bangladvisor password has been sent to your email');
				Yii::app()->user->setFlash('success_confirm_title','Your Bangladvisor password');
				$this->redirect(Yii::app()->createUrl('site/confirm'));
			}
		}
		// display the forgot form
		$this->render('forgot',array('model'=>$model));
	}
	
	/**
	 * Displays the signup page
	 */
	public function actionSignup()
	{
		$this->layout='mainfull';
		
		$model=new SignupForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// collect user input data
		if(isset($_POST['SignupForm']))
		{
			$model->attributes = $_POST['SignupForm'];
			// validate user input and redirect to the previous page if valid
			if( $model->validate() && $model->save() ){
				
				$message = new YiiMailMessage();
				$message->view = 'registration';
		 
				$message->setTo(
				array($model->email=>$model->first_name.' '.$model->last_name));
				$message->setFrom(array(Yii::app()->params['adminEmail']=>"BanglAdvisor"));
				$message->setSubject('Confirmation of Registration the Bangladvisor\'s member');
				$message->setBody(array('username'=>$model->username,'email'=>$model->email), 'text/html','utf-8');
				$numsent = Yii::app()->mail->send($message);
				Yii::app()->user->setFlash('success_confirm','Thanks for joining Bangladvisor');
				Yii::app()->user->setFlash('success_confirm_title','Confirmation of Registration the Bangladvisor\'s member');
				$this->redirect(Yii::app()->createUrl('site/confirm'));
			}			
		}
		// display the login form
		$this->render('signup',array('model'=>$model));
	}
	
	public function actionResetpassword(){
		$this->layout='mainfull';
		$resetpasswordform = new ResetPasswordForm;
		if (!isset($_GET['rpwd'])){
			$this->redirect(Yii::app()->createUrl('site/forgot'));
		}else{
			$now = time();
			$valid = ResetPassword::model()->findByAttributes(array('temp_forget_password'=>$_GET['rpwd']),'start_time < '.$now.' AND end_time > '.$now);
			if ( !$valid ){
				Yii::app()->user->setFlash('error','Your request reset password is not valid');
				$this->redirect(Yii::app()->createUrl('site/forgot'));
			} else {
				$userExists = User::model()->findByPk($valid->user_id);
			}
		}
		
		if ( isset($_POST['ResetPasswordForm']) ){
			$resetpasswordform->attributes = $_POST['ResetPasswordForm'];
			if ($resetpasswordform->validate() && $resetpasswordform->save()){
				Yii::app()->user->setFlash('success_confirm','Your password Bangladvisor has been reseted');
				Yii::app()->user->setFlash('success_confirm_title','Your password Bangladvisor');
				$valid->delete();
				$this->redirect(Yii::app()->createUrl('site/confirm'));
			}
			
		}
		// display the login form
		$this->render('resetpassword',array('model'=>$resetpasswordform,'userexists'=>$userExists));
	}
	/**
	 * Displays the confirm page
	 */
	
	public function actionConfirm()
	{
		$this->layout='mainfull';
		
		// display the login form
		$this->render('confirm');
	}
	
	/**
	 * Ajax to load login
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
	
		// collect loginform input data
		if(isset($_POST['LoginForm']))
		{
			
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				echo 'success';
				return;
			} else {
			
				echo 'error';
				return;
			}
		}
		
		echo $this->renderPartial('ajaxlogin',array('model'=>$model,'element'=>'#'.$_GET['element'],'action'=>'submit'),true,true,true);
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionTest(){
				
		$message = new YiiMailMessage();
		$message->view = 'registration';
 
		$message->setTo(
		array('budidemo@localhost.com'=>'Budi Demo'));
		$message->setFrom(array(Yii::app()->params['adminEmail']=>"BanglAdvisor"));
		$message->setSubject('registration');
		$message->setBody(array(), 'text/html','utf-8');

		$numsent = Yii::app()->mail->send($message);
		
		
	}
}