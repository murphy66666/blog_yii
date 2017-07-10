<?php 
header("Content-type:text/html;charset=utf-8");

class IndexController extends Controller {

	//首页整页缓存
	public function filters(){
		return array(
			array(
				'system.web.widgets.COutputCache + index', //路径别名
				'duration' => 30, //缓存时间

				),
			);
	}

	public function actionIndex(){
		//echo '武汉天喻';
		/*$data=array(
			'title'=>'哈哈',
			);*/
		//p($data);exit;
		$sqlNew = "SELECT thumb,aid,title,info FROM {{article}} WHERE type = 0 ORDER BY time DESC ";
		$sqlHot = "SELECT thumb,aid,title,info FROM {{article}} WHERE type = 1 ORDER BY time DESC ";
		$articleModel = Article::model();
		$articleNew = $articleModel->findAllBySql($sqlNew);
		$articleHot = $articleModel->findAllBySql($sqlHot);
		$data=array(
			'articleNew' => $articleNew,
			'articleHot' => $articleHot,
			);
		$this->render('index',$data);	
		}

	public function actionAdd(){

		$this->render("add");
	}

	}

?>
