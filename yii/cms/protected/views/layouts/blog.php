<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/assets/index/css/common.css">
</head>
<body>
	<div id="top">
	</div>
	<div id="header">
		<div class="logo">
			<a href=""><img src="<?php echo Yii::app()->request->baseUrl ?>/assets/index/images/logo.jpg" alt=""></a>
		</div>
		<div class="navigation">
			<a href="<?php echo $this->createUrl('./index.html'); ?>">首页</a>
			<?php 
				$articleModel = Article::model();
				$common = $articleModel->common();
			 ?>
			<?php foreach($common['nav'] as $v): ?>
			<a href="<?php echo $this->createUrl('category/index',array('cid'=>$v['cid'])) ?>"><?php echo $v->cname ?></a>
		<?php endforeach ?>
		</div>
	</div>
	
	<?php echo $content ?>

	
	<div class='sidebar'>
			<div class='item'>
				<h2>文章标题</h2>
				<ul class='flink'>
					<?php if($this->beginCache('title', array('duration'=>5))): ?>
						<?php foreach($common['title'] as $value): ?>
							<li><a href="<?php echo $this->createUrl('article/index', array('aid'=>$value->aid)) ?>"><?php echo $value->title ?></a></li>
						<?php endforeach ?>
					<?php $this->endCache();endif; ?>
				</ul>
			</div>
		</div>
	</div>
	
	<div id="footer">
		<div class="bgbar"></div>
		<div class="bottom">
			<div class="pos">
				<div class="copyright">
					© Copyright 2001-2026 www.haha.com 哈哈网
				</div>
			</div>
		</div>
	</div>
</body>
</html>