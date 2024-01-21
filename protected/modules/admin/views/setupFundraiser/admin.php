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
                                    'label' => Yii::t('app', 'Create New Fundraiser'), 
                                    'url' => array('create'),
                                    'visible' => $this->auth->canAdd($this->resource_id)
                                ),        
                            ),
                        )
                    );
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
                <?php $this->widget('CoreCGridView', array(
                    'id' => 'setup-fundraise-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        'id',
                        array(
                            'name' => 'ftype_id',
                            'value' => 'GxHtml::valueEx($data->ftype)',
                            'filter' => GxHtml::listDataEx(FundraiserType::model()->findAllAttributes(null, true)),
                        ),
                        'fundraiser_title',
                        array(
                            'name' => 'uplod_fun_img',
                            'type' => 'raw',
                            'filter' => false,
                            'value' => 'UtilityHtml::get_fundraiser_image_from_path($data->uplod_fun_img,"display_facebook_img")',
                        ),
                        array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => 'UtilityHtml::getStatusImage($data->feature_flag,"grid")',
                        ),
                        array(
                            'name' => 'search_status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => 'UtilityHtml::getStatusImage($data->search_status,"grid")',
                        ),
                        array(
                            'name' => 'feature_flag',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => 'UtilityHtml::getStatusImage($data->feature_flag,"grid")',
                        ),
                        array(
                            'header' => 'New',
                            'name' => 'status_new',
                            'type' => 'raw',
                            'value' => '$data->status_new == "Y" ? "<span style=\"color:red;\">Yes</span>" : "No"',
                            'filter' => '',
                        ),
                        array(
                            'name' => 'user_id',
                            'value' => 'GxHtml::valueEx($data->user)',
                            'filter' => GxHtml::listDataEx(Users::model()->findAll(array('condition' => 'user_type != 1',))),
                        ),
                        array(
                            'header' => 'Total Donation',
                            'type' => 'raw',
                            'value' => 'number_format(Fundraiser::model()->getDonationAmount($data->id),2)',
                            'filter' => '',
                        ),
                        array(
                            'header' => 'Total Payout',
                            'type' => 'raw',
                            'value' => 'number_format(Fundraiser::model()->getTotalPayout($data->id),2)',
                            'filter' => '',
                        ),
                        array(
                            'header' => 'Balance',
                            'type' => 'raw',
                            'value' => 'number_format(Fundraiser::model()->getBalance($data->id),2)',
                            'filter' => '',
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
