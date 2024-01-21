<section class="content-header">
    <h1>
        <?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label(1)) ?>
    </h1>
    <?php
        $this->breadcrumbs = array(
            $model->label(2) => array('admin'),
            GxHtml::valueEx($model),
        );

        $this->widget('CoreCBreadcrumbs', array(
            'links' => $this->breadcrumbs,
            'htmlOptions' => array('class' => 'breadcrumb')
        )); 

        ?> 
</section>

<section class="content">
    <div class="col-xs-12">
        <?php echo UtilityHtml::get_flash_message(); ?>        <div class="box">
            <div class="box-header">
                <?php
				$this->widget('CoreButtonCMenu', array(
					'encodeLabel' => false,
					'items' => array(
						array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
						array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->site_name)),
						array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->site_name), 'confirm'=>'Are you sure you want to delete this item?')),
						array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin'))
					),
				));
				?>
            </div>
            <div class="box-body table-responsive">
                <?php $this->widget('CoreCDetailView', array(
                'data' => $model,
                'attributes' => array(
                'site_name',
'address',
'email_id',
'phone_no',
                ),
                )); ?>
            </div>
        </div>
    </div>
</section>