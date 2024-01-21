<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)) ?>
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
        </header>
        <div class="panel-body">
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => Yii::t('app', 'Approve Comments') , 
                            'url' => array('comment/index'),
                            'visible' => $this->auth->canUpdate($this->resource_id)
                        ),
                        array(
                            'label' => Yii::t('app', 'Create') . ' ' . $model->label(), 
                            'url' => array('create'),
                            'visible' => $this->auth->canAdd($this->resource_id)
                        ),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
                <?php $this->widget('CoreCGridView', array(
                    'id' => 'post-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        'title',
                        'content',
                        array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('2' => 'Active', '1' => 'Inactive'),
                            'value' => 'UtilityHtml::getpostStatus($data->status,"grid")',
                        ),
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
    </section>
</div>