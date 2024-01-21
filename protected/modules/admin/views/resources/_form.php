<?php
/* @var $this ResourcesController */
/* @var $model Resources */
/* @var $form CActiveForm */

$form = $this->beginWidget('CoreGxActiveForm', array(
	'id'=>'resources-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ),
));
?>

<div class="box-body">

	<?php if($model->isNewRecord){ ?>
		<div class="form-group">
			<?php echo $form->labelEx($model,'resource_id'); ?>
			<?php echo $form->textField($model,'resource_id'); ?>
			<?php echo $form->error($model,'resource_id'); ?>
		</div>
	<?php } ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
</div><!-- form -->

<div class="box-footer">
	<?php echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>