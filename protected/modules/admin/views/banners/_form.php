<?php
/* @var $this AffiliatesController */
/* @var $model Affiliates */
/* @var $form CActiveForm */
?>

<style>
	.col-md-3{
		width: 25% !important;
	}
</style>

<?php $form=$this->beginWidget('CoreGxActiveForm', array(
	'id'=>'affiliates-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ),
)); ?>

<div class="box-body">	
	<?php //echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="col-md-6 col-lg-5">
			<div class="form-group">
				<?php echo $form->labelEx($model,'title'); ?>
				<?php echo $form->textField($model,'title',array('size'=>100,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'title'); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model,'url'); ?>
				<?php echo $form->textField($model,'url',array('size'=>255,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'url'); ?>
			</div>
		</div>
		
		<div class="col-md-4 col-lg-7">
			<div class="form-group">
				<?php echo $form->labelEx($model, 'image_file'); ?>
				<?php echo $form->fileField($model, 'image_file'); ?>
				<p>Image with dimentions (900 X 650 ) (Width X Height) fits perfect in popup.</p>
				<?php echo $form->error($model, 'image_file', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model, 'mobile_image_file'); ?>
				<?php echo $form->fileField($model, 'mobile_image_file'); ?>
				<p>Image with dimentions (650 X 900 ) (Width X Height) fits perfect in popup on mobile screen.</p>
				<?php echo $form->error($model, 'mobile_image_file', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
			</div>
		</div>	
	</div>
</div>
<div class="box-footer">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>
