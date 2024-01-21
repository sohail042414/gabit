<style type="text/css">
    .form-group{width: 100%; float: left; margin: 5px 0px; font-family:Arial, Helvetica, sans-serif; font-size: 14px; color: #666;}
    .form-group label{width: 100px; float: left; line-break: 35px;}
    .form-group input[type=text]{width: 220px; height: 35px; padding: 5px; box-sizing: border-box;}
    .form-group textarea{width: 220px; height: 90px; padding: 5px; box-sizing: border-box;}
    span.required{color: red;}
    .errorMessage{padding-left: 100px; width: 100%; float: left; box-sizing: border-box; color: red;}
    input[type=submit]{background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0;
    border: medium none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    line-height: 35px;
    margin-left: 100px;
    margin-top: 5px;
    padding: 0 20px;
    text-align: center;
    width: auto;}
    
    input[type=submit]:hover{background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0;}
    .alert-success{width: 100%; float: left; text-align: center; color: green; font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; padding-bottom: 15px}
</style>

<?php
                    $form = $this->beginWidget('CoreGxActiveForm', array(
                        'id' => 'sendsupportcenter-message-form',
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
             <div class="panel-body">    
                
                 <div class="clear"></div>
             
              <?php //echo UtilityHtml::get_flash_message(); ?>
                
            
                <div class="box-body">   
                    
                        <div class="form-group">
                            <?php echo $form->labelEx($send_notification_form,'name'); ?>
                            <?php echo $form->textField($send_notification_form, 'name'); ?>
                            <?php echo $form->error($send_notification_form,'name'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($send_notification_form,'email'); ?>
                            <?php echo $form->textField($send_notification_form, 'email'); ?>
                            <?php echo $form->error($send_notification_form,'email'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($send_notification_form,'subject'); ?>
                            <?php echo $form->textField($send_notification_form, 'subject', array('empty' => 'Please Select Subject')); ?>
                            <?php echo $form->error($send_notification_form,'subject'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($send_notification_form,'message'); ?>
                            <?php echo $form->textArea($send_notification_form, 'message'); ?>
                            <?php echo $form->error($send_notification_form,'message'); ?>
                        </div>

                        <div class="box-footer">
                            <?php echo GxHtml::submitButton(Yii::t('app', 'Send'), array('class' => 'btn_send_ans')); ?>
                        </div>
                    <?php
                        $this->endWidget();
                    ?> 
                </div>
                
</div>     
