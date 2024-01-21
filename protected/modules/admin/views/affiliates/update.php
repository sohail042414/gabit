<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
			Update Dropdown Item <?php echo $model->name; ?>
            <?php
			$this->breadcrumbs=array(
				'Manage Dropdowns'=>array('index'),
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
						array('label'=>'Create Dropdown', 'url'=>array('create')),
						array('label'=>'View Dropdown', 'url'=>array('view', 'id'=>$model->id)),
						array('label'=>'Manage Dropdowns', 'url'=>array('admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>

            <?php
            $this->renderPartial('_form', array(
                'model' => $model,
                'buttons' => 'create'));
            ?>
        </div>
    </section>
</div>

