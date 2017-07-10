<?php 
header("Content-type:text/html;charset=utf-8");

/**
 * 栏目管理控制器
 */
class CategoryController extends Controller {

	public function  actionIndex($cid){
		//获取数据缓存
		$articleInfo = Yii::app()->cache->get('cate');
		if($articleInfo == false){

		
		$sql = "SELECT thumb,title,info,aid FROM {{article}} WHERE cid=$cid";
		$articleInfo = Article::model()->findAllBySql($sql); 
		//p($articleInfo);exit;
		Yii::app()->cache->set('cate',$articleInfo,10);
		}
		$this->render("index",array('articleInfo'=>$articleInfo));
	}
}

 ?>