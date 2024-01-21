<?php 
    $form = $this->beginWidget('CoreGxActiveForm', array(
        'id' => 'fundraiser-questions-form',
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
                        <?php echo $form->labelEx($model,'user_id'); ?>
                        <?php echo $form->dropDownList($model, 'user_id', GxHtml::listDataEx(Users::model()->findAllAttributes(null, true))); ?>
                        <?php echo $form->error($model,'user_id'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'topic_id'); ?>
                        <?php echo $form->dropDownList($model, 'topic_id', GxHtml::listDataEx(Topic::model()->findAllAttributes(null, true))); ?>
                        <?php echo $form->error($model,'topic_id'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'questions_text'); ?>
                        <?php echo $form->textArea($model, 'questions_text'); ?>
                        <?php echo $form->error($model,'questions_text'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'subject'); ?>
                        <?php echo $form->textArea($model, 'subject'); ?>
                        <?php echo $form->error($model,'subject'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'notify_status'); ?>
                        <?php echo $form->textField($model, 'notify_status', array('maxlength' => 1)); ?>
                        <?php echo $form->error($model,'notify_status'); ?>
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