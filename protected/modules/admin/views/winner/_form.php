<?php
/* @var $this WinnerController */
/* @var $model RewardWinner */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id'=>'reward-winner-form',
    'enableAjaxValidation' => true,
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-md-6 col-lg-6 col-sm-12">

			<div class="form-group">
				<?php echo $form->labelEx($model,'user_name'); ?>
				<?php echo $form->textField($model,'user_name',array('readonly'=>'true')); ?>
				<?php echo $form->error($model,'user_name'); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model,'year'); ?>
				<?php echo $form->textField($model,'year', array('readonly'=>'true')); ?>
				<?php echo $form->error($model,'year'); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model,'month'); ?>
				<?php echo $form->textField($model,'month', array('readonly'=>'true')); ?>
				<?php echo $form->error($model,'month'); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model,'total_points'); ?>
				<?php echo $form->textField($model,'total_points',array('readonly'=>'true')); ?>
				<?php echo $form->error($model,'total_points'); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model,'win_date'); ?>
				<?php echo $form->textField($model,'win_date',array('readonly'=>'true')); ?>
				<?php echo $form->error($model,'win_date'); ?>
			</div>


			<div class="form-group">
				<?php echo $form->labelEx($model,'location'); ?>
				<?php echo $form->textField($model,'location',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'location'); ?>
			</div>


		</div>

		<div class="col-md-6 col-lg-6 col-sm-12">
			
			<div class="form-group">
				<?php echo $form->labelEx($model,'prize_amount'); ?>
				<?php echo $form->textField($model,'prize_amount'); ?>
				<?php echo $form->error($model,'prize_amount'); ?>
			</div>

			<div class="form-group">
				<p style="color:red;">All images uploaded should be 700 X 500, this will look better on reward page.</p>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model, 'image1_file'); ?>
				<?php echo $form->fileField($model, 'image1_file'); ?>
				<?php echo $form->error($model, 'image1_file', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model, 'image2_file'); ?>
				<?php echo $form->fileField($model, 'image2_file'); ?>
				<?php echo $form->error($model, 'image2_file', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
			</div>


			<div class="form-group">
				<?php echo $form->labelEx($model, 'image3_file'); ?>
				<?php echo $form->fileField($model, 'image3_file'); ?>
				<?php echo $form->error($model, 'image3_file', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
			</div>


			<div class="form-group">
				<?php echo $form->labelEx($model, 'image4_file'); ?>
				<?php echo $form->fileField($model, 'image4_file'); ?>
				<?php echo $form->error($model, 'image4_file', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
			</div>

		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model, 'content', array('id'=>'editor1', 'class' => 'apply-ckeditor')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

</div>

<div class="box-footer">
	<?php echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
</div>

<div class="form-group">
	<h2>Default template for content</h2>
	<br> 
	<p>{WINNER_NAME} was rewarded on the Top Donor Reward Program TDRP on {WIN_DATE} for taking actions {TOTAL_ACTIONS} times on fundraiser pages on Giveyourbit, with a cumulative {TOTAL_POINTS} points; supporting {TOTAL_SUPPORTED} fundraisers. Tap on the photo image to your right to see enlarged photos of {WINNER_NAME}. The reward of {PRIZE_AMOUNT} Naira was recieved by this donor for acts of kindness to people who are faced with challenges; trying to raise funds on the Giveyourbit website. Supporting fundraisers on Giveyourbit offers hope to these people who are victims of circumstance, and it puts a smile on their faces and the faces of members of their families. So, we at Giveyourbit with utmost gratitude certifies {WINNER_NAME} as a {STAR_DONOR}, for kindness to people on Giveyourbit.</p>
</div>

<?php
$this->endWidget();
?>

<!--script for advance taxt editor-->
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script type="text/javascript">
//CKEDITOR.replace( 'editor1' );
</script>