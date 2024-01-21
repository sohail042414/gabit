
<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
			Manage Popups

            <?php 
			$this->breadcrumbs=array(
				'Manage Popups'=>array('index'),
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
                            'label' => 'New Popup', 
                            'url' => array('banners/create'),
                            'visible' => $this->auth->canAdd($this->resource_id)
                        ),                        
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
                <?php
				$this->widget('CoreCGridView', array(
					'id'=>'banners-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
                        'title',
                        'url',
						'image' => array(
							'header' => 'Image',
							'type' => 'raw',
                            'value' => '$data->getImageUrl(50)',
						),
                        'mobile_image' => array(
							'header' => 'Mobile Image',
							'type' => 'raw',
                            'value' => '$data->getMobileImageUrl(50)',
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
				)); 
			?>
            </div>        
        </div>
    </section>
</div>