<?php 
/**
 * 后台用户管理控制器
 */
class UserController extends Controller{

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
				'actions'=>array('Passwd'),
				'users'=>array('@'), //@表示已经验证过的用户
				),
			array(
				'deny',
				'users'=>array('*'), //*表示所有用户
				),
			);
	}

	/**
	 * 修改密码
	 */
	public function actionPasswd(){
		$userModel = User::model();

		if(isset($_POST['User'])){
			$userInfo = $userModel->find('username=:name',array(':name'=>Yii::app()->user->name));
			$userModel->attributes = $_POST['User'];
			if($userModel->validate()){
				$passwd = md5($_POST['User']['password1']);
				if($userModel->updateByPk($userInfo->uid,array('password'=>$passwd))){
					Yii::app()->user->setFlash('success','密码修改成功');
				}else{
					Yii::app()->user->setFlash('fail','密码修改失败');
				}

			}
		}
		$this->render('index', array('userModel'=>$userModel));
	}

}

 ?>