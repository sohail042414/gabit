<?php
/* @var $this WinnerController */
/* @var $model RewardWinner */

$this->breadcrumbs=array(
	'Reward Winners'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RewardWinner', 'url'=>array('index')),
	array('label'=>'Manage RewardWinner', 'url'=>array('admin')),
);
?>

<h1>Create RewardWinner</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>