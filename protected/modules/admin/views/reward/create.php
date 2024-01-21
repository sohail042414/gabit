<?php
/* @var $this RewardController */
/* @var $model RewardPoints */

$this->breadcrumbs=array(
	'Reward Points'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RewardPoints', 'url'=>array('index')),
	array('label'=>'Manage RewardPoints', 'url'=>array('admin')),
);
?>

<h1>Create RewardPoints</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>