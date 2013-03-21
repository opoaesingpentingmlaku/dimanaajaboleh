<?php

class DefaultController extends Controller
{
	
	public $layout='//layouts/main';
	
	/* list of member / user */
	
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
				
		$count = User::model()->count($criteria);
		
		$pages=new CPagination($count);

		// results per page
		$pages->pageSize=20;
		$pages->applyLimit($criteria);
		
		$dataMembers = User::model()->findAll();
		$this->render('memberlists',array('members'=>$dataMembers,'pages'=>$pages));
	}
	
	/* list of member / user */
	public function actionLists()
	{
		
		
	}
	
}