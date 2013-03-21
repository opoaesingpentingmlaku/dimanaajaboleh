<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Indonesia Travelings',
	'theme'=>'travels',
	
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.yiimail.*',
		'application.modules.advisor.models.*',
		'application.modules.advisor.components.*',
		'application.modules.members.components.*',
	),

	'defaultController'=>'site',

	// application components
	'modules'=>array('advisor','members',
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'test',
				
				'generatorPaths'=>array(
					'application.gii',   // a path alias
				)
			))
	,
	'behaviors'=>array(
		'runEnd'=>array(
			'class'=>'application.components.WebApplicationEndBehavior',
		),
	),
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'mail' => array(
 			'class' => 'application.components.yiimail.YiiMail',
			'transportType' => 'php',
 			'viewPath' => 'application.views.mail',
 			'logging' => true,
 			'dryRun' => false
		),
		'thumb'=>array(
            'class'=>'application.extensions.phpthumb.EasyPhpThumb',
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
			'showScriptName'=>true,
        	'rules'=>array(
        		
				'advisor/<action:\w+>'=>'advisor/default/<action>',
				'advisor/<action:\w+>/'=>'advisor/default/<action>/',
				'members/reviews/<id:\w+>'=>'members/default/reviews/user/<id>', // user
				'members/factories/<id:\w+>'=>'members/default/factories/user/<id>', // user
				'members/<id:\w+>'=>'members/default/index/user/<id>', // user
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	),
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