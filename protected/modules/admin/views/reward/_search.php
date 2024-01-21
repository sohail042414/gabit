<?php
/* @var $this RewardController */
/* @var $model RewardPoints */
/* @var $form CActiveForm */
?>

<div class="wide form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>

		<div class="row">
			<?php echo $form->label($model,'year'); ?>
			<?php echo $form->dropDownList($model,'year',$yearsList); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Search'); ?>
		</div>

	<?php $this->endWidget(); ?>
</div><!-- search-form -->