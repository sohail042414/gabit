<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View Fundraiser Types') ?>
            <?php
			$this->breadcrumbs=array(
				'Fundraiser Types'=>array('index'),
				$model->id,
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
                        array('label' => Yii::t('app', 'Create') . ' Fundraiser Types ', 'url' => array('create')),
                        array('label' => Yii::t('app', 'Update') . ' Fundraiser Types ', 'url' => array('update', 'id' => $model->id)),
                        array('label' => Yii::t('app', 'Delete') . ' Fundraiser Types ', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
                        array('label' => Yii::t('app', 'Manage') . ' Fundraiser Types ', 'url' => array('admin'))
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <?php echo UtilityHtml::get_flash_message(); ?>
				<?php $this->widget('CoreCDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'id',
						'p_id' => array(
							'label' => 'Category',
							'type'=>'raw',
							'value' => $model->type->fundraiser_type,
						),
						'fundraiser_subtyp',
						'type_description',
						'created_date',
						'updated_date',
						'status',
					),
				)); ?>
            </div>
        </div>
    </section>
</div>
