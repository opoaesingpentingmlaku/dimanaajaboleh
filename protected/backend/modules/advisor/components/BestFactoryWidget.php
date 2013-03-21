<?php
Yii::import('zii.widgets.CPortlet');

class BestFactoryWidget extends CPortlet {

	public function init() {
		// $this->title = 'Best Factory';
		return parent::init();
	}

	public function run() {
		
		$this->render('application.modules.advisor.views.factory._best',array('best'=>AdvisorFactoryReview::model()->bestRating()));
		return parent::run();
	}
}
?>
