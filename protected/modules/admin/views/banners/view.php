<div class="col-lg-12">
    <section class="panel">
        
		<header class="panel-heading">
			View Popup  
            <?php
			$this->breadcrumbs=array(
				'Manage Popups'=>array('index'),
				$model->title,
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
							array('label'=>'Create Popup', 'url'=>array('create')),
							array('label'=>'Update Popup', 'url'=>array('update', 'id'=>$model->id)),
							array('label'=>'Delete Popup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
							array('label'=>'Manage Popups', 'url'=>array('admin')),
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
						'title',
						'url',
						'image' => array(
							'label' => 'Popup Image',
							'type' => 'raw',
                            'value' => $model->getImageUrl(),
						),
						'bg_image' => array(
							'label' => 'Mobile Popup Image',
							'type' => 'raw',
							'value' => $model->getMobileImageUrl()
						),
					),
				)); ?>
            </div>
        </div>
    </section>
</div>
