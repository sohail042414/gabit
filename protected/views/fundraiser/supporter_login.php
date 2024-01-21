<style type="text/css">
    .clear {
        margin: 0px;
        padding: 0px;
        clear: both;
    }

    .supporter_left {
        width: 240px;
        float: left;
        margin-bottom: 10px;
    }

    .supporter_left img {
        max-width: 100%;
    }

    .supporter_right {
        width: 325px;
        float: right;
    }

    .supporter_right h4 {
        float: left;
        font-size: 24px;
        font-weight: lighter;
        width: 100%;
        margin: 0px;
        font-family: Arial, Helvetica, sans-serif;
        text-transform: capitalize;
        border-bottom: #666 1px solid;
        margin-bottom: 10px;
        line-height: 50px;
    }

    .supporter_right p {
        float: left;
        font-size: 13px;
        font-weight: 500;
        width: 100%;
        margin: 0px;
        font-family: Arial, Helvetica, sans-serif;
        margin-bottom: 20px;
    }

    .link_login, .link_signup, .view_btn {
        font-size: 13px;
        font-weight: 600;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        line-height: 30px;
        padding: 0px 10px;
        float: left;
        color: #FFF;
        text-decoration: none;
        border-radius: 3px;
        margin-bottom: 20px;
        margin-right: 5px;
        background: #f31126;
        -webkit-appearance: none;
    }

    .form {
        margin-top: 20px;
        float: left;
    }

    .supporter_right .form {
        width: 100%;
        float: left;
    }

    .row {
        width: 100%;
        float: left;
        margin-bottom: 10px
    }

    .label_cls {
        width: 125px !important;
        float: left;
        font-size: 13px;
        font-weight: 500;
        width: 100%;
        margin: 0px;
        font-family: Arial, Helvetica, sans-serif;
        line-height: 30px;
    }

    .input_cls {
        width: 190px;
        float: left;
    }

    .input_cls select {
        width: 190px;
    }

    .form-control {
        font-size: 13px;
        font-weight: 500;
        width: 100%;
        margin: 0px;
        font-family: Arial, Helvetica, sans-serif;
        width: 95%;
        height: 30px;
        border: #CCC 1px solid;
        float: left;
        padding-left: 5px;
    }

    .buttons input {
        font-size: 13px;
        font-weight: 600;
        font-family: Arial, Helvetica, sans-serif;
        background: #f31126;
        text-align: center;
        line-height: 30px;
        padding: 0px 10px;
        float: left;
        color: #FFF;
        text-decoration: none;
        border-radius: 3px;
        margin-bottom: 20px;
        border: none;
        background: #f31126;
        margin-left: 125px;
        -webkit-appearance: none;
    }

    span.required {
        color: red;
    }

    .errorMessage {
        color: red;
        font-family: arial;
        font-size: 12px;
        line-height: 22px;
        width: 100%;
        float: left;
    }

    #login-form .alert-danger {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: red;
        font-weight: bold;
        float: left;
        margin-bottom: 10px;
    }

    .alert.alert-success.alert-dismissable {
        color: green;
        /*font-size: 11px;*/
        font-size: 13px;
        margin: 0 0 10px;
        font-family: arial, sans-serif;
        font-weight: bold;
    }

    #Users_agree_to_terms {
        float: left;
        margin-right: 10px;
        margin-left: 125px;
    }

    .form-group a {
        color: #666;
        line-height: 18px;
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .form-group a:hover {
        text-decoration: none;
    }

    #Users_agree_to_terms_em_ {
        margin-left: 125px;
        width: 200px;
    }

    @media only screen and (max-width: 568px) {
        .supporter_left, .supporter_right {
            width: 100%;
        }
    }

    @media only screen and (max-width: 360px) {
        .buttons input {
            margin-left: 0px;
        }

        #Users_agree_to_terms {
            margin-left: 0px;
        }

        #Users_agree_to_terms_em_ {
            margin-left: 0px;
        }
    }

    @media only screen and (min-width: 481px) and (max-width: 767px) {
        .supporter_left {
            width: 180px;
        }
    }

    @media only screen and (-webkit-min-device-pixel-ratio: 0) {
        .input_cls select {
            width: 188px;
        }
    }

</style>
<!--<script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/jquery.min.js"></script>-->
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
<script>
    $(document).ready(function () {
        $('.view_btn').click(function () {
            parent.$.fancybox.close();
        });
    });
</script>


<div class="supporter_left">
    <img class="fund_image" src="<?php echo $fundraiser->getImageURL(); ?>">
</div>
<div class="supporter_right">
    <h4><?php echo $fundraiser->fundraiser_title; ?></h4>
    <p>Please login or sign up to become a supporter of this fundraiser</p>
    <a class="link_signup" href="<?php echo Yii::app()->createUrl('fundraiser/supporter_signup',array('fundraiser_id' => $fundraiser->id)); ?>">Sign up</a> 
    <div id="login_form" class="container_login">
        <h4>Login</h4>
        <div class="clear"></div>
        <div class="form">
            <?php
            $form = $this->beginWidget('CoreGxActiveForm', array(
                'id' => 'login-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data'
                ),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
            )); ?>
            <?php
            echo UtilityHtml::get_flash_message(); ?>

            <div class="row">
                <div class="label_cls"><?php echo $form->labelEx($model, 'username'); ?></div>
                <div class="input_cls">
                    <?php echo $form->textField($model, 'username'); ?>
                    <div class="clear"></div>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>
            <div class="row">
                <div class="label_cls"><?php echo $form->labelEx($model, 'password'); ?></div>
                <div class="input_cls">
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <div class="clear"></div>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
            </div>
            <div class="row buttons">
                <?php echo CHtml::submitButton('Login'); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    <!-- form -->
</div>