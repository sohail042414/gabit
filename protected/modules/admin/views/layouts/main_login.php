<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!--Core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/font-awesome/css/font-awesome.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/theme.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style-responsive.css" rel="stylesheet"/>

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">
    <?php echo $content; ?>
</div>


<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs3/js/bootstrap.min.js"></script>

</body>
</html>
