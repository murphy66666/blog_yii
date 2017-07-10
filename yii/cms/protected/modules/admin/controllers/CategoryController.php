<?php 

	class CategoryController extends Controller{

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
					'actions'=>array('index','del','add','edit'),
					'users'=>array('@'), //@表示已经验证过的用户
					),
				array(
					'deny',
					'users'=>array('*'), //*表示所有用户
					),
				);
		}

		/**
		 * 查看栏目
		 */
		public function actionIndex(){
			$categoryModel = Category::model();
			$sql = "SELECT cid,cname from {{category}}";
			$categoryInfo = $categoryModel->findAllBySql($sql);
			$this->render('index',array('categoryInfo'=>$categoryInfo));
		}

		/**
		 * 添加栏目
		 */
		public function actionAdd(){
			$categoryModel = new Category();
			if(isset($_POST['Category'])){
				$categoryModel->attributes = $_POST['Category'];
				if($categoryModel->save()){
					$this->redirect(array('index'));
				}
			}
			$this->render('add',array('categoryModel'=>$categoryModel));
		}

		/**
		 * 修改栏目
		 */
		public function actionEdit($cid){
			$categoryModel = Category::model();
			$categoryInfo = $categoryModel ->findByPk($cid);
			if(isset($_POST['Category'])){
				$categoryModel->attributes = $_POST['Category'];
				if($categoryModel->save()){
					$this->redirect(array('index'));
				}
			}
			
			$this->render('edit',array('categoryModel'=>$categoryInfo));
		}

		/**
		 * 删除栏目
		 */
		public function actionDel($cid){
			$articleModel = Article::model();
			$sql = "SELECT aid from {{Article}} WHERE cid=$cid";
			$articleInfo = $articleModel ->findBySql($sql);
			if(is_object($articleInfo)){
				Yii::app()->user->setFlash('hasArt','栏目下面有文章，请先删除文章');
				$this->redirect(array('index'));
			}else{
				if(Category::model()->deleteByPk($cid)){
					$this->redirect(array('index'));
				}
			}

		}
	}
 ?>