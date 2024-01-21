<?php
/* @var $this AffiliatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Affiliates',
);

$this->menu=array(
	array('label'=>'Create Dropdown', 'url'=>array('create')),
	array('label'=>'Manage Dropdowns', 'url'=>array('admin')),
);
?>

<h1>Affiliates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
