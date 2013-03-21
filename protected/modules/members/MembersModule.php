<?php

class MembersModule extends CWebModule
{
	public $filefolder = 'files/'; // Approot/...
	public $rating = array('1'=>'Terrible','2'=>'Poor','3'=>'Average','4'=>'Very Good','5'=>'Excellent');
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'advisor.models.*',
			'advisor.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			/*if ( Yii::app()->user->isGuest ){
				Yii::app()->request->redirect(Yii::app()->homeUrl);
			}*/
			return true;
		}
		else
			return false;
	}
}
