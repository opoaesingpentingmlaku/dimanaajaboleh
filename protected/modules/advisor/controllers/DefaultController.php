<?php

class DefaultController extends Controller
{
	//public $layout='layout/magazine';
	//public $dotoc = '';
	public $layout='//layouts/maindefault';
	//public $mid;
	public function actionIndex()
	{
		$this->render('index',array('dotoc'=>'prefetch'));
	}
	
	public function actionWritereview()
	{
		$this->render('writereview');
		//echo 'write review';
	}
	
	public function actionMakereview($id)
	{	
		print_r($_GET);
		echo 'asdasd';
		//$this->render('formwritereview');
		//echo 'write review';
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
			$criteria->compare('status','published',false);
			$searchQuery = Factory::model()->findAll($criteria);
		}
		echo $this->render('search_company',array('searchQuery'=>$searchQuery));
		
	}
	
}