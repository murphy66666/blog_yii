<?php 

/**
 * 后台用户模型
 */
class User extends CActiveRecord{
	public $password1;
	public $password2;
	/**
	 * 必不可缺方法1，返回模型
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	/**
	 * 必不可缺方法2，返回表名
	 */
	public function tableName(){
		return "{{admin}}";
	}

	/**
	 * 设置标签即把数据库字段中文化，为后续方便使用
	 */
	public function attributeLabels(){
		return array(
			'password'=>'原始密码',
			'password1'=>'新密码',
			'password2'=>'确认密码',

			);
	}

	/**
	 * 验证规格
	 */
	public function rules(){
		return array(
			array('password','required','message'=>'原始密码必填'),
			array('password','check_passwd'),
			array('password1','required','message'=>'新密码必填'),
			array('password2','required','message'=>'确认密码必填'),
			array('password2','compare','compareAttribute'=>'password1','message'=>'两次密码不相同'),
			);
	}

	public function check_passwd(){
		$userInfo = $this->find('userName=:name',array(':name'=>Yii::app()->user->name));//查询根据用户名当前用户信息
		if(md5($this->password)!= $userInfo->password){
			$this->addError('password','原始密码不正确');//添加自定义的错误
		}

	}
}	
 ?>
