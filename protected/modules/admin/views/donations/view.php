<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label(1)) ?>
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
        </header>
        
        <div class="panel-body">
            <div class="box-header">
                <?php
                    $this->widget('CoreButtonCMenu', array(
                        'encodeLabel' => false,
                        'items' => array(
                                array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
                                array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
                                array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
                                array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin'))
                        ),
                    )); ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <?php echo UtilityHtml::get_flash_message(); ?>
                <?php $this->widget('CoreCDetailView', array(
                'data' => $model,
                'attributes' => array(
                'id',
                    array(
			'name' => 'fundraiser',
			'type' => 'raw',
			'value' => $model->fundraiser !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->fundraiser)), array('setupFundraiser/view', 'id' => GxActiveRecord::extractPkValue($model->fundraiser, true))) : null,),
                'donation_amount',
                'donor_name',
                'donor_email',
                'donor_phone_no',
//                'donor_message',
//                'user_id',
                'created_date',
//                'updated_date',
                    array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => UtilityHtml::getStatusImage($model->status,'view'),),                
                    ),
                )); ?>
            </div>
        </div>
    </section>
</div>
