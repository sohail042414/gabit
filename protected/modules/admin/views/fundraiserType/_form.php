<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'fundraiser-type-form',
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
            <?php echo $form->labelEx($model, 'fundraiser_type'); ?>
            <?php echo $form->textField($model, 'fundraiser_type', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fundraiser_type'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'type_description'); ?>
            <?php echo $form->textArea($model, 'type_description'); ?>
            <?php echo $form->error($model, 'type_description'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'image'); ?>
            <?php echo $form->fileField($model, 'image', array('maxlength' => 250)); ?>
            <?php echo $form->error($model, 'image'); ?>
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