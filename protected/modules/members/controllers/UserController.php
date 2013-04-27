<?php

class UserController extends Controller
{
	
	public $layout='//layouts/maindefault';
	private $_handler;
	
	public function actionIndex()
	{
		$this->render('index',array('dotoc'=>'prefetch'));
	}
	
	public function actionChangeavatar(){
		$this->layout='//layouts/main';
		$this->renderPartial('application.modules.members.views.default.userform', array('con' => $_GET['con']));
	}
	
	public function actionUpload(){
		$this->_handler = new UploadHandler();
	}
	
	public function actionSavefiletodb(){
		$container = array(
			"journal" => "journal",
			"cov" => "cover",
			"ava" => "avatar"
		);
		$save = array(
			"filename" => $_POST['filename'],
			"type" => $_POST['filetype'],
			"path" => "files/",
			"size" => $_POST['filesize'],
			"container" => $container[$_POST['container']],
			"created_at" => date('Y-m-d H:i:s'),
			"status" => 1
		);
		
		$_files = new Files;
		$_files->attributes = $save;
		if($_files->save()){
			if($_POST['container'] == "cov"){
				$this->set_user_cover(Yii::app()->user->id, $_files->id);
			}elseif($_POST['container'] == "ava"){
				$this->set_user_avatar(Yii::app()->user->id, $_files->id);
			}
			echo $_POST['filename']." | ".$_POST['filesize']." | ".$_POST['filetype'];
		}
	}
	
	protected function set_user_cover($user_id, $file_id){
		$user = Users::model()->findByPk($user_id);
		$user->cover = $file_id;
		$user->save();
	}
	
	protected function set_user_avatar($user_id, $file_id){
		$user = Users::model()->findByPk($user_id);
		$user->avatar = $file_id;
		$user->save();
	}
	
	public function actionFollow(){
		$data['fans_id'] = $_POST['fans_id'];
		$data['user_id'] = $_POST['user_id'];
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['status'] = 1;
		$fans = new User_fans;
		$fans->attributes = $data;
		$fans->validate();
		if($fans->save()){
			echo "success";
			$this->user_update($data['fans_id'], 1, "follower");
			$this->user_update($data['user_id'], 1, "following");;
		}else
			echo "failed";
	}
	
	public function actionUnfollow(){
		$fans_id = $_POST['fans_id'];
		$user_id = $_POST['user_id'];
		$fans = User_fans::model()->findByAttributes(array('user_id' => $user_id, 'fans_id' => $fans_id));
		if($fans->delete()){
			echo "success";
			$this->user_update($fans_id, -1, "follower");
			$this->user_update($user_id, -1, "following");
		}else
			echo "failed";
	}
	
	protected function user_update($user_id, $count, $type = "following"){
		$user = Users::model()->findByPk($user_id);
		if($type == "follower"){
			$user->followings = $user->followings + $count;
		}else
			$user->followers = $user->followers + $count;
		$user->save();
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
	
	public function actionEditprofile(){
		$model = new ProfileEdit;
		$user = Users::model()->findByPk(Yii::app()->user->id);
		if($_POST){
			$user->attributes = $_POST['ProfileEdit'];
			$user->save();
		}

		if(Yii::app()->user->id){
			$data['fullname'] = $user->fullname;
			$data['email'] = $user->email;
			$data['username'] = $user->username;
			$data['birthdate'] = $user->birthdate;
			$data['company'] = $user->company;
			$data['location'] = $user->location;
			
			$model->attributes = $data;
			$this->render('application.modules.members.views.default.editprofile', array('model' => $model));
		}else{
			echo"No User";
		}
	}
	
	public function actionChangepassword(){
		$model = new ChangePassword;
		$user = Users::model()->findByPk(Yii::app()->user->id);
		if($_POST){
			$user->attributes = $_POST['ChangePassword'];
			$user->save();
		}
		$this->render('application.modules.members.views.default.change_password', array('model' => $model));
	}
	
}