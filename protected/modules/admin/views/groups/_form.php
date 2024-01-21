<?php
/* @var $this GroupsController */
/* @var $model Groups */
/* @var $form CActiveForm */

$form = $this->beginWidget('CoreGxActiveForm', array(
    'id'=>'groups-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ),
));
?>
<div class="box-body">
    <div class="form-group">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
</div>

<div class="box-footer">
	<?php echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

