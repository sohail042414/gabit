<?php
/* @var $this CorporateSupportersController */
/* @var $model CorporateSupporter */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CoreGxActiveForm', array(
	'id'=>'corporate-supporter-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
)); ?>

<div class="box-body">

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'image_file'); ?>
        <?php echo $form->fileField($model, 'image_file', array('maxlength' => 250, 'class' => 'upload_file'));
        // if (!empty($case_update->image)) {
        //     echo '<br><br><img class="preview_image" style="width:200px;height:auto;margin-left:180px;" src="' . SITE_ABS_PATH_IMAGE_THUMB . $case_update->image . '" alt="" />';
        // }
        ?>
        <?php echo $form->error($model, 'image_file'); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'website_url'); ?>
		<?php echo $form->textField($model,'website_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'website_url'); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array('1' => 'Active', '0' => 'In Active'),array('class' => 'form-control')); ?>
		<?php //echo $form->dropDownList($model, 'status', GxHtml::listDataEx(FundraiserType::model()->findAllAttributes(null, true)),array("disabled"=>"disabled")); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
</div>

<div class="box-footer">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>

<?php $this->endWidget(); ?>

