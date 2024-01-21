<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage Fundraiser Types') ?>
            <?php
			$this->breadcrumbs=array(
				'Fundraiser Types'=>array('index'),
				'Manage',
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
                            'label' => Yii::t('app', 'Create') . ' Fundraiser Types', 
                            'url' => array('create'),
                            'visible' => $this->auth->canAdd($this->resource_id)
                        ),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-responsive">
 
				<?php $this->widget('CoreCGridView', array(
					'id'=>'fundraiser-sub-type-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
						'id',
						'p_id' => array(
							'header' => 'Category',
							'type'=>'raw',
							'value' => '$data->type->fundraiser_type'
						),
						'fundraiser_subtyp' => array(
							'header' => 'Type',
							'type'=>'raw',
							'value' => '$data->fundraiser_subtyp'
						),
                        array(
                            'class' => 'CoreCButtonColumn',
                            'header' => 'Functions',
                            'template' => '{view}{update}{delete}',
                            'buttons' => array(
                                'view' => array(
                                    'visible' => ($this->auth->canView($this->resource_id)) ? '1' : '0;'
                                ),
                                'update' => array(
                                    'visible' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0;'
                                ),
                                'delete' => array(
                                    'visible' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0;'
                                ),
                            ),
                        ),
					),
				)); ?>

            </div>
        </div>
    </section>
</div>
