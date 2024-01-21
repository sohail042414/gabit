<?php
/* @var $this ProjectCategoryController */
/* @var $model ProjectCategory */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CoreGxActiveForm', array(
	'id'=>'project-category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="box-body">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="form-group">
				<?php echo $form->labelEx($model,'name'); ?>
				<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
		</div>
	</div>
</div><!-- form -->

<div class="box-footer">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>
<?php $this->endWidget(); ?>