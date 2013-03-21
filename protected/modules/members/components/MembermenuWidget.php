<?php
Yii::import('zii.widgets.CPortlet');

class MembermenuWidget extends CPortlet {

	public function init() {
		// $this->title = 'Best Factory';
		
		return parent::init();
	}

	public function run() {
		
		$user_request = User::model()->find("username = '".Yii::app()->request->getQuery('user')."'");
				
		$this->render('application.modules.members.views.default._menu',array('user_request'=>$user_request));
		return parent::run();
	}
}
?>
