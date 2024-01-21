<?php

$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'to_send_messaging-form',
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
<div class="box-body">

    <div class="form-group sort_dropdown">
        <?php  echo $form->labelEx($notification, 'Select Fundraiser');  ?>
        <?php  
        echo $form->dropDownList($notification,'fundraiser_id',CHtml::listData($fundraisers_list,'id','fundraiser_title'), array(
            'prompt' => '– Please Select –',
        ));
    ?>
    <?php echo $form->error($notification, 'fundraiser_id'); ?>
    </div>  
    <div class="form-group sort_dropdown">
        <?php echo $form->labelEx($notification, 'Receiver Type');  ?>
        <?php echo $form->dropDownList($notification, 'receiver_type', $notification->getReceiverTypes(),
            array(
                'empty'=>'– Please Select –',
                'ajax' => array(
                    'type'=>'GET',
                    //By default all form fields will be passed in GET
                    //'data'=>array('receiver_type'=>'js: $(this).val()'), 
                    'url'=>Yii::app()->createUrl('Fundraiser/getreceivers'),
                    'update'=>'#'.Chtml::activeId($notification,'receiver_name') ,
                ))
            ); 
        ?>
        <?php echo $form->error($notification, 'receiver_type'); ?>
        
    </div>  
    <div class="form-group sort_dropdown">
        <?php echo $form->labelEx($notification, 'Select Receiver');  ?>
        <?php echo $form->dropDownList($notification,'receiver_name',array(), array('prompt' => '– Please Select –')); ?>
        <?php echo $form->error($notification, 'receiver_name'); ?>
    </div> 
    
    <div class="form-group">
        <?php echo $form->labelEx($notification, 'Subject');  ?>
        <?php echo $form->textField($notification, 'subject', array('maxlength' => 255)); ?>
        <?php echo $form->error($notification, 'subject'); ?>
    </div>
    <div class="form-group">
        <?php   echo $form->labelEx($notification, 'Message');  ?>
        <?php echo $form->textArea($notification, 'message', array()); ?>
        <?php echo $form->error($notification, 'message'); ?>
    </div>
</div>
<div class="box-footer">
    <?php
        echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans', 'id' => 'sub_id_qq'));
    ?>
</div>

<?php
$this->endWidget();
?>