<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
			Manage Project Categories

            <?php 
			$this->breadcrumbs=array(
				'Project Categories'=>array('index'),
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
						array('label'=>'Create Project Category', 'url'=>array('create')),
                    ),
                ));
                ?>
				<a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("affiliates/admin"); ?>">Manage Dropdowns</a>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
			<?php $this->widget('CoreCGridView', array(
				'id'=>'project-category-grid',
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
</div>