<?php
/* @var $this WinnerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reward Winners',
);

$this->menu=array(
	array('label'=>'Create RewardWinner', 'url'=>array('create')),
	array('label'=>'Manage RewardWinner', 'url'=>array('admin')),
);
?>

<h1>Reward Winners</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
