<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'JELAJAH',
	'theme'=>'places',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.files.models.*',
	),
	
	'defaultController'=>'places',

	'modules'=>array('places', 'members',
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'test',
				
				'generatorPaths'=>array(
					'application.gii',   // a path alias
				)
			)
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
        	'urlFormat'=>'path',
			'showScriptName'=>true,
        	'rules'=>array(
        		
				'places/<action:\w+>'=>'places/default/<action>',
				'members/reviews/<id:\w+>'=>'members/default/reviews/user/<id>', // user
				'members/factories/<id:\w+>'=>'members/default/factories/user/<id>', // user
				'members/<id:\w+>'=>'members/default/index/user/<id>', // user
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	),
        ),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=kotakjelajah',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
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
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'khoirun.najib@gmail.com',
	),
);