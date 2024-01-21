<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png">

    <title>Session Expired.!</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style.css?1" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style-responsive.css" rel="stylesheet"/>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/html5shiv.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/respond.min.js"></script>
    <![endif]-->
</head>

<body class="lock-screen" onload="startTime()">

<div class="lock-wrapper">

    <div id="time"></div>
    <?php
    $user_model = Users::model()->findByPk($_SESSION['locked_user_id']);
    ?>

    <div class="lock-box text-center">
        <div class="lock-name"><?php echo $user_model->first_name . ' ' . $user_model->last_name; ?></div>
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/admin/lock_thumb.jpg" alt="lock avatar"/>
        <?php
        if (!empty($user_model->profile_picture) && file_exists(SITE_REL_PATH_PROFILE_PICTURE_THUMB . $user_model->profile_picture)) { ?>
            <img
                src="<?php echo SITE_ABS_PATH_PROFILE_PICTURE_THUMB . $user_model->profile_picture; ?>"
                class="img-circle"
                alt="User Image"/>
        <?php
        } else {
            ?>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/admin/avatar5.png"
                 class="img-circle"
                 alt="User Image"/>
        <?php
        }
        ?>

        <div class="lock-pwd">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('class' => 'form-inline',),
            ));
            ?>
            <?php echo $form->hiddenField($model, 'username', array('value' => $user_model->username)); ?>
            <div class="form-group">
                <?php echo $form->passwordField($model, 'password', array('placeholder' => 'Password', 'class' => 'form-control lock-input')); ?>
                <button class="btn btn-lock" type="submit">
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
            <?php $this->endWidget(); ?>
        </div>

    </div>
</div>
<script>
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
        t = setTimeout(function () {
            startTime()
        }, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
</script>
</body>
</html>
