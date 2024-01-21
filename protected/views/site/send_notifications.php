<style>
#login_form .alert-success { 
    font-size: 16px !important;
    margin-bottom: 14px !important;
    margin-top: -13px !important;
}   
</style>

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>

<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <h4>Send Notifications</h4>  
            
            <div id="login_form" class="form notification_row">
                <?php
                    $form = $this->beginWidget('CoreGxActiveForm', array(
                        'id' => 'send-message-form',
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
                   
                    <div class="row">
                        <div class="label_cls">
                            <?php echo $form->labelEx($send_notification_form, 'name'); ?>
                        </div>                
                        <div class="input_cls">
                            <?php echo $form->textField($send_notification_form, 'name', array('maxlength' => 255)); ?>
                            <div class="clr"></div>
                            <?php echo $form->error($send_notification_form, 'name'); ?>
                        </div>
                    </div>
                    
                
<!--                    <div class="row">
                        <div class="label_cls">
                            <?php echo $form->labelEx($send_notification_form, 'email'); ?>
                        </div>                
                        <div class="input_cls">
                            <?php echo $form->textField($send_notification_form, 'email', array('maxlength' => 255)); ?>
                            <div class="clr"></div>
                            <?php echo $form->error($send_notification_form, 'email'); ?>
                        </div>
                    </div>-->
                    
                    
                     <div class="row">
                        <div class="label_cls">
                            <?php echo $form->labelEx($send_notification_form, 'subject'); ?>
                        </div>                
                        <div class="input_cls">
                            <?php echo $form->textField($send_notification_form, 'subject', array('maxlength' => 255)); ?>
                            <div class="clr"></div>
                            <?php echo $form->error($send_notification_form, 'subject'); ?>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="label_cls">
                            <?php echo $form->labelEx($send_notification_form, 'message'); ?>
                        </div>                
                        <div class="input_cls">
                            <?php echo $form->textarea($send_notification_form, 'message', array()); ?>
                            <div class="clr"></div>
                            <?php echo $form->error($send_notification_form, 'message'); ?>
                        </div>
                    </div>
                
                    <div class="box-footer row buttons">
                        <?php echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans')); ?>
                    </div>
                <?php
                    $this->endWidget();
                ?>
            </div>
        </div>
    </div>
    
    
    <div class="inner-right">
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('fundraise/index'); ?>"
               class="btn_question">Start a Fundraiser</a>
        </div>
       <!-- <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('Fundraise/Question'); ?>"
               class="btn_question">Post a Question</a>

        </div>-->
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('Fundraise/Updateprofile', array('id' => Yii::app()->frontUser->id)); ?>"
               class="btn_question">Update Profile</a>
        </div>
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('site/notifications'); ?>"
               class="btn_question">Notifications</a>
        </div>
    </div>
</div>
