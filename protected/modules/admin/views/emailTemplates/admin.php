<?php
/* @var $this EmailTemplatesController */
/* @var $model EmailTemplates */
?>
<div class="col-sm-12">
    <section class="panel">

	<header class="panel-heading">
		<?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)) ?>
		<?php
		$this->breadcrumbs=array(
			'Email Templates'=>array('index'),
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
							'label' => Yii::t('app', 'Create') . ' ' . $model->label(), 
							'url' => array('create'),
							'visible' => $this->auth->canAdd($this->resource_id),
						),
                    ),
                ));
                ?>
            </div>
			<div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
				<?php $this->widget('CoreCGridView', array(
					'id'=>'email-templates-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
						'id',
						'short_code',
						'subject',
                        array(
                            'class' => 'CoreCButtonColumn',
                            'header' => 'Functions',
                            'template' => '{view}{update}',
                            'buttons' => array(
                                'view' => array(
                                    'visible' => ($this->auth->canView($this->resource_id)) ? '1' : '0;'
                                ),
                                'update' => array(
                                    'visible' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0;'
                                )
                            ),
                        ),
					),
				)); ?>
			</div>
        </div>
    </section>
</div>