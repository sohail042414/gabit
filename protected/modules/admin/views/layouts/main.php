<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv=Refresh content=60;url=<?php /*echo $this->createUrl('dashboard/lock'); */ ?>>-->
    <meta name="description" content="">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <!--Core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery-ui/jquery-ui-1.10.1.custom.min.css"
          rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jvector-map/jquery-jvectormap-1.2.2.css"
          rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/clndr.css" rel="stylesheet">
    <!--clock css-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/morris-chart/morris.css">
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
    
    <script type="text/javascript">
        var global_site_base_url = '<?php echo Yii::app()->request->baseUrl; ?>';
    </script>
    
</head>
<body class="skin-blue">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0&appId=1874544942749468&autoLogAppEvents=1" nonce="rTAGROEg"></script>

<section id="container">
    <!--header start-->
    <?php $this->renderPartial('/layouts/header'); ?>
    <!--header end-->

    <!--sidebar start-->
    <?php $this->renderPartial('/layouts/left_menu'); ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <?php echo $content; ?>
            </div>
        </section>
    </section>
    <!--main content end-->
</section>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs3/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery.scrollTo.min.js"></script>
<script
    src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery.nicescroll.js"></script>
<!--[if lte IE 8]>
<script language="javascript" type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/skycons/skycons.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/calendar/clndr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/calendar/moment-2.2.1.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/evnt.calendar.init.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/jquery.customSelect.min.js"></script>
<!--common script init for all pages-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/scripts.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/advanced-form.js"></script>

<!--Core CSS -->

<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/bootstrap-timepicker/css/timepicker.css"/>
<!--script for this page-->

<script type="text/javascript">
$(function() {
    //apply ck editor
    if($('.apply-ckeditor').length > 0) {
        $('.apply-ckeditor').each(function() {
            CKEDITOR.replace($(this).attr('id'), {
                filebrowserBrowseUrl: global_site_base_url+'/kcfinder/browse.php?type=files',
                filebrowserImageBrowseUrl: global_site_base_url+'/kcfinder/browse.php?type=images',
                filebrowserFlashBrowseUrl: global_site_base_url+'/kcfinder/browse.php?type=flash',
                filebrowserUploadUrl: global_site_base_url+'/kcfinder/upload.php?type=files',
                filebrowserImageUploadUrl: global_site_base_url+'/kcfinder/upload.php?type=images',
                filebrowserFlashUploadUrl: global_site_base_url+'/kcfinder/upload.php?type=flash'
            });
        });        
    }
});
</script>
</body>
</html>
