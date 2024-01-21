<?php 
    $form = $this->beginWidget('CoreGxActiveForm', array(
        'id' => 'report-fundraiser-form',
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
                        <?php echo $form->labelEx($model,'fundraiser_id'); ?>
                        <?php echo $form->textField($model, 'fundraiser_id'); ?>
                        <?php echo $form->error($model,'fundraiser_id'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'user_name'); ?>
                        <?php echo $form->textField($model, 'user_name', array('maxlength' => 250)); ?>
                        <?php echo $form->error($model,'user_name'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model, 'email', array('maxlength' => 250)); ?>
                        <?php echo $form->error($model,'email'); ?>
                    </div>
                
                                                    <div class="form-group">
                        <?php echo $form->labelEx($model,'description'); ?>
                        <?php echo $form->textField($model, 'description', array('maxlength' => 250)); ?>
                        <?php echo $form->error($model,'description'); ?>
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