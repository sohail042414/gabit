<?php
/* @var $this NewsUpdatesController */
/* @var $model NewsUpdates */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CoreGxActiveForm', array(
	'id' => 'news-updates-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
)); 

?>

<div class="box-body">

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'title'); ?>
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
		<?php echo $form->labelEx($model, 'content'); ?>
		<?php echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50,'class'=>'apply-ckeditor')); ?>
		<?php echo $form->error($model, 'content'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'video_link'); ?>
		<?php echo $form->textField($model, 'video_link', array('size' => 60, 'maxlength' => 255)); ?>
		<p>Must be valid URL, like Youtuble video link.</p>
		<?php echo $form->error($model, 'video_link'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status',array('1'=>'Active','0'=>'In-Active')); ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>

</div>

<div class="box-footer">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>


<?php $this->endWidget(); ?>
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>