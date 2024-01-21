<div class="col-lg-12">
    <section class="panel">
        
		<header class="panel-heading">
			View ProjectCategory <?php echo $model->name; ?>
            <?php
			$this->breadcrumbs=array(
				'Project Categories'=>array('index'),
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
							array('label'=>'List Project Category', 'url'=>array('index')),
							array('label'=>'Create Project Category', 'url'=>array('create')),
							array('label'=>'Update Project Category', 'url'=>array('update', 'id'=>$model->id)),
							array('label'=>'Delete Project Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
							array('label'=>'Manage Project Category', 'url'=>array('admin')),
						)
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
						'name',
					),
				)); ?>
            </div>
        </div>
    </section>
</div>
