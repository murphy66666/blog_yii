<?php 

/**
* 文章管理
*/
class ArticleController extends Controller
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
				'actions'=>array('index','del','add'),
				'users'=>array('@'), //@表示已经验证过的用户
				),
			array(
				'deny',
				'users'=>array('*'), //*表示所有用户
				),
			);
	}

	public function actionIndex(){

		$cri = new CDbCriteria();  //新的查询方法
		$articleModel = Article::model();
		$total = $articleModel ->count($cri);
		$pager = new CPagination($total); //Yii中的分页类
		$pager ->pageSize = 3; 	//每页显示条数
		$pager ->applyLimit($cri);	//进行limit截取
		$articleInfo = $articleModel->findAll($cri);

		$data = array(
			'articleInfo'=>$articleInfo,
			'pages' => $pager
			);
		$this->render('index',$data);
	}

	/**
	 * 添加文章
	 */
	public function actionAdd(){
		$articleModel = new Article();
		$categoryModel = Category::model();
		$categoryInfo = $categoryModel->findAllBySql("SELECT cid,cname FROM {{category}}");
		$cateArr = array();
		$cateArr[] = '请选择';
		foreach ($categoryInfo as  $v) {
			$cateArr[$v->cid] = $v->cname; 
		}

		if(isset($_POST['Article'])){
			//引入图片上传类
			$articleModel ->thumb = CUploadedFile::getInstance($articleModel,'thumb');
			if($articleModel->thumb){
				$preRand = 'img_'.time().mt_rand(0,999);
				$imgName = $preRand.'.'.$articleModel->thumb->extensionName;
				$articleModel->thumb->saveAs('uploads/'.$imgName);//保存的路径
				$articleModel->thumb = $imgName;

				//上传缩略图
				$path = dirname(Yii::app()->BasePath).'/uploads/';//存放路径
				$thumb = Yii::app()->thumb; //调用缩略图类（扩展里面的）
				$thumb ->image = $path.$imgName;
				$thumb ->width = 130;
				$thumb ->height = 95;
				$thumb ->mode = 4;
				$thumb ->directory =$path; //目录
				$thumb ->defaultName = $preRand; //缩略图名称
				$thumb ->createThumb(); //创建缩略图 扩展类内置方法
				$thumb ->save(); //保存缩略图
			}
			
			$articleModel ->attributes = $_POST['Article'];
			$articleModel->time = time();
		}
		if($articleModel->save()){
			$this->redirect(array('index'));
		}
		
		$data = array(
			'articleModel'=>$articleModel,
			'cateArr'=>$cateArr
			);
		$this->render('add',$data);
	}

	public function actionDel($aid){
		$articleModel = Article::model();
		if($articleModel->deleteByPk($aid)){
			$this->redirect(array('index'));
		}else{
			echo 'fail';
		}
	}
}

	
 ?>