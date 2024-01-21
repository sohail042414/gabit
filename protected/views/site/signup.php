<style type="text/css">
    @font-face {
        font-family: 'Calibri';
        src: url('../fonts/Calibri.eot?#iefix') format('embedded-opentype'),
            url('../fonts/Calibri.woff') format('woff'),
            url('../fonts/Calibri.ttf') format('truetype'),
            url('../fonts/Calibri.svg#Calibri') format('svg');
        font-weight: normal;
        font-style: normal;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        display: inline-block;
        color: #464646;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        /*background:url(../images/index1.jpg) top center no-repeat;
	opacity:0.3;*/
        color: #464646;
        font-size: 12px;
    }

    .required {
        float: left;
        width: 154px;
    }

    .errorMessage {
        float: left;
        margin-left: 155px;
        margin-top: 6px;
        width: 210px;
        color: red;
    }

    .form-group {
        width: 100%;
        float: left;
        margin-bottom: 15px;
    }

    .required>span {
        color: red;
        float: none;
        width: 0;
    }

    #sing-up {
        width: 100%;
    }

    .inner-page>h4 {
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ee1023), color-stop(100%, #9c0405)) !important;
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #ee1023 0%, #9c0405 100%) !important;
        /* Chrome10+,Safari5.1+ */
        color: #fff;
        float: left;
        margin: 0 0 16px;
        padding: 8px 0;
        text-align: center;
        font-size: 16px;
        width: 367px;
    }


    .form-control {
        border-color: #b8b8b8;
        border-style: solid;
        border-width: 1px;
        width: 208px;
        height: 35px;
        padding-left: 5px;
    }

    .btn.btn-primary:hover {
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ee1023), color-stop(100%, #9c0405)) !important;
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #ee1023 0%, #9c0405 100%) !important;
        /* Chrome10+,Safari5.1+ */
        color: #fff;
        -webkit-appearance: none;
    }

    .btn.btn-primary {
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #959595), color-stop(0%, #000000), color-stop(8%, #4e4e4e), color-stop(16%, #4e4e4e), color-stop(50%, #0d0d0d), color-stop(83%, #4e4e4e), color-stop(91%, #4e4e4e), color-stop(100%, #1b1b1b)) !important;
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) !important;
        /* Chrome10+,Safari5.1+ */
        color: #fff;
        font-size: 13px;
        margin-top: 15px;
        padding: 6px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        -webkit-appearance: none;
        margin-left: 154px;
    }

    .form-group a {
        color: #464646;
        line-height: 18px;
    }

    .form-group a:hover {
        color: #666;
        text-decoration: none;
    }

    #view_btn {
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
        border: medium none;
        border-radius: 5px !important;
        color: #fff;
        float: left;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
        line-height: 35px;
        margin-top: 40px !important;
        padding: 0px 30px;
        text-align: center;
    }

    .label_cls {
        line-height: 35px;
    }

    #Users_agree_to_terms_em_ {
        margin-left: 154px;
        width: 200px;
    }

    #dial_message {
        font-size: 16px;
        margin: 0 auto;
    }


    #Users_agree_to_terms {
        float: left;
        margin: 0 10px 0 0;
    }

    #users-form .terms_cls {
        margin-left: 154px;
        float: left;
    }

    @media only screen and (max-width:767px) {
        .inner-page>h4 {
            width: 100%;
        }
    }

    @media only screen and (max-width:360px) {
        .errorMessage {
            margin-left: 0px;
        }

        .btn.btn-primary {
            margin-left: 0px;
        }

        #Users_agree_to_terms {
            margin-left: 0px;
        }

        #Users_agree_to_terms_em_ {
            margin-left: 0px;
        }

        #users-form .terms_cls {
            margin-left: 0px;
        }
    }
</style>

<?php /* ?>
<script src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
<?php */ ?>


<script>
    $(document).ready(function() {
        $('#view_btn').click(function() {
            parent.$.fancybox.close();
        });
    });

    function redirectToLogin() {
        parent.window.location = "<?php echo Yii::app()->createUrl('site/login', array('type' => 'from_signup_popup')); ?>";
    }
</script>
<?php
if (!empty($_REQUEST['flag'])) { ?>

    <div id="dial_message_container">
        <h4 id="dial_message">Thanks for Signing Up.</h4>
        <p style="line-height: 20px;font-size:13px">Your account has been created. To continue, please click the activation link that has been sent to your email. If not found, pls check your spam.</p>
        <a href="<?php echo Yii::app()->createUrl('site/login', array('type' => 'from_signup_popup')); ?>" target="_parent" id="view_btn" class="button-tab" style="margin: 10px auto !important; float:none; display:table;">OK</a>
    </div>

<?php } else {
?>

    <div id="sing-up">
        <div class="main_banner" xmlns="http://www.w3.org/1999/html">
            <div class="inner-container">
                <div class="inner-page">
                    <h4>User Registration</h4>
                    <p>Only sign up if you are a fundraiser. You do not need to sign up here to donate to cases. Tap <a target="_blank" href="<?php echo Yii::app()->createUrl('fundraiser/locatefundraiser'); ?>">Explore Fundraisers</a> instead to support one or more cases.</p>
                    <div class="form">

                        <?php
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            //'id' => 'users-form',users-signup-form
                            'id' => 'users-form',
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => true,
                            'htmlOptions' => array(
                                'enctype' => 'multipart/form-data'
                            ),
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                                'validateOnChange' => true,
                            ),
                        ));
                        ?>
                        <?php echo UtilityHtml::get_flash_message(); ?>
                        <div class="box-body">


                            <div class="form-group">
                                <div class="label_cls"><?php echo $form->labelEx($model, 'username'); ?></div>
                                <div class="input_cls">
                                    <?php echo $form->textField($model, 'username', array('maxlength' => 250)); ?>
                                    <?php echo $form->error($model, 'username'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="label_cls"><?php echo $form->labelEx($model, 'email'); ?></div>
                                <div class="input_cls" id="r_email">
                                    <?php echo $form->textField($model, 'email', array('maxlength' => 250)); ?>
                                    <?php echo $form->error($model, 'email'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="label_cls"><?php echo $form->labelEx($model, 'phone'); ?></div>
                                <div class="input_cls">
                                    <?php echo $form->textField($model, 'phone'); ?>
                                    <?php echo $form->error($model, 'phone'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="label_cls"><?php echo $form->labelEx($model, 'age'); ?></div>
                                <div class="input_cls">
                                    <?php echo $form->textField($model, 'age'); ?>
                                    <?php echo $form->error($model, 'age'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="label_cls"><?php echo $form->labelEx($model, 'sex'); ?></div>
                                <div class="input_cls">
                                    <?php echo $form->dropDownList($model, 'sex', array('' => Yii::t('app', 'Select Sex'), 'M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female'))); ?>
                                    <?php echo $form->error($model, 'sex'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="label_cls"><?php echo $form->labelEx($model, 'password'); ?></div>
                                <div class="input_cls">
                                    <?php echo $form->passwordField($model, 'password', array('maxlength' => 32)); ?>
                                    <?php echo $form->error($model, 'password'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="label_cls"><?php echo $form->labelEx($model, 'confirm_password'); ?></div>
                                <div class="input_cls">
                                    <?php echo $form->passwordField($model, 'confirm_password', array('maxlength' => 32)); ?>
                                    <?php echo $form->error($model, 'confirm_password'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="terms_cls">
                                    <?php echo $form->checkBox($model, 'agree_to_terms'); ?>
                                    <a target="_blank" href="<?php echo $this->createUrl('cms/terms_of_service'); ?>"> Agree to our terms of service</a>
                                    <?php echo $form->error($model, 'agree_to_terms', array('style' => 'margin:0px;')); ?>
                                </div>
                            </div>


                        </div>
                        <div class="box-footer">
                            <?php
                            echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn btn-primary'));
                            ?>
                        </div>

                        <?php
                        $this->endWidget();
                        ?>
                    </div>

                </div>
                <!-- form -->
            </div>
        </div>

    </div>
<?php } ?>