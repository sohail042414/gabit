<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <!--            --><?php //echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)) ?>
            <?php echo Yii::t('app', 'Manage') . ' Fundraiser Comments' ?>

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
                if($this->auth->canUpdate($this->resource_id)){
                    echo CHtml::ajaxLink("Comment Approval",
                    $this->createUrl('/admin/FundraiserComment/setcommentstatus'),
                    array("type" => "post",
                        "data" => "js:{selectedIds:$.fn.yiiGridView.getChecked('fundraiser-comment-grid','selectedIds'),comment_status:'1'}",
                        "update" => "#output",
                        'beforeSend' => 'function() {
                            $("#fundraiser-comment-grid").addClass("grid-view-loading");
                        }',
                        'complete' => 'function() {
                            $("#fundraiser-comment-grid").removeClass("grid-view-loading");
                            $.fn.yiiGridView.update("fundraiser-comment-grid");
                        }',

                    ), array('class' => 'btn btn-primary')); 

                    echo CHtml::ajaxLink("Comment Rejected",
                    $this->createUrl('/admin/FundraiserComment/setcommentstatus'),
                    array("type" => "post",
                        "data" => "js:{selectedIds:$.fn.yiiGridView.getChecked('fundraiser-comment-grid','selectedIds'),comment_status:'2'}",
                        "update" => "#output",
                        'beforeSend' => 'function() {
                            $("#fundraiser-comment-grid").addClass("grid-view-loading");
                        }',
                        'complete' => 'function() {
                            $("#fundraiser-comment-grid").removeClass("grid-view-loading");
                            $.fn.yiiGridView.update("fundraiser-comment-grid");
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
                            'visible' => $this->auth->canAdd($this->resource_id)
                        ),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-responsive">
                <?php $this->widget('CoreCGridView', array(
                    'id' => 'fundraiser-comment-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'id' => 'selectedIds',
                            'class' => 'CCheckBoxColumn',
                            'selectableRows' => '100',
                        ),
                        'id',
                        array(
                            'name' => 'fundraiser_reference_id',
                            'value' => '$data->fundraiserReference->fundraiser_title',
                            'filter' => GxHtml::listDataEx(SetupFundraiser::model()->findAll(array('select'=>'id,fundraiser_title'))),
                        ),
                        'name',
                        'email',
                        'comment',
                        array(
                            'name' => 'comment_status',
                            'value' => 'UtilityHtml::getFundraiserComment($data->comment_status)',
                            'filter' => array('0' => 'Pending', '1' => 'Approved', '2' => 'Rejected'),
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