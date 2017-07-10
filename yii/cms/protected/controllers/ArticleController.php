<?php 
header("Content-type:text/html;charset=utf-8");

/**
* 文章管理控制器
*/
class ArticleController extends Controller{
	
	//所有文章缓存
	public function filters(){
		return array(
			array(
				'system.web.widgets.COutputCache + index', //路径别名
				'duration' => 30, //缓存时间
				'varyByParam' => array('aid'),
				),
			);
	}

	public function actionIndex($aid){
		$articleInfo = Article::model()->findByPk($aid);
		//p($articleInfo);exit;
		$this->render('index',array('articleInfo'=>$articleInfo));
	}

}

 ?>