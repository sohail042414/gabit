<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage') . ' ' . 'Fundraiser Questions' ?>

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
                        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-responsive">
                <?php $this->widget('CoreCGridView', array(
                    'id' => 'fundraiser-questions-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'name' => 'topic_id',
                            'value' => 'GxHtml::valueEx($data->topic)',
                            'filter' => GxHtml::listDataEx(Topic::model()->findAllAttributes(null, true)),
                        ),
                        array(
                            'name' => 'questions_text',
                            'value' => 'UtilityHtml::getview($data->questions_text,$data->id)',
                            'type' => 'html'
                        ),
                       'subject',
                        array(
                            'name' => 'notify_status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => 'UtilityHtml::getStatusImage($data->notify_status,"grid")',
                        ),
                        array(
                            'header' => 'Actions',
                            'class' => 'CButtonColumn',
                            'template' => '{Approval}{Reject}',
                            'buttons' => array
                            (
                                'Approval' => array
                                (
                                    'label' => 'Approval',
//                                    'imageUrl' => 'images/icn/status.png',  // make sure you have an image
                                    'url' => 'Yii::app()->createUrl("admin/fundraiserQuestions/approvalquestion", array("id"=>$data->id))',
                                    'options' => array(
                                        'ajax' => array('type' => 'get', 'url' => 'js:$(this).attr("href")', 'success' => 'js:function(data) { $.fn.yiiGridView.update("fundraiser-questions-grid")}'), 'class' => 'btn btn-primary'
                                    ),
                                    'visible' => '$data->status == "N"',

                                ),
                                'Reject' => array
                                (
                                    'label' => 'Reject',
//                                    'imageUrl' => 'images/icn/status.png',  // make sure you have an image
                                    'url' => 'Yii::app()->createUrl("admin/fundraiserQuestions/Rejectquestion", array("id"=>$data->id))',
                                    'options' => array(
                                        'ajax' => array('type' => 'get', 'url' => 'js:$(this).attr("href")', 'success' => 'js:function(data) {$.fn.yiiGridView.update("fundraiser-questions-grid")}'), 'class' => 'btn btn-primary'
                                    ),
                                    'visible' => '$data->status == "Y"',

                                ),
                            ),
                        ),
                    ),
                )); ?>
            </div>
        </div>
    </section>
</div>