<?php 

/**
 * 后台用户模型
 */
class Article extends CActiveRecord{

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
		return "{{Article}}";
	}

	public function attributeLabels(){
		return array(
				'title'=>'标题',
				'type'=>'类型',
				'cid'=>'栏目',
				'thumb'=>'缩略图',
				'info'=>'摘要',
				'content'=>'内容'
			);
	}

	public function rules(){
		return array(
			array('title','required','message'=>'标题必填'),
			array('type', 'in', 'range'=>array(0, 1), 'message'=>'请选择类型'),
			array('cid', 'check_cate'),
			array('info','required', 'message'=>'摘要必填'),
			array('thumb','file','types'=>'jpg,gif,png,jpeg', 'message'=>'没有上传或者类型不符'),
			array('content','required','message'=>'内容必填'),
			//array('num','match','parttern'=>'/^13\d{9}/','message'=>'号码不正确'),
			//array('content','info','safe'),
			);
	}

	public function check_cate(){
		if($this->cid <= 0){
			$this->addError('cid', '请选择栏目');
		}
	}

	//cid关联其他表中文字段
	public function relations(){
		return array(
			'cate'=>array(self::BELONGS_TO,'Category','cid'),
			);
	}

	//导航栏与文章标题
	public function common(){
		//导航栏
		$common = array();
		$sql = "SELECT cname,cid FROM {{category}} LIMIT 5";
		$common['nav'] = Category::model()->findAllBySql($sql);
		//文章标题
		$sql = "SELECT title,aid FROM {{article}} ORDER BY time DESC LIMIT 5";
		$common['title'] = $this ->findAllBySql($sql);
		return $common;
	}
}