<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $description; ?>">
<meta name="author" content="">

<title><?php echo $title; ?></title>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">

<!-- Custom styles for this template -->
<link href="navbar-fixed-top.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<style>
body {min-height: 1200px; padding-top: 70px;}
.navbar-default .navbar-brand {font-weight:bold; color:#333;}
.r { text-align:right }
.c { text-align:center;}
.g {color: #888 }
</style>
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">收起导航</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">期货日记 V1.0</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<!-- <li><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li> -->
					<?php foreach ($months_filter as $key => $val) {?>
					<?php if($current_filter == $key) {?>
						<li class="active" data="<?php echo $key ?>"><a href="#"><?php echo $val?></a></li>
					<?php }else{?>
						<li data="<?php echo $key ?>"><a href="#"><?php echo $val?></a></li>
					<?php }?>
					<?php }?>
					<!--<li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li> -->
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/"><span class="glyphicon glyphicon-user"></span> wudasong</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> 系统设置 <b class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-cog"></span> 系统设置</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>