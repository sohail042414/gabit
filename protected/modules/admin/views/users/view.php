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
                        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                        array('label' => Yii::t('app', 'Update') . ' ' . $model->label(), 'url' => array('update', 'id' => $model->id)),
                        array('label' => Yii::t('app', 'Delete') . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
                        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin'))
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <?php echo UtilityHtml::get_flash_message(); ?>
                <?php $this->widget('CoreCDetailView', array(
                    'data' => $model,
                    'attributes' => array(
                        'id',
                        'username',
                        'email',
                        'phone',
                        'age',
                        array(
                            'name' => 'sex',
                            'type' => 'raw',
                            'value' => $model->sex =='M' ? 'Male' : 'Female',
                        ),
                        'created_date',
                        array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => UtilityHtml::getStatusImage($model->status, 'view'),
                        ),),
                )); ?>
            </div>
        </div>
    </section>


    <section class="panel">
        <header class="panel-heading">
            User Social Media Shares History
        </header>

        <div class="panel-body">

        <div class="dataTables_wrapper form-inline">
                <?php
                $this->widget('CoreCGridView', array(
                    'id' => 'users-grid',
                    'dataProvider' => $sharesModel->search(),
                    'columns' => array(
                        'id',
                        'month',
                        'year',
                        'monthly_count',
                        'total_shares',
                        array(
                            'name' =>'created_at',
                            'header' => 'Updated at',
                            'value' => '$data->created_at'
                        ),
                    ),
                ));
                ?>
            </div>

        </div>

    </section>

</div>