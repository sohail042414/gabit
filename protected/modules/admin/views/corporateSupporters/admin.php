<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            Manage Corporate Supporters
            <?php
            $this->breadcrumbs = array(
                'Corporate Supporters' => array('admin'),
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
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => Yii::t('app', 'Create Corporate Supporter'), 
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
                    'id' => 'patner-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'name' => 'image',
                            'type' => 'raw',
                            'filter' => false, //SUPPORTER_IMAGE_ORIGINAL
                            'value' => 'UtilityHtml::get_corporate_supporter_thumb($data->image,"display_facebook_img")',
                        ),             
						'name', 
						'website_url',
						array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => false,
                            'value' => '($data->status == 1) ? "Active" : "In Active"',
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