<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
			Update Popup Item <?php echo $model->title; ?>
            <?php
			$this->breadcrumbs=array(
				'Manage Popups'=>array('index'),
				$model->title=>array('view','id'=>$model->id),
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
						array('label'=>'Create Popup', 'url'=>array('create')),
						array('label'=>'View Popup', 'url'=>array('view', 'id'=>$model->id)),
						array('label'=>'Manage Popups', 'url'=>array('admin')),
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

