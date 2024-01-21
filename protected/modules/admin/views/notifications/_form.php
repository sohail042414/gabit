<?php 
    $form = $this->beginWidget('CoreGxActiveForm', array(
        'id' => 'notifications-form',
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
                        <?php echo $form->labelEx($model,'name'); ?>
                        <?php echo $form->textField($model, 'name', array('maxlength' => 250)); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model, 'email', array('maxlength' => 250)); ?>
                        <?php echo $form->error($model,'email'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'message'); ?>
                        <?php echo $form->textArea($model, 'message'); ?>
                        <?php echo $form->error($model,'message'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'from_id'); ?>
                        <?php echo $form->textField($model, 'from_id'); ?>
                        <?php echo $form->error($model,'from_id'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'from_admin'); ?>
                        <?php echo $form->textField($model, 'from_admin', array('maxlength' => 1)); ?>
                        <?php echo $form->error($model,'from_admin'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'to_id'); ?>
                        <?php echo $form->textField($model, 'to_id'); ?>
                        <?php echo $form->error($model,'to_id'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'to_admin'); ?>
                        <?php echo $form->textField($model, 'to_admin', array('maxlength' => 1)); ?>
                        <?php echo $form->error($model,'to_admin'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'is_read'); ?>
                        <?php echo $form->textField($model, 'is_read', array('maxlength' => 1)); ?>
                        <?php echo $form->error($model,'is_read'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'created_date'); ?>
                        <?php echo $form->textField($model, 'created_date'); ?>
                        <?php echo $form->error($model,'created_date'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'updated_date'); ?>
                        <?php echo $form->textField($model, 'updated_date'); ?>
                        <?php echo $form->error($model,'updated_date'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'status'); ?>
                        <?php echo $form->dropDownList($model, 'status', array('Y' => Yii::t('app', 'Active'), 'N' => Yii::t('app', 'Inactive'))); ?>
                        <?php echo $form->error($model,'status'); ?>
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