<section class="content-header">
    <h1>
        <?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)) ?>
    </h1>
    <?php
        $this->breadcrumbs = array(
            $model->label(2) => array('admin'),
            Yii::t('app', 'Manage'),
        );


        $this->widget('CoreCBreadcrumbs', array(
            'links' => $this->breadcrumbs,
            'htmlOptions' => array('class' => 'breadcrumb')
        )); 

        ?> 
</section>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                    ),
                ));
                ?>
            </div>

            <div class="box-body table-responsive">
                <?php $this->widget('CoreCGridView', array(
                'id' => 'settings-grid',
                'dataProvider' => $model->search(),
                'filter' => $model,
                'columns' => array(
                		'site_name',
		'address',
		'email_id',
		'phone_no',
                array(
                'header' => 'Actions',
                'class' => 'CoreCButtonColumn',
                ),
                ),
                )); ?>
            </div>

        </div>
    </div>
</section>