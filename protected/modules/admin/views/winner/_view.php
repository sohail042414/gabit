<?php
/* @var $this WinnerController */
/* @var $data RewardWinner */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('month')); ?>:</b>
	<?php echo CHtml::encode($data->month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_points')); ?>:</b>
	<?php echo CHtml::encode($data->total_points); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('win_date')); ?>:</b>
	<?php echo CHtml::encode($data->win_date); ?>
	<br />


</div>