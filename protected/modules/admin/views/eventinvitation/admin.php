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

            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
               <?php $this->widget('CoreCGridView', array(
                    'id'=>'event-invitation-grid',
                    'dataProvider'=>$model->search(),
                    'filter'=>$model,
                    'columns'=>array(
                        'id',
                        'event_name',
                        'event_cordinator',
                        'email',
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
</div>
