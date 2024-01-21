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
		<div class="col-md-4 col-lg-6">
			<div class="form-group">
				<?php echo $form->labelEx($model,'name'); ?>
				<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'status'); ?>
				<?php echo $form->dropDownList($model,'status',array('1'=>'Active','0' => 'Disabled')); ?>
				<?php echo $form->error($model,'status'); ?>
			</div>
		</div>
		<div class="col-md-4 col-lg-6">
			<div class="form-group">
				<?php echo $form->labelEx($model, 'logo_file'); ?>
				<?php echo $form->fileField($model, 'logo_file'); ?>
				<?php echo $form->error($model, 'logo_file', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model, 'bg_image_file'); ?>
				<?php echo $form->fileField($model, 'bg_image_file'); ?>
				<?php echo $form->error($model, 'bg_image_file', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
			</div>
		</div>	
		<?php /* ?>
		<div class="col-md-4 col-lg-4">
			<div class="form-group">
					<?php echo $form->labelEx($model,'email'); ?>
					<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
					<?php echo $form->error($model,'email'); ?>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'account_no'); ?>
				<?php echo $form->textField($model,'account_no',array('size'=>60,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'account_no'); ?>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'phone'); ?>
				<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
				<?php echo $form->error($model,'phone'); ?>
			</div>
		</div>
		<?php */ ?>
	</div>
	<div class="row">
		<div class="col-md-3 col-lg-3">			
			<div class="form-group">
				<?php echo $form->label($model, 'is_champion'); ?>
				<?php echo $form->checkBox($model,'is_champion',array('style'=>'margin-left:30px;')); ?>
				<?php echo $form->error($model, 'is_champion'); ?>   
			</div>
		</div>
		<div class="col-md-3 col-lg-3">
			<div class="form-group">
				<?php echo $form->label($model, 'is_fundmanager'); ?>
				<?php echo $form->checkBox($model,'is_fundmanager',array('style'=>'margin-left:30px;')); ?>
				<?php echo $form->error($model, 'is_fundmanager'); ?>   
			</div>
		</div>
		<?php /* ?>
		<div class="col-md-3 col-lg-3">
			<div class="form-group">
				<?php echo $form->label($model, 'is_supporter'); ?>
				<?php echo $form->checkBox($model,'is_supporter',array('style'=>'margin-left:30px;')); ?>
				<?php echo $form->error($model, 'is_supporter'); ?>   
			</div>
		</div>
		<div class="col-md-3 col-lg-3">
			<div class="form-group">
				<?php echo $form->label($model, 'is_sponsor'); ?>
				<?php echo $form->checkBox($model,'is_sponsor',array('style'=>'margin-left:30px;')); ?>
				<?php echo $form->error($model, 'is_sponsor'); ?>   
			</div>
		</div>
		<?php */ ?>
	</div>
</div>
<div class="box-footer">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>
