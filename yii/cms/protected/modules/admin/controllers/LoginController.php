<?php 

header("Content-type:text/html;charset=utf-8");
/**
 * 后台登陆控制器
 */
class LoginController extends Controller{

	public function actionIndex(){
		//var_dump(Yii::app()->db);
		$loginForm = new LoginForm();
		/*$userInfo = User::model()->find('username=:name',array(':name'=>'admin'));
		p($userInfo);exit;*/
		if(isset($_POST['LoginForm'])){
			$loginForm->attributes = $_POST['LoginForm'];
			if($loginForm->validate() && $loginForm->login()){
				Yii::app()->session['logintime'] = time();
				$this->redirect(array('default/index'));
				
			}
		}
		$this->render('index',array('loginForm'=>$loginForm));
	}

	public function actions(){
		return array(
			'captcha' =>array(
					'class'=>'CCaptchaAction',
					'height'=>25,
					'width'=>80,
					'minLength'=>4,
					'maxLength'=>4
				),

			);
	}

	public function actionOut(){
		Yii::app()->user->logout();
		$this->redirect(array('index'));
	}
}

 ?>