<?php
class ToolButton extends CWidget {
 
    public $buttons = array();
    public $delimiter = ' / ';
	protected $path;
	 public function init()
    {
		$doScript = '';
        foreach ($this->buttons as $tools ){
			if ( isset($tools['action']) ){
				$doScript .= '
				jQuery("#'.$tools['id'].'").'.$tools['action']['event'].'(function(){
				'.
					$tools['action']['do']
				.'})';
			}
		}
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
		//$cs->registerScriptFile($baseUrl . $scriptFile);
		
		$cs->registerScript('toolbutton',$doScript);
		
        $this->path = Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR."sources",false,-1,true);
        //$this->path = dirname(__FILE__).DIRECTORY_SEPARATOR."css";
        
    }
	
    public function run() {
		/*
		*/
        $this->render('toolbox');
    }
 
}
?>