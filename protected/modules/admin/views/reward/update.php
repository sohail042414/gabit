<?php
/* @var $this RewardController */
/* @var $model RewardPoints */

$this->breadcrumbs=array(
	'Reward Points'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RewardPoints', 'url'=>array('index')),
	array('label'=>'Create RewardPoints', 'url'=>array('create')),
	array('label'=>'View RewardPoints', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RewardPoints', 'url'=>array('admin')),
);
?>

<h1>Update RewardPoints <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>