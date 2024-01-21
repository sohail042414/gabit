<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="/favicon.png"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<title>Top Donors Reward Program (TRDP)</title>
</head>
<?php 
$body_class = "";
if(Yii::app()->controller->action->id != 'index'){
	$body_class = 'inner-pagee';
}
?>
<body class="<?php echo $body_class; ?>">
	<nav class="navbar navbar-expand-lg navbar-light">
	  <div class="container">
	    <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('rewards/index'); ?>"><img src="<?php echo SITE_ABS_PATH; ?>css/rewards/images/reward-badge.png" alt="Badge"></a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarScroll">
	      <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
		  	<li class="nav-item">
	          <a class="nav-link menu" href="<?php echo Yii::app()->createUrl('rewards/donors'); ?>" >TDRP for Donors </a>
	        </li>
	        <li class="nav-item menu">
	          <a class="nav-link" href="<?php echo Yii::app()->createUrl('rewards/fundraisers'); ?>" >TDRP for Fundraisers </a>
	        </li>
	        <li class="nav-item menu">
	          <a class="nav-link" href="<?php echo Yii::app()->createUrl('rewards/history'); ?>">Historic Rewards</a>
	        </li>
	        <li class="nav-item menu">
	          <a class="nav-link" href="<?php echo Yii::app()->createUrl('rewards/testimonials'); ?>">Testimonials</a>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="main">
		<div class="container-fluid">
			<?php echo $content; ?>
		</div>
	</div>
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer-left">
						<p>Images: Deisgned by Freepik</p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer-right">
						<p>Copyright@ 2023. DajEd RollOutTech. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>