<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$backend=dirname(dirname(__FILE__));
$frontend = dirname($backend);

Yii::setPathOfAlias('backend', $backend);
Yii::setPathOfAlias('frontend', $frontend);

return array(
	'basePath'=>$backend,
	'name'=>'Bangladvisor',
	'theme'=>'admin',

	// preloading 'log' component
	'preload'=>array('log'),
	
	'controllerPath' => $backend.'/controllers',
	'modulePath' => $backend.'/modules',
    'viewPath' => $backend.'/views',
    'runtimePath' => $backend.'/runtime',
   // 'extensionPath' => $backend.'/extensions',
 
    'import' => array(
       
        'application.models.*',
        'application.components.*',
        'application.modules.advisor.models.*',
        'frontend.modules.advisor.models.*',
        'frontend.modules.members.models.*',
        
    ),
	

	'defaultController'=>'userGroups/UGDefault',
	
	// application components
	'modules'=>array('userGroups'=>array( 'accessCode'=>'test', 'salt'=>'1234', ),
	'advisor','members')
	,
	'components'=>array(
		
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'userGroups.components.WebUserGroups',
		),
		
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=bangladivsor',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
			 'showScriptName'=>false,
        	'rules'=>array(
        		
				'admin'=>'userGroups/UGDefault',
				'admin/<_c>'=>'<_c>',
				'admin/<_c>/<_a>'=>'<_c>/<_a>',
				'admin/userGroups/<_c>/<_a>'=>'userGroups/<_c>/<_a>',
				'admin/advisor/<_c>/<_a>'=>'advisor/<_c>/<_a>',
				//'admin/advisor/<_c>/<_a>/<id:/>'=>'advisor/<_c>/<_a>/<_id>',
				'admin/advisor/<_c>/<_a:.*>'=>'advisor/<_c>/<_a>/',
				'admin/members/<_c>/<_a>'=>'members/<_c>/<_a>',
				
		  	)
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);