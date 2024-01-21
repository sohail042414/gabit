<?php
/* @var $this EmailTemplatesController */
/* @var $model EmailTemplates */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CoreGxActiveForm', array(
	'id'=>'email-templates-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="box-body">        
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<p></p>

	<?php if($model->isNewRecord){ ?>
		<div class="form-group">
			<?php echo $form->labelEx($model,'short_code'); ?>
			<span class="note">User Letters and underscores only, like "NEW_USER_EMAIL"</span>
			<?php echo $form->textField($model,'short_code',array('size'=>60,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'short_code'); ?>
		</div>
	<?php }else{ ?>
		<div class="form-group">
			<?php echo $form->labelEx($model,'short_code'); ?>
			<span class="note">User Letters and underscores only, like "NEW_USER_EMAIL"</span>
			<?php echo $form->textField($model,'short_code',array('size'=>60,'maxlength'=>250,'disabled'=>'disabled')); ?>
			<?php echo $form->error($model,'short_code'); ?>
		</div>
	<?php } ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'template'); ?>
		<?php echo $form->textArea($model,'template',array('id'=>'editor1', 'class' => 'apply-ckeditor')); ?>
		<?php echo $form->error($model,'template'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'text_email'); ?>
		<?php echo $form->textArea($model,'text_email',array('rows' => 10)); ?>
		<?php echo $form->error($model,'text_email'); ?>
	</div>

	<?php /* ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	<?php */ ?>
</div>
<div class="box-footer">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>

<?php $this->endWidget(); ?>

<!--script for advance taxt editor-->
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>