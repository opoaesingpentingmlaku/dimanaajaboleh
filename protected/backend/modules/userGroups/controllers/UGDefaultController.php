<?php

class UGDefaultController extends Controller
{	
	/**
	 * @var mixed no permission rules for this controller
	 */
	public static $_permissionControl = false;
	
	public $layout = '//layouts/main';
	
	public function actionIndex()
	{
		
		if (isset($_GET['u']))
			$this->forward('/userGroups/user/view');
		else if (Yii::app()->user->isGuest)
			$this->forward('/userGroups/user/login');
		else
			$this->forward('/userGroups/user/view');
		
	}
}