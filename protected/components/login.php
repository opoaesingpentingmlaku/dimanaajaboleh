<?php
Yii::import('zii.widgets.CPortlet');

class Login extends CPortlet {

	public function init() {
		return parent::init();
	}

	public function run() {
		
		$this->render('application.themes.places.view.site.login',array('best'=>AdvisorFactoryReview::model()->bestRating()));
		return parent::run();
	}
}
?>
