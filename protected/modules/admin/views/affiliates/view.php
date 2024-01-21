<div class="col-lg-12">
    <section class="panel">
        
		<header class="panel-heading">
			View Dropdown  
            <?php
			$this->breadcrumbs=array(
				'Manage Dropdowns'=>array('index'),
				$model->name,
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
							array('label'=>'Create Dropdown', 'url'=>array('create')),
							array('label'=>'Update Dropdown', 'url'=>array('update', 'id'=>$model->id)),
							array('label'=>'Delete Dropdown', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
							array('label'=>'Manage Dropdowns', 'url'=>array('admin')),
                        ),
                    )); ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <?php echo UtilityHtml::get_flash_message(); ?>
				<?php $this->widget('CoreCDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'id',
						'name',
						//'type',
						'logo' => array(
							'label' => 'Logo',
							'type' => 'raw',
                            'value' => $model->getLogoUrl(),
						),
						'bg_image' => array(
							'label' => 'Background Image',
							'type' => 'raw',
							'value' => $model->getBgImageUrl()
						),
						/*
						'email',
						'phone',
						'account_no',
						*/
						'status' => array(
							'label' => 'Status',
							'type' => 'raw',
							'value' => $model->getStatusText(),
						),
						'is_champion' => array(
                            'label' => 'Is Champion',
							'type' => 'raw',
                            'value' => $model->getChampionText(),
                        ),
                        'is_fundmanager' => array(
                            'label' => 'Is Fund Manager',
							'type' => 'raw',
                            'value' => $model->getFundManagerText()
                        ),
						/*
                        'is_supporter' => array(
                            'label' => 'Is Supporter',
							'type' => 'raw',
                            'value' => $model->getSupporterText()
                        ),						
                        'is_sponsor' => array(
                            'label' => 'Fund Manager',
							'type' => 'raw',
                            'value' => $model->getSponsorText()
                        ),
						*/
					),
				)); ?>
            </div>
        </div>
    </section>
</div>
