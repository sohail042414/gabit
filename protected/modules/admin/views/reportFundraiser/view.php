<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label(1)) ?>
            <?php
            $this->breadcrumbs = array(
                $model->label(2) => array('admin'),
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
                            array('label'=>'Manage Report Fundraiser', 'url'=>array('admin')),
                        ),
                    )); ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <?php echo UtilityHtml::get_flash_message(); ?>
               <?php $this->widget('CoreCDetailView', array(
                'data' => $model,
                'attributes' => array(
                //'id',
                'fundraiser_title',
                //'fundraiser_id',
                'user_name',
                'email',
                'description',
                'created_date',
                'updated_date',
                array(
                                'name' => 'status',
                                'type' => 'raw',
                                'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                                'value' => UtilityHtml::getStatusImage($model->status,'view'),
                            ),                ),
                    )); ?>
            </div>
        </div>
    </section>
</div>

