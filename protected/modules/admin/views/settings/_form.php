<?php 
    $form = $this->beginWidget('CoreGxActiveForm', array(
        'id' => 'settings-form',
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
                                        <div class="form-group">
                        <?php echo $form->labelEx($model,'site_name'); ?>
                        <?php echo $form->textField($model, 'site_name', array('maxlength' => 250)); ?>
                        <?php echo $form->error($model,'site_name'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'address'); ?>
                        <?php echo $form->textArea($model, 'address', array('maxlength' => 250)); ?>
                        <?php echo $form->error($model,'address'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email_id'); ?>
                        <?php echo $form->textField($model, 'email_id', array('maxlength' => 250)); ?>
                        <?php echo $form->error($model,'email_id'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'phone_no'); ?>
                        <?php echo $form->textField($model, 'phone_no'); ?>
                        <?php echo $form->error($model,'phone_no'); ?>
                    </div>
                
                        </div>
    <div class="box-footer">
        <?php
    echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary'));
    ?>
    </div>

<?php
$this->endWidget();
?>