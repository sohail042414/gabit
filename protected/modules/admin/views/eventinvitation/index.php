<?php
/* @var $this EventinvitationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Event Invitations',
);

$this->menu=array(
	array('label'=>'Create EventInvitation', 'url'=>array('create')),
	array('label'=>'Manage EventInvitation', 'url'=>array('admin')),
);
?>

<h1>Event Invitations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
