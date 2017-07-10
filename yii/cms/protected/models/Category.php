<?php 

/**
 * 后台用户模型
 */
class Category extends CActiveRecord{

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
		return "{{Category}}";
	}

	public function attributeLabels(){
		return array(
				'cname'=>'栏目名称',
			);
	}

	public function rules(){
		return array(
			array('cname','required','message'=>'栏目必填'),
			);
	}
}