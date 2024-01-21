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
                    'id' => 'comment-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        'id',
                        'content',
                        array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => 'UtilityHtml::getStatusImage($data->status,"grid")',
                        ),
                        'created_date',
                        'updated_date',
                        'author',
                        array(
                            'class' => 'CoreCButtonColumn',
                            'header' => 'Functions',
                            'template' => '{view}{update}{delete}',
                            'buttons' => array(
                                'view' => array(
                                    'visible' => ($this->auth->canView($this->resource_id)) ? '1' : '0;'
                                ),
                                'update' => array(
                                    'visible' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0;'
                                ),
                                'delete' => array(
                                    'visible' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0;'
                                ),
                            ),
                        ),
                    ),
                )); ?>
            </div>

        </div>
    </div>
</section>