<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage Groups');  ?>
            <?php
            $this->breadcrumbs = array(
                'Groups' => array('admin'),
                Yii::t('app', 'Manage'),
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
                        array(
                            'label' => Yii::t('app', 'Create Group'), 
                            'url' => array('create'),
                            'visible' => $this->auth->canUpdate($this->resource_id)
                        ),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-responsive">
			<?php $this->widget('CoreCGridView', array(
				'id'=>'groups-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'columns'=>array(
					'id',
					'name',
					array(
						'class'=>'CButtonColumn',
					),
				),
			)); ?>
            </div>
        </div>
    </section>
</div>]