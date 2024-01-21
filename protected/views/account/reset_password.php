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

    h1, h2, h3, h4, h5, h6 {
        display: inline-block;
        color: #464646;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        /*background:url(../images/index1.jpg) top center no-repeat;
        opacity:0.3;*/
        color: #464646;
        /*font-size: 12px;*/
    }

    #user_profile {
        width: 100%;
        float: left;
        margin-top: 30px;
    }

    label {
        font-size: 13px;
        line-height: 30px;
		width:100%;
		float:left;
    }

    .label_cls {
        width: 140px;
        float: left;
		text-align:left;
    }

    .input_cls {
        float: left;
    }

   #user_profile .required {
        float: none;
        width: auto !important;
        text-align: left;
    }

    .errorMessage {
        float: left;
        margin-left: 0px !important;
        margin-top: 6px;
        width: 100%;
        color: red;
		text-align:left;
		font-size:12px;
		font-size:13px;
    }

    .form-group {
        width: 100%;
        float: left;
        margin-bottom: 15px;
    }

    .required > span {
        color: red;
        float: none;
        width: 0;
    }

    #sing-up {
        width: 100%;
    }

    .form-control {
        border-color: #b8b8b8;
        border-style: solid;
        border-width: 1px;
        width: 213px;
        height: 35px;
		float:left;
        padding-left: 5px;
    }

.box-footer{float:left;}
#user_profile .btn.btn-primary{width:auto; padding:0px 20px; text-align:center; line-height:35px; margin-left:140px; text-align:center; color:#FFF; font-size:13px; font-weight:normal; border:none; cursor:pointer; height:37px; border-radius:5px !important; -webkit-appearance: none;
background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0 !important; 
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#959595), color-stop(0%,#000000), color-stop(8%,#4e4e4e), color-stop(16%,#4e4e4e), color-stop(50%,#0d0d0d), color-stop(83%,#4e4e4e), color-stop(91%,#4e4e4e), color-stop(100%,#1b1b1b)) !important; /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #959595 0%,#000000 0%,#4e4e4e 8%,#4e4e4e 16%,#0d0d0d 50%,#4e4e4e 83%,#4e4e4e 91%,#1b1b1b 100%) !important; /* Chrome10+,Safari5.1+ */
}
#user_profile .btn.btn-primary:hover{background:rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)) !important; /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%) !important; /* Chrome10+,Safari5.1+ */
}
    .form-group a {
        color: #666;
    }

    .form-group a:hover {
        color: #666;
        text-decoration: none;
    }

    @media only screen and (max-width: 767px) {
        .inner-page > h4 {
            width: 100%;
        }
    }

    @media only screen and (max-width: 480px) {
        .errorMessage {
            margin-left: 0px;
        }

        .label_cls {
            width: 100%;
        }

       #change-password-form .btn.btn-primary {
            margin-left: 0px !important; 
        }
    }

</style>

<div id="sing-up">
    <div class="main_banner" xmlns="http://www.w3.org/1999/html">
        <div class="inner-container">
            <div class="inner-left">
                <div class="inner-page">
                    <h4>Reset Password</h4>

                    <div id="user_profile">
                        <div class="form">
                            <?php $form = $this->beginWidget('CoreGxActiveForm', array(
                                'id' => 'change-password-form',
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                ),
                                'htmlOptions' => array('class' => '',),
                            ));
                            ?>
                            <?php echo UtilityHtml::get_flash_message(); ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="label_cls"><?php echo $form->labelEx($model, 'new_password'); ?></div>
                                    <div class="input_cls">
                                    <?php echo $form->passwordField($model, 'new_password'); ?>
                                    <div class="clear"></div>
                                    <?php echo $form->error($model, 'new_password'); ?>
                                        </div>
                                </div>

                                <div class="form-group">
                                    <div class="label_cls"><?php echo $form->labelEx($model, 'repeat_password'); ?></div>
                                    <div class="input_cls">
                                    <?php echo $form->passwordField($model, 'repeat_password'); ?>
                                    <div class="clear"></div>
                                    <?php echo $form->error($model, 'repeat_password'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="clear"></div>
                            <div class="box-footer">
                                    <?php
                                    echo GxHtml::submitButton(Yii::t('app', 'Reset Password'), array('class' => 'btn btn-primary'));
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
</div>

</div>