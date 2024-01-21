<?php
/* @var $this SubtypeControllerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fundraiser Sub Types',
);

$this->menu=array(
	array('label'=>'Create FundraiserSubType', 'url'=>array('create')),
	array('label'=>'Manage FundraiserSubType', 'url'=>array('admin')),
);
?>

<h1>Fundraiser Sub Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
