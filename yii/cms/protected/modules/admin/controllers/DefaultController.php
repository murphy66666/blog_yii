<?php

class DefaultController extends Controller
{	

	//权限验证
	public function filters(){
		return array(
			'accessControl'
			);
	}

	//定义规则
	public function accessRules(){
		return array(
			array(
				'allow',
				'actions'=>array('index','copy'),
				'users'=>array('@'), //@表示已经验证过的用户
				),
			array(
				'deny',
				'users'=>array('*'), //*表示所有用户
				),
			);
	}

	public function actionIndex()
	{
		$this->renderPartial('index');
	}

	public function actionCopy(){
		
		$this->render("copy");
	}
}