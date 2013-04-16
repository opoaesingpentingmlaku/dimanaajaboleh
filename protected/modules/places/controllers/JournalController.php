<?php

class JournalController extends Controller
{
	public $layout='//layouts/maindefault';
	private $_journals;
	private $_files;
	private $_handler;
	
	public function actionIndex()
	{
		$this->render('index',array('dotoc'=>'prefetch'));
	}
	
	public function actionCreate()
	{
		if($_POST){
			$data = array(
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'city' => $_POST['city'],
				'location' => $_POST['location'],
				'created_at' => date('Y-m-d H:i:s'),
				'status' => 0
			);
			$this->_journals = new Journals;
			$this->_journals->attributes = $data;
			if($this->_journals->save()){
				$this->actionUpdatefiles($_POST['ids']);
				return true;
			}else{
				var_dump($this->_journals->error());
			}
		}
		$this->render('journalcreate');
	}
	
	public function actionUpload()
	{
		$this->_handler = new UploadHandler();
	}
	
	public function actionDelete()
	{
		echo $_POST['fid'];
	}
	
	public function actionSave()
	{
		var_dump($_FILES);
	}
	
	public function actionUpdatefiles($data)
	{
		if($_POST){
			$data_id = explode('|', $data);
			foreach($data_id as $id){
				$file = File::model()->findByPk($id);
				
				$data = array(
					'journal_id' => 123456
				);
				
				$file->id = $data;
				$file->save();
			}
		}
	}
	
}