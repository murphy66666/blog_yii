<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" href="../../../assets/admin/css/login.css">
	<script type="text/javascript" src="../../../assets/admin/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="../../../assets/admin/js/login.js"></script>
	<title>后台登录</title>
</head>
<body>
	<div id="divBox">
		<?php $form=$this->beginWidget('CActiveForm') ?>
			<?php echo $form->textField($loginForm,'username',array('id'=>'userName')) ?>
			<?php echo $form->passwordField($loginForm,'password',array('id'=>'psd')) ?>
			<?php echo $form->textField($loginForm,'captcha',array('id'=>'verify')) ?>
			<input type="submit" id="sub" value=""/>
			<div class="captcha">
				<?php $this->widget("CCaptcha",array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'coursor:pointer'))) ?>
			</div>
		<?php $this->endWidget() ?>
		<div class="four_bj">
			<p class="f_lt"></p>
			<p class="f_rt"></p>
			<p class="f_lb"></p>
			<p class="f_rb"></p>
		</div>
		<ul id="peo">
			<li class="error"><?php echo $form->error($loginForm,'username') ?></li>
		</ul>
		<ul id="psd">
			<li class="error"><?php echo $form->error($loginForm,'password') ?></li>
		</ul>
		<ul id="ver">
			<li class="error"><?php echo $form->error($loginForm,'captcha') ?></li>
		</ul>
	</div>
</body>
</html>