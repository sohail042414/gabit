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
    }

    label {
        font-size: 13px;
        line-height: 30px;
    }

    .label_cls {
        width: 140px;
        float: left;
    }

    .input_cls {
        float: left;
    }

    .required {
        float: left;
        width: 154px;
        text-align: left;
    }

    .errorMessage {
        float: left;
        margin-left: 0px;
        margin-top: 6px;
        width: 100%;
        color: red;
		float:left;
		text-align:left;
		font-size:12px;	
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
        width: 250px;
        height: 35px;
        padding-left: 5px;
		float:left;
    }
	
.sub_text{padding:0px; margin:10px 0 40px 0 !important; float:left;}

#user_profile .alert-success{background:none; color:green !important; font-weight:bold; text-align:left; font-size:15px; line-height:20px !important; font-family:Arial, Helvetica, sans-serif; margin:-20px 0 30px 0 !important; padding:0px !important; width:100%; float:left;}
#user_profile .alert{float:left; width:100%; color:red; font-size:15px; line-height:20px; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:bold; margin:-20px 0 30px 0px !important;}

.box-footer{float:left;}
#user_profile .btn.btn-primary{width:auto; margin-top:0px; padding:0px 20px; text-align:center; line-height:35px; margin-left:140px; text-align:center; color:#FFF; font-size:13px; font-weight:normal; border:none; cursor:pointer; height:37px; border-radius:5px !important; -webkit-appearance: none;
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

		#user_profile .btn.btn-primary{margin-left: 0px;}
    }

</style>

<div id="sing-up">
    <div class="main_banner" xmlns="http://www.w3.org/1999/html">
        <div class="inner-container">
            <div class="inner-left">
                <div class="inner-page">
                    <h4>Set your account credentials</h4>
                    <div class="clear"></div>
                    <p class="sub_text">To be able to access your dashboard, please create your login credentials.</p>
                    <div class="clear"></div>
                    <div id="user_profile">
                        <div class="form">
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'forgot-password-form',
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => true,
                                'htmlOptions' => array(
                                    'enctype' => 'multipart/form-data'
                                ),
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                    'validateOnChange' => true,
                                ),
                                'htmlOptions' => array('class' => 'form-signin',),
                            ));
                            ?>
                            <?php echo UtilityHtml::get_flash_message(); ?>
                            <div class="box-body">

                                <div class="form-group">
                                    <div class="label_cls"><?php echo $form->labelEx($model, 'email'); ?></div>
                                    <div class="input_cls">
                                        <?php echo $form->textField($model, 'email', array(
                                            'placeholder' => 'Email', 
                                            'class' => 'form-control',
                                            'disabled' => 'disabled',
                                            )); ?>
                                        <?php echo $form->error($model, 'email'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="label_cls">
                                        <?php echo $form->labelEx($model, 'username'); ?>
                                    </div>
                                    <div class="input_cls">
                                        <?php echo $form->textField($model, 'username', array('placeholder' => 'User name', 'class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'username'); ?>
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
                                    <div class="label_cls">
                                        <?php echo $form->labelEx($model, 'sex'); ?>
                                    </div>
                                    <div class="input_cls">
                                    <?php echo $form->dropDownList($model, 'sex', array(
                                        '' => Yii::t('app', 'Select Sex'), 
                                        'M' => Yii::t('app', 'Male'), 
                                        'F' => Yii::t('app', 'Female')
                                    ),
                                    array('class'=>'form-control','style'=>'width:262px;')
                                        ); ?>
                                    <?php echo $form->error($model, 'sex'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="label_cls" style="text-align: left !important;">
                                        <?php echo $form->labelEx($model, 'password'); ?>
                                    </div>
                                    <div class="input_cls">
                                        <?php echo $form->passwordField($model, 'password', array('maxlength' => 32, 'class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'password'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="label_cls" style="text-align: left !important;">
                                        <?php echo $form->labelEx($model, 'confirm_password'); ?>
                                    </div>
                                    <div class="input_cls">
                                    <?php echo $form->passwordField($model, 'confirm_password', array('maxlength' => 32, 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'confirm_password'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="terms_cls" style="text-align:left;padding-left:140px;">
                                    <?php echo $form->checkBox($model, 'agree_to_terms'); ?>
                                    <a target="_blank" href="<?php echo $this->createUrl('cms/terms_of_service');?>"> Agree to our terms of service</a>
                                    <?php echo $form->error($model, 'agree_to_terms',array('style'=>'margin:0px;')); ?>
                                    </div>
                                </div>

                            </div>
                            <div class="clear"></div>
                            <div class="box-footer">
                                <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary', 'value' => 'Submit')); ?>

                            </div>
                            <?php $this->endWidget(); ?>
                        </div>

                    </div>
                    <!-- form -->
                </div>
            </div>
        </div>
    </div>

</div>