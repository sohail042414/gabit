<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View Group'); ?>
            </h1>
            <?php
            $this->breadcrumbs = array(
                'Groups' => array('admin'),
                $group->name,
            );

            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));

            ?>
        </header>

        <div class="panel-body">
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => Yii::t('app', 'Manage Groups'), 'url' => array('admin'))
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <?php echo UtilityHtml::get_flash_message(); ?>
                <?php $this->widget('CoreCDetailView', array(
                    'data' => $group,
                    'attributes' => array(
                        'name' => array(
							'label' => 'Group Name',
							'value' => $group->name
						)
					),
                )); ?>

<?php
		$form = $this->beginWidget('CActiveForm', array(
			'enableAjaxValidation' => true,
		));

		echo CHtml::ajaxSubmitButton('Save', array('savepermission'), array('success' => 'reloadGrid'), array('class' => 'btn btn-primary pull-right','style'=>'margin-bottom:5px;'));

		$this->widget('CoreCGridView', array(
				'id' => 'permission-grid',
				'dataProvider' => $dataProvider,
				'columns' => array(
						array(
							'name' => 'id',
							'value' => '$data["name"]',
							'header' =>'Resource',
						),
						array(
							'name' => 'View',
							'value' => 'CHtml::checkBox("data[".$data["resource_id"]."][can_view]",$data["can_view"],array("value"=>"1","uncheckValue"=>"0","id"=>"cid_".$data["resource_id"]))',
							'type' => 'raw',
						),
						
						array(
							'name' => 'Add',
							'value' => 'CHtml::checkBox("data[".$data["resource_id"]."][can_add]",$data["can_add"],array("value"=>"1","uncheckValue"=>"0","id"=>"cid_".$data["resource_id"]))',
							'type' => 'raw',
						),
						
						array(
							'name' => 'Update',
							'value' => 'CHtml::checkBox("data[".$data["resource_id"]."][can_update]",$data["can_update"],array("value"=>"1","uncheckValue"=>"0","id"=>"cid_".$data["resource_id"]))',
							'type' => 'raw',
						),
						array(
							'name' => 'Delete',
							'value' => 'CHtml::checkBox("data[".$data["resource_id"]."][can_delete]",$data["can_delete"],array("value"=>"1","uncheckValue"=>"0","id"=>"cid_".$data["resource_id"]))',
							'type' => 'raw',
						),						
				),
			));

			echo CHtml::ajaxSubmitButton('Save', array('savepermission'), array('success' => 'reloadGrid'), array('class' => 'btn btn-primary pull-right'));
			$this->endWidget();
		?>
            </div>
        </div>
    </section>
</div>