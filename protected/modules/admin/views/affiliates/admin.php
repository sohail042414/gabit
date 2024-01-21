
<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
			Manage Dropdowns

            <?php 
			$this->breadcrumbs=array(
				'Manage Dropdowns'=>array('index'),
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
                            'label' => 'Manage Project Categories', 
                            'url' => array('ProjectCategory/admin'),
                            'visible' => $this->auth->canAdd($this->resource_id),
                        ),  
                        array(
                            'label' => 'New Dropdown Entry', 
                            'url' => array('affiliates/create'),
                            'visible' => $this->auth->canAdd($this->resource_id),
                        ),                      
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
                <?php
				$this->widget('CoreCGridView', array(
					'id'=>'affiliates-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
						'logo' => array(
							'header' => 'Logo',
							'type' => 'raw',
                            'value' => '$data->getLogoUrl(50)',
						),
						'name', 
                        'status' => array(
                            'header' => 'Status',
                            'value' => '$data->getStatusText();'
                        ),
                        'is_champion' => array(
                            'header' => 'Champion',
                            'value' => '$data->getChampionText();'
                        ),
                        'is_fundmanager' => array(
                            'header' => 'Fund Manager',
                            'value' => '$data->getFundManagerText();'
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