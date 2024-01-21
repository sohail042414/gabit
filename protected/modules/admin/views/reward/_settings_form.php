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
		<div class="col-md-6 col-lg-6">
			<?php /* ?>
			<div class="form-group">
				<?php echo CHtml::label('Reward Date','reward_date'); ?>
				<?php echo Chtml::textField('reward_date',$reward_date,array('class'=>'form-control','size'=>100,'maxlength'=>100)); ?>
			</div>
			<?php */ ?>

			<div class="form-group">
				<?php echo CHtml::label('Prize Amount','reward_prize'); ?>
				<?php echo Chtml::textField('reward_prize',$reward_prize,array('class'=>'form-control','size'=>100,'maxlength'=>100)); ?>
			</div>

		</div>
	</div>
</div>
<div class="box-footer">
	<?php echo CHtml::submitButton('Update',array('class' => 'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>
