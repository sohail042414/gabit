<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <!-- Code for the meta title -->
    <?php if (!empty($this->metaTitle)) { ?>
        <title><?php echo CHtml::encode($this->metaTitle); ?></title>
    <?php } else { ?>
        <title>Giveyoubit</title>
    <?php } ?>

    <!-- Code for the meta Description -->
    <?php if (!empty($this->metaDescription)) { ?>
        <meta name="description" content="<?php echo CHtml::encode($this->metaDescription); ?>" />
    <?php } else { ?>
        <meta name="description" content="" />
    <?php } ?>
    <!-- Code for the meta Keyword -->
    <?php if (!empty($this->metaKeyword)) { ?>
        <meta name="keywords" content="<?php echo CHtml::encode($this->metaKeyword); ?>" />
    <?php } else { ?>
        <meta name="keywords" content="" />
    <?php } ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/loader.css" rel="stylesheet" type="text/css">
    <!-- <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script> -->
</head>

<body>
    <div id="loader" style="display: none;"></div>
    <?php echo $content; ?>
</body>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/loader.js"></script>
</html>