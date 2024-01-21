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
#user_profile{width:100%; float:left; margin-top:30px;}

label{font-size:13px; line-height:30px;}
.label_cls{width:140px; float:left;}
.input_cls{float:left;}

    .required {
        float: left;
        width: 154px;
		text-align:left;
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
		padding-left:5px;
    }

    .btn.btn-primary {
    background:rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)) !important; /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%) !important; /* Chrome10+,Safari5.1+ */
    border: medium none;
    color: #fff;
    cursor: pointer;
    font-size: 13px;
    font-weight: normal;
    line-height: 35px;
    margin-bottom: 50px;
    margin-left: 140px;
    padding: 0 20px;
    text-align: center;
    width: auto;
	float:left;
	border-radius:5px !important;
}
.btn.btn-primary:hover { 
border: medium none;
color: #fff;
cursor: pointer;
font-size: 13px;
font-weight: normal;
line-height: 35px;
margin-bottom: 50px;
margin-left: 140px;
padding: 0 20px;
text-align: center;
width: auto;
float:left;
border-radius:5px !important;
background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0 !important; 
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#959595), color-stop(0%,#000000), color-stop(8%,#4e4e4e), color-stop(16%,#4e4e4e), color-stop(50%,#0d0d0d), color-stop(83%,#4e4e4e), color-stop(91%,#4e4e4e), color-stop(100%,#1b1b1b)) !important; /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #959595 0%,#000000 0%,#4e4e4e 8%,#4e4e4e 16%,#0d0d0d 50%,#4e4e4e 83%,#4e4e4e 91%,#1b1b1b 100%) !important; /* Chrome10+,Safari5.1+ */
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
		.label_cls{width:100%;}
		.btn.btn-primary{margin-left:0px;}
    }
/*    #Users_agree_to_terms {
    margin-left: 0px;
    }*/
    .chektext {
 
    margin-left: 144px;
   
   }
   #Users_agree_to_terms {
    float: left !important;
    width: auto !important;
    margin-top: -10px;
    }
    .input_cls.chektext lebel span {
    float: left;
    font-size: 12px;
    margin-left: 10px;
    } 
    label {
    float: left;
    }
    
    
</style>


<div id="sing-up">
    <div class="main_banner" xmlns="http://www.w3.org/1999/html">
        <div class="inner-container">
            <div class="inner-left">
            <div class="inner-page">
                <h4>Update User Profile</h4>
                <div id="user_profile">
                <?php
                /* @var $this UsersController */
                /* @var $model Users */
                /* @var $form CActiveForm */
                ?>

                <div class="form">

                    <?php
                    $form = $this->beginWidget('CoreGxActiveForm', array(
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
                                <?php
                                if (!empty($user->username)) {
                                    echo $form->textField($model, 'username', array('maxlength' => 250,'value'=>$user->username));
                                } else {
                                    echo $form->textField($model, 'username', array('maxlength' => 250));
                                }
                                ?>
                                <?php echo $form->error($model, 'username'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label_cls"><?php echo $form->labelEx($model, 'email'); ?></div>
                            <div class="input_cls">
                                <?php
                                if (!empty($user->email)) {
                                    echo $form->textField($model, 'email', array('maxlength' => 250,'value'=>$user->email,'disabled'=>'disabled'));
                                } else {
                                    echo $form->textField($model, 'email', array('maxlength' => 250));
                                } ?>
                                <?php echo $form->error($model, 'email'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label_cls"><?php echo $form->labelEx($model, 'age'); ?></div>
                            <div class="input_cls">
                                <?php
                                if (!empty($user->age)) {
                                    echo $form->textField($model, 'age', array('maxlength' => 250,'value'=>$user->age));
                                } else {
                                    echo $form->textField($model, 'age');
                                } ?>
                                <?php echo $form->error($model, 'age'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label_cls"><?php echo $form->labelEx($model, 'sex'); ?></div>
                            <div class="input_cls">
                                <?php
                                echo $form->dropDownList($model, 'sex', array('' => Yii::t('app', 'Enter Sex'), 'M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female')),array('options' => array($user->sex => array('selected' => 'selected')))); ?>
                                <?php echo $form->error($model, 'sex'); ?>
                            </div>
                        </div>
                        <div class="form-group " >
                          <div class="label_cls"><?php echo $form->labelEx($model, 'user_image'); ?></div>
                          <div class="input_cls"><?php echo $form->fileField($model, 'user_image', array('maxlength' => 250, 'class' => 'upload_file', 'value' =>$user->user_image));
                        
                        if (!empty($user->user_image)) {
                               echo '<input type="hidden" id="HomeSlider_slider_image" maxlength="250" name="Users[user_image]" value="' . $user->user_image . '">';
                                echo '<img class="preview_image" src="' . SITE_ABS_PATH_USER_IMAGE_THUMB . $user->user_image. '" alt="" />';
                                }
                                ?>
                              <?php echo $form->error($model, 'user_image'); ?>
                          </div>
                          </div>
                          
                        <div class="form-group">
                            <div class="label_cls"><?php echo $form->labelEx($model, 'password'); ?></div>
                            <div class="input_cls">
                                <?php
                                if (!empty($user->password)) {
                                    echo $form->textField($model, 'password', array('maxlength' => 250));
                                } else {
                                    echo $form->textField($model, 'password');
                                } ?>
                                <?php echo $form->error($model, 'password'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label_cls"><?php echo $form->labelEx($model, 'confirm_password'); ?></div>
                            <div class="input_cls">
                                <?php echo $form->textField($model, 'confirm_password', array('maxlength' => 250));?>
                                <?php echo $form->error($model, 'confirm_password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label_cls"><?php //echo $form->labelEx($model,'agree_to_terms'); ?></div>
                           <div> <?php //echo $form->labelEx($model,'agree_to_terms'); ?></div>
                           <div class="input_cls chektext"><lebel><?php echo $form->checkBox($model,'agree_to_terms', array('value'=>'0','uncheckValue'=>'1' ),array('checked'=>'checked')); ?><span>Agree to our terms of service</span></lebel>
                                <?php  echo $form->error($model,'agree_to_terms'); ?>
                           </div>     
                         </div>
                        

                        </div>
                    
                        <div class="clear"></div>
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
        
    </div>

</div>

