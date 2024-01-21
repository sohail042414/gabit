<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Notifications') ?>

            <?php
            $this->breadcrumbs = array(
                Yii::t('app', 'Notifications'),
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
                        //#array('label' => 'Manage Posts', 'url' => array('post/admin')),
                       array('label' => 'Send Message', 'url' => array('notifications/send_notifications_admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>
            <div class="box-body">
            <div class="dataTables_wrapper form-inline">
                <?php 
                $this->widget('CoreCGridView', array(
                    'id' => 'donations-grid',
                    'dataProvider' => $model->searchAdmin(),
                    //'filter' => $model,
                    'columns' => array(
                        'subject' => array(
                            'header' => false,
                            'value' => '$data->getCommentHtml()',
                            'name' => 'subject',
                            'type' => 'raw'
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'header' => 'Manage',
                            'template' => '{delete}',                            
                        ),
                    ),
                ));
                ?>
            </div>           
            </div>
</div>
</section>
</div>