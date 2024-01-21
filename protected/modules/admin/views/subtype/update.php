<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
        <?php echo Yii::t('app', 'Update Fundraiser Type') ?>
    	<?php
		$this->breadcrumbs=array(
			'Fundraiser Types'=>array('index'),
			$model->id=>array('view','id'=>$model->id),
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
                        array('label'=>Yii::t('app', 'Manage Fundraiser Types'), 'url' => array('admin')),
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
