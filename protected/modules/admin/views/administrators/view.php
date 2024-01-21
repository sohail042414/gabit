<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label(1)) ?>

            <?php
            $this->breadcrumbs = array(
                'Administrators' => array('admin'),
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
                        array(
                            'label' => Yii::t('app', 'Create Account'), 
                            'url' => array('create'),
                            'visible' => $this->auth->canAdd($this->resource_id)
                        ),
                        array(
                            'label' => Yii::t('app', 'Update Account'), 
                            'url' => array('update', 'id' => $model->id),
                            'visible' => $this->auth->canUpdate($this->resource_id)
                        ),
                        array(
                            'label' => Yii::t('app', 'Delete Account'), 
                            'url' => '#', 
                            'linkOptions' => array(
                                'submit' => array('delete', 'id' => $model->id), 
                                'confirm' => 'Are you sure you want to delete this item?'
                            ),
                            'visible' => $this->auth->canDelete($this->resource_id)
                        ),                            
                        array(
                            'label' => Yii::t('app', 'Manage Administrators'), 
                            'url' => array('admin'),

                        )
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
                        array(
                            'label' => 'Admin Group',
                            'type' => 'raw',
                            'value' => isset($model->group) ? $model->group->name  : null,
                        ),
                        'email',
                        'age',
                        array(
                            'name' => 'sex',
                            'type' => 'raw',
                            'value' => $model->sex =='M' ? 'Male' : 'Female',
                        ),
//                        'designation',
//                        'password',
                        'created_date',
//                        'updated_date',
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
</div>