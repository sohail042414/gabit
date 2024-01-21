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
            <div id="output"></div>
            <div class="box-header">
                <?php 
                if($this->auth->canAdd($this->resource_id)){
                    echo CHtml::ajaxLink("Send Mail",
                        $this->createUrl('/admin/newsletter/sendnewsemail'),
                        array("type" => "post",
    //                        "data" => "js:{selectedIds:$.fn.yiiGridView.getSelection('newsletter-grid')}",
                            "data" => "js:{selectedIds:$.fn.yiiGridView.getChecked('newsletter-grid','selectedIds')}",
                            "update" => "#output",
                            'beforeSend' => 'function() {
                                $("#newsletter-grid").addClass("grid-view-loading");
                            }',
                            'complete' => 'function() {
                                $("#newsletter-grid").removeClass("grid-view-loading");
                            }',

                        ), array('class' => 'btn btn-primary')); 
                }                  
                ?>
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => Yii::t('app', 'Create') . ' ' . $model->label(), 
                            'url' => array('create'),
                            'visible' => $this->auth->canAdd($this->resource_id),
                        ),

                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="dataTables_wrapper form-responsive">
                <?php $this->widget('CoreCGridView', array(
                    'id' => 'newsletter-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'id' => 'selectedIds',
                            'class' => 'CCheckBoxColumn',
                            'selectableRows' => '100',
                        ),
                        'Newsletter_email',
                        'created_date',
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