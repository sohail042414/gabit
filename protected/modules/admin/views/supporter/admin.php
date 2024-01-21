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
                            'label' => Yii::t('app', 'Create') . ' ' . $model->label(), 
                            'url' => array('create'),
                            'visible' => $this->auth->canAdd($this->resource_id)
                        ),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-responsive">
                <?php $this->widget('CoreCGridView', array(
                    'id' => 'supporter-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        'id',
                        array(
                            'name' => 'fundraiser_id',
                            'value' => 'GxHtml::valueEx($data->fundraiser)',
                            'filter' => GxHtml::listDataEx(SetupFundraiser::model()->findAllAttributes(null, true)),
                        ),
                        'supporter_email',
                        array(
                            'name' => 'supporter_image',
                            'type' => 'raw',
                            'filter' => false,
                            'value' => 'UtilityHtml::get_supporter_image_from_path($data->supporter_image,"display_facebook_img")',
                        ),
                        'supporter_message',
                        array(
                            'header' => 'New',
                            'name' => 'status_new',
                            'type' => 'raw',
                            'value' => '$data->status_new == "Y" ? "<span style=\"color:red;\">Yes</span>" : "No"',
                            'filter' => '',
                        ),
                        array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => 'UtilityHtml::getStatusImage($data->status,"grid")',
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
</div>]