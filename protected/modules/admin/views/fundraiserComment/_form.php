<?php 
    $form = $this->beginWidget('CoreGxActiveForm', array(
        'id' => 'fundraiser-comment-form',
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
                        <?php echo $form->labelEx($model,'fundraiser_reference_id'); ?>
                        <?php echo $form->dropDownList($model, 'fundraiser_reference_id', GxHtml::listDataEx(SetupFundraiser::model()->findAllAttributes(null, true))); ?>
                        <?php echo $form->error($model,'fundraiser_reference_id'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'name'); ?>
                        <?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model, 'email', array('maxlength' => 255)); ?>
                        <?php echo $form->error($model,'email'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'comment'); ?>
                        <?php echo $form->textArea($model, 'comment'); ?>
                        <?php echo $form->error($model,'comment'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'comment_status'); ?>
                        <?php echo $form->textField($model, 'comment_status', array('maxlength' => 1)); ?>
                        <?php echo $form->error($model,'comment_status'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'approval_date'); ?>
                        <?php echo $form->textField($model, 'approval_date'); ?>
                        <?php echo $form->error($model,'approval_date'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'created_date'); ?>
                        <?php echo $form->textField($model, 'created_date'); ?>
                        <?php echo $form->error($model,'created_date'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'updated_date'); ?>
                        <?php echo $form->textField($model, 'updated_date', array('maxlength' => 45)); ?>
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