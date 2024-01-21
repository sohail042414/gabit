<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
		Update Project Category
            <?php
			$this->breadcrumbs=array(
				'Project Categories'=>array('admin'),
				$model->name=>array('view','id'=>$model->id),
				'Update',
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
                        array('label'=>'Manage Project Category', 'url'=>array('admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
    </section>
</div>

