<?php

// This is the database connection configuration.
return array(
	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	/*
	'connectionString' => 'mysql:host=localhost;dbname=testdrive',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	*/

	'connectionString' => 'mysql:host=localhost;dbname=yii_blog',
	'emulatePrepare' => true, //PDO扩展
	'username' => 'root',
	'password' => 'root',
	'charset' => 'utf8',
	'tablePrefix' => 'hd_', //定义表前缀
	'enableParamLogging' => true,//开启调试信息的SQL语句具体值信息
	
);